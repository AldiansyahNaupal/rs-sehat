<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WhatsAppService;
use App\Models\Appointment;
use ReflectionClass;

class SendClearWhatsAppTest extends Command
{
    protected $signature = 'whatsapp:send-clear-test {phone}';
    
    protected $description = 'Send a very clear test message to help locate WhatsApp message';

    public function handle()
    {
        $phone = $this->argument('phone');
        
        $this->info('📱 Sending CLEAR TEST MESSAGE');
        $this->line('═══════════════════════════════════════════════════════════');
        $this->info("📞 Target: {$phone}");
        $this->info("📲 Sender will appear as: +15551786297 (Meta Test Number)");
        $this->newLine();
        
        try {
            $whatsappService = new WhatsAppService();
            
            // Format phone
            $formatted = $this->formatPhoneNumber($phone);
            
            // Send clear test message
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.whatsapp.access_token'),
                'Content-Type' => 'application/json',
            ])->post('https://graph.facebook.com/v18.0/' . config('services.whatsapp.phone_number_id') . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $formatted,
                'type' => 'text',
                'text' => [
                    'body' => "🧪 TEST DARI RS SEHAT\n\n" .
                             "Halo! Ini adalah test message dari sistem RS Sehat.\n\n" .
                             "📱 Jika Anda menerima pesan ini, berarti WhatsApp API berfungsi!\n\n" .
                             "⚠️ PENTING: Pesan ini dikirim dari nomor test +15551786297\n\n" .
                             "✅ Silakan reply 'OK' jika pesan ini diterima.\n\n" .
                             "---\n" .
                             "RS Sehat - Test System ✨"
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('✅ TEST MESSAGE SENT SUCCESSFULLY!');
                $this->line('📱 Message ID: ' . ($data['messages'][0]['id'] ?? 'N/A'));
                $this->line('📞 Formatted Phone: ' . $formatted);
                
                $this->newLine();
                $this->info('📋 INSTRUCTIONS FOR RECIPIENT:');
                $this->line('1. Open WhatsApp on your phone');
                $this->line('2. Look for message from: +15551786297');
                $this->line('3. Check "Chats" tab first');
                $this->line('4. If not found, scroll down to see unknown contacts');
                $this->line('5. Check Business/Unknown folder');
                $this->line('6. Look for message with "🧪 TEST DARI RS SEHAT"');
                
                $this->newLine();
                $this->warn('⚠️  IF STILL NOT FOUND:');
                $this->line('• Check WhatsApp > Settings > Account > Privacy > Blocked');
                $this->line('• Make sure WhatsApp notifications are enabled');
                $this->line('• Try refreshing WhatsApp (close and reopen)');
                $this->line('• Check if phone has good internet connection');
                
            } else {
                $error = $response->json();
                $this->error('❌ Failed to send test message');
                $this->error('Error: ' . ($error['error']['message'] ?? 'Unknown error'));
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Exception: ' . $e->getMessage());
        }
        
        return 0;
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
}
