<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckWhatsAppDeliveryCommand extends Command
{
    protected $signature = 'whatsapp:check-delivery {message_id? : WhatsApp Message ID to check}';
    
    protected $description = 'Check WhatsApp message delivery status and troubleshoot delivery issues';

    public function handle()
    {
        $this->info('📱 WhatsApp Delivery Status Checker');
        $this->line('═══════════════════════════════════════════════════════════');
        
        $messageId = $this->argument('message_id');
        
        if (!$messageId) {
            // Get latest message ID from logs
            $messageId = $this->getLatestMessageId();
        }
        
        if (!$messageId) {
            $this->error('❌ No message ID found. Please provide message ID or send a test message first.');
            return 1;
        }
        
        $this->info("🔍 Checking delivery status for message: {$messageId}");
        $this->newLine();
        
        // Check message status via API
        $this->checkMessageStatus($messageId);
        
        // General troubleshooting tips
        $this->showTroubleshootingTips();
        
        return 0;
    }
    
    private function getLatestMessageId()
    {
        try {
            $logFile = storage_path('logs/laravel.log');
            if (!file_exists($logFile)) {
                return null;
            }
            
            $content = file_get_contents($logFile);
            preg_match_all('/message_id":"(wamid\.[^"]+)"/', $content, $matches);
            
            if (!empty($matches[1])) {
                return end($matches[1]); // Get the latest message ID
            }
            
        } catch (\Exception $e) {
            $this->warn('Could not parse log file: ' . $e->getMessage());
        }
        
        return null;
    }
    
    private function checkMessageStatus($messageId)
    {
        try {
            $token = config('services.whatsapp.access_token');
            
            // Try to get message status (Note: This endpoint might not be available in all versions)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get("https://graph.facebook.com/v18.0/{$messageId}");
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('✅ Message status retrieved:');
                $this->line('   📱 Message ID: ' . $messageId);
                $this->line('   📊 Status: ' . ($data['status'] ?? 'Unknown'));
                $this->line('   📅 Created: ' . ($data['created_time'] ?? 'Unknown'));
            } else {
                $this->warn('⚠️  Cannot retrieve message status (normal for WhatsApp API)');
                $this->line('   📱 Message ID: ' . $messageId);
                $this->line('   ℹ️  WhatsApp Business API has limited status tracking in free tier');
            }
            
        } catch (\Exception $e) {
            $this->warn('⚠️  Status check not available: ' . $e->getMessage());
        }
        
        $this->newLine();
    }
    
    private function showTroubleshootingTips()
    {
        $this->info('🔧 Troubleshooting: Why WhatsApp message might not arrive');
        $this->line('═══════════════════════════════════════════════════════════');
        
        $this->warn('1. 📱 WhatsApp App Issues:');
        $this->line('   • WhatsApp not installed or not updated');
        $this->line('   • Phone turned off or no internet connection');
        $this->line('   • WhatsApp notifications disabled');
        $this->line('   • Messages going to spam/blocked folder');
        
        $this->newLine();
        $this->warn('2. 🔢 Phone Number Issues:');
        $this->line('   • Wrong phone number format');
        $this->line('   • Number not associated with WhatsApp account');
        $this->line('   • Number blocked the business account');
        $this->line('   • Number changed recently');
        
        $this->newLine();
        $this->warn('3. 🏢 Business Account Issues:');
        $this->line('   • Business account not verified');
        $this->line('   • Rate limiting (too many messages)');
        $this->line('   • Template not approved (if using templates)');
        $this->line('   • Account in development mode with limited recipients');
        
        $this->newLine();
        $this->warn('4. ⏰ Timing Issues:');
        $this->line('   • Messages can take 1-5 minutes to arrive');
        $this->line('   • WhatsApp servers experiencing delays');
        $this->line('   • Recipient in different timezone');
        $this->line('   • Peak usage hours causing delays');
        
        $this->newLine();
        $this->info('✅ Recommended Actions:');
        $this->line('1. Verify the recipient phone number is correct');
        $this->line('2. Ask recipient to check WhatsApp spam/blocked messages');
        $this->line('3. Test with a different phone number');
        $this->line('4. Wait 5-10 minutes for delivery');
        $this->line('5. Check if WhatsApp Business number is in recipient\'s contacts');
        
        $this->newLine();
        $this->info('🧪 Test Commands:');
        $this->line('# Test with different number');
        $this->line('php artisan whatsapp:debug +6285964232183');
        $this->line('');
        $this->line('# Send test message');
        $this->line('php artisan test:whatsapp +6285964232183');
        $this->line('');
        $this->line('# Check logs');
        $this->line('tail -f storage/logs/laravel.log | grep -i whatsapp');
        
        $this->newLine();
        $this->info('📞 Verify Recipient Steps:');
        $this->line('1. Ask recipient to open WhatsApp');
        $this->line('2. Check "Chats" tab for new messages');
        $this->line('3. Check "Settings > Account > Privacy > Blocked" contacts');
        $this->line('4. Look for messages from business numbers or unknown contacts');
        $this->line('5. Check if notifications are enabled for WhatsApp');
    }
}
