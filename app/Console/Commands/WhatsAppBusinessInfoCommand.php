<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WhatsAppBusinessInfoCommand extends Command
{
    protected $signature = 'whatsapp:business-info';
    
    protected $description = 'Get WhatsApp Business Account information and sender details';

    public function handle()
    {
        $this->info('🏢 WhatsApp Business Account Information');
        $this->line('═══════════════════════════════════════════════════════════');
        
        $this->getBusinessAccountInfo();
        $this->getPhoneNumberInfo();
        $this->checkRateLimits();
        
        return 0;
    }
    
    private function getBusinessAccountInfo()
    {
        $this->info('📊 Business Account Details:');
        
        try {
            $token = config('services.whatsapp.access_token');
            $businessId = config('services.whatsapp.business_account_id');
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get("https://graph.facebook.com/v18.0/{$businessId}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->line('   🏷️  Name: ' . ($data['name'] ?? 'N/A'));
                $this->line('   🆔 ID: ' . ($data['id'] ?? 'N/A'));
                $this->line('   📊 Status: ' . ($data['status'] ?? 'Unknown'));
                $this->line('   ✅ Verified: ' . (isset($data['is_verified']) && $data['is_verified'] ? 'Yes' : 'No'));
            } else {
                $this->error('   ❌ Cannot retrieve business account info');
                $this->line('   Error: ' . $response->body());
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
    }
    
    private function getPhoneNumberInfo()
    {
        $this->info('📱 Phone Number Details:');
        
        try {
            $token = config('services.whatsapp.access_token');
            $phoneId = config('services.whatsapp.phone_number_id');
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get("https://graph.facebook.com/v18.0/{$phoneId}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->line('   📞 Display Number: ' . ($data['display_phone_number'] ?? 'N/A'));
                $this->line('   🆔 Phone Number ID: ' . ($data['id'] ?? 'N/A'));
                $this->line('   📊 Status: ' . ($data['status'] ?? 'Unknown'));
                $this->line('   🏷️  Name: ' . ($data['name'] ?? 'N/A'));
                $this->line('   🔤 Name Status: ' . ($data['name_status'] ?? 'Unknown'));
                $this->line('   🎯 Quality Rating: ' . ($data['quality_rating'] ?? 'Unknown'));
                
                // Show what this number will appear as to recipients
                $displayNumber = $data['display_phone_number'] ?? 'Unknown';
                $this->newLine();
                $this->info("   📲 Recipients will see messages from: {$displayNumber}");
                $this->line("   💬 Make sure recipient has this number or check for 'Unknown' sender");
                
            } else {
                $this->error('   ❌ Cannot retrieve phone number info');
                $this->line('   Error: ' . $response->body());
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
    }
    
    private function checkRateLimits()
    {
        $this->info('⚡ Rate Limits & Messaging Info:');
        
        try {
            $token = config('services.whatsapp.access_token');
            $businessId = config('services.whatsapp.business_account_id');
            
            // Get messaging limits
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get("https://graph.facebook.com/v18.0/{$businessId}/message_templates");
            
            if ($response->successful()) {
                $this->line('   ✅ API accessible for templates');
            } else {
                $this->line('   ⚠️  Limited API access (normal for development)');
            }
            
            // Show development vs production differences
            $this->newLine();
            $this->warn('📋 Development Mode Limitations:');
            $this->line('   • Can only send to pre-approved phone numbers');
            $this->line('   • Recipients must be added to "allowed list"');
            $this->line('   • Limited to 5 recipients in development');
            $this->line('   • Messages may appear from test number');
            
            $this->newLine();
            $this->info('🚀 Production Mode Benefits:');
            $this->line('   • Send to any WhatsApp number worldwide');
            $this->line('   • Professional business profile');
            $this->line('   • Higher rate limits');
            $this->line('   • Delivery status tracking');
            $this->line('   • Template message approval');
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
        $this->info('💡 Next Steps:');
        $this->line('1. Verify recipient number +6285964232183 is correct');
        $this->line('2. Ask recipient to check WhatsApp for messages from unknown numbers');
        $this->line('3. Check if business number needs to be in recipient contacts');
        $this->line('4. Consider submitting for production approval');
        
        $this->newLine();
        $this->info('🔗 Useful Links:');
        $this->line('📱 Add to contacts: Save the business number to recipient phone');
        $this->line('🏢 Business Manager: https://business.facebook.com');
        $this->line('📚 Documentation: https://developers.facebook.com/docs/whatsapp');
    }
}
