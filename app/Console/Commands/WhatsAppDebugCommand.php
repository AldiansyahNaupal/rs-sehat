<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WhatsAppDebugCommand extends Command
{
    protected $signature = 'whatsapp:debug {phone? : Phone number to check}';
    
    protected $description = 'Debug WhatsApp API configuration and phone number status';

    public function handle()
    {
        $this->info('🔍 WhatsApp API Debug Information');
        $this->line('═══════════════════════════════════════════════════════════');
        
        // Check configuration
        $this->checkConfiguration();
        
        // Check API connectivity
        $this->checkAPIConnectivity();
        
        // If phone provided, check phone status
        if ($phone = $this->argument('phone')) {
            $this->checkPhoneNumber($phone);
        }
        
        // Show recommendations
        $this->showRecommendations();
        
        return 0;
    }
    
    private function checkConfiguration()
    {
        $this->info('📋 Configuration Check:');
        
        $token = config('services.whatsapp.access_token');
        $phoneId = config('services.whatsapp.phone_number_id');
        $businessId = config('services.whatsapp.business_account_id');
        
        $this->line('   Access Token: ' . ($token ? '✅ Set (' . substr($token, 0, 20) . '...)' : '❌ Not set'));
        $this->line('   Phone Number ID: ' . ($phoneId ? '✅ Set (' . $phoneId . ')' : '❌ Not set'));
        $this->line('   Business Account ID: ' . ($businessId ? '✅ Set (' . $businessId . ')' : '❌ Not set'));
        $this->newLine();
    }
    
    private function checkAPIConnectivity()
    {
        $this->info('🌐 API Connectivity Check:');
        
        try {
            $token = config('services.whatsapp.access_token');
            $phoneId = config('services.whatsapp.phone_number_id');
            
            if (!$token || !$phoneId) {
                $this->error('   ❌ Cannot test - Missing credentials');
                return;
            }
            
            // Check if we can access the phone number
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get("https://graph.facebook.com/v18.0/{$phoneId}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('   ✅ API Connection successful');
                $this->line('   📱 Phone Number: ' . ($data['display_phone_number'] ?? 'N/A'));
                $this->line('   📊 Status: ' . ($data['status'] ?? 'Unknown'));
                $this->line('   🏢 Name: ' . ($data['name'] ?? 'N/A'));
            } else {
                $this->error('   ❌ API Connection failed');
                $this->error('   Status: ' . $response->status());
                $this->error('   Response: ' . $response->body());
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
    }
    
    private function checkPhoneNumber($phone)
    {
        $this->info("📞 Phone Number Analysis: {$phone}");
        
        // Format phone number
        $formatted = $this->formatPhoneNumber($phone);
        $this->line("   Original: {$phone}");
        $this->line("   Formatted: {$formatted}");
        
        // Check if it's Indonesian number
        if (str_starts_with($formatted, '62')) {
            $this->info('   ✅ Indonesian number format detected');
        } else {
            $this->warn('   ⚠️  Non-Indonesian number - may need different formatting');
        }
        
        // Test send to this number
        $this->line('   Testing message send...');
        
        try {
            $token = config('services.whatsapp.access_token');
            $phoneId = config('services.whatsapp.phone_number_id');
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ])->post("https://graph.facebook.com/v18.0/{$phoneId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $formatted,
                'type' => 'text',
                'text' => [
                    'body' => 'Test message dari RS Sehat - Debug Mode 🧪'
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('   ✅ Message sent successfully!');
                $this->line('   📱 Message ID: ' . ($data['messages'][0]['id'] ?? 'N/A'));
            } else {
                $this->error('   ❌ Message failed to send');
                $error = $response->json();
                $this->error('   Error: ' . ($error['error']['message'] ?? 'Unknown error'));
                
                // Specific error handling
                if (isset($error['error']['code'])) {
                    $this->handleSpecificError($error['error']['code'], $error['error']['message']);
                }
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
    }
    
    private function handleSpecificError($code, $message)
    {
        switch ($code) {
            case 131030:
                $this->warn('   💡 Solution: Add this number to allowed list in Meta Business Manager');
                $this->line('   📋 Steps:');
                $this->line('      1. Go to business.facebook.com');
                $this->line('      2. Select your WhatsApp Business Account');
                $this->line('      3. Add number to allowed list');
                $this->line('      4. Verify via SMS');
                break;
                
            case 190:
                $this->warn('   💡 Solution: Access token issue');
                $this->line('   📋 Steps:');
                $this->line('      1. Regenerate access token');
                $this->line('      2. Update .env file');
                $this->line('      3. Restart application');
                break;
                
            case 100:
                $this->warn('   💡 Solution: Permission or API endpoint issue');
                $this->line('   📋 Steps:');
                $this->line('      1. Check WhatsApp permissions in app');
                $this->line('      2. Verify phone number ID');
                $this->line('      3. Check API version compatibility');
                break;
                
            default:
                $this->warn("   💡 Error code {$code}: {$message}");
        }
    }
    
    private function formatPhoneNumber($phone)
    {
        // Remove all non-numeric characters except +
        $phone = preg_replace('/[^\d+]/', '', $phone);
        
        // Remove + if present
        $phone = ltrim($phone, '+');
        
        // Handle Indonesian numbers
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Add 62 if not present
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    private function showRecommendations()
    {
        $this->info('💡 Recommendations:');
        $this->line('   1. For development: Add test numbers to allowed list');
        $this->line('   2. For production: Submit app for review to remove limitations');
        $this->line('   3. Monitor logs: tail -f storage/logs/laravel.log | grep -i whatsapp');
        $this->line('   4. Test regularly with: php artisan whatsapp:debug +6285964232183');
        $this->newLine();
        
        $this->info('🔗 Useful Links:');
        $this->line('   📚 WhatsApp Business API Docs: https://developers.facebook.com/docs/whatsapp');
        $this->line('   🏢 Meta Business Manager: https://business.facebook.com');
        $this->line('   🛠️  Developer Console: https://developers.facebook.com');
    }
}
