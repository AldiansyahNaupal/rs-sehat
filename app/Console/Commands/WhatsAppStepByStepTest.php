<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WhatsAppStepByStepTest extends Command
{
    protected $signature = 'whatsapp:step-test {phone}';
    
    protected $description = 'Step by step WhatsApp testing to identify delivery issues';

    public function handle()
    {
        $phone = $this->argument('phone');
        
        $this->info('🧪 WhatsApp Step-by-Step Debugging');
        $this->line('═══════════════════════════════════════════════════════════');
        $this->newLine();
        
        // Step 1: Test very simple message
        $this->testSimpleMessage($phone);
        
        // Step 2: Test with emojis
        $this->testEmojiMessage($phone);
        
        // Step 3: Test RS Sehat format
        $this->testRSSehatMessage($phone);
        
        // Step 4: Show all recent messages
        $this->showRecentMessages();
        
        return 0;
    }
    
    private function testSimpleMessage($phone)
    {
        $this->info('📝 Step 1: Testing Simple Text Message');
        
        try {
            $formatted = $this->formatPhoneNumber($phone);
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.whatsapp.access_token'),
                'Content-Type' => 'application/json',
            ])->post('https://graph.facebook.com/v18.0/' . config('services.whatsapp.phone_number_id') . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $formatted,
                'type' => 'text',
                'text' => [
                    'body' => 'Hello! This is a simple test message from RS Sehat system. Please reply OK if you receive this.'
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('   ✅ Simple message sent successfully');
                $this->line('   📱 Message ID: ' . ($data['messages'][0]['id'] ?? 'N/A'));
                $this->line('   💬 Content: Simple text only');
                $this->line('   ⏰ Wait 30 seconds and check WhatsApp...');
            } else {
                $this->error('   ❌ Simple message failed');
                $error = $response->json();
                $this->error('   Error: ' . ($error['error']['message'] ?? 'Unknown'));
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
        sleep(2); // Brief pause
    }
    
    private function testEmojiMessage($phone)
    {
        $this->info('😊 Step 2: Testing Message with Emojis');
        
        try {
            $formatted = $this->formatPhoneNumber($phone);
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.whatsapp.access_token'),
                'Content-Type' => 'application/json',
            ])->post('https://graph.facebook.com/v18.0/' . config('services.whatsapp.phone_number_id') . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $formatted,
                'type' => 'text',
                'text' => [
                    'body' => '🏥 RS Sehat Test 2\n\n📱 This message contains emojis\n✅ Please check if this appears\n\n⏰ ' . now()->format('H:i:s')
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('   ✅ Emoji message sent successfully');
                $this->line('   📱 Message ID: ' . ($data['messages'][0]['id'] ?? 'N/A'));
                $this->line('   💬 Content: Text with emojis and line breaks');
                $this->line('   ⏰ Wait 30 seconds and check WhatsApp...');
            } else {
                $this->error('   ❌ Emoji message failed');
                $error = $response->json();
                $this->error('   Error: ' . ($error['error']['message'] ?? 'Unknown'));
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
        sleep(2); // Brief pause
    }
    
    private function testRSSehatMessage($phone)
    {
        $this->info('🏥 Step 3: Testing Full RS Sehat Template');
        
        try {
            $formatted = $this->formatPhoneNumber($phone);
            
            $message = "🏥 *RS SEHAT - Konfirmasi Janji Temu*\n\n" .
                      "Halo *Test User*,\n\n" .
                      "Terima kasih telah membuat janji temu dengan kami!\n\n" .
                      "📋 *Detail Appointment:*\n" .
                      "📅 Tanggal: " . now()->addDay()->format('d F Y') . "\n" .
                      "🕐 Waktu: 10:00\n" .
                      "👨‍⚕️ Dokter: Dr. Test\n" .
                      "🏥 Layanan: Konsultasi Test\n\n" .
                      "📍 *Lokasi:*\n" .
                      "RS Sehat\n" .
                      "Jl. Kesehatan No. 123\n\n" .
                      "Terima kasih atas kepercayaan Anda!\n\n" .
                      "---\n" .
                      "RS Sehat - Melayani dengan Sepenuh Hati ❤️";
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.whatsapp.access_token'),
                'Content-Type' => 'application/json',
            ])->post('https://graph.facebook.com/v18.0/' . config('services.whatsapp.phone_number_id') . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $formatted,
                'type' => 'text',
                'text' => [
                    'body' => $message
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('   ✅ RS Sehat template sent successfully');
                $this->line('   📱 Message ID: ' . ($data['messages'][0]['id'] ?? 'N/A'));
                $this->line('   💬 Content: Full appointment template');
                $this->line('   📊 Length: ' . strlen($message) . ' characters');
                $this->line('   ⏰ Wait 30 seconds and check WhatsApp...');
            } else {
                $this->error('   ❌ RS Sehat template failed');
                $error = $response->json();
                $this->error('   Error: ' . ($error['error']['message'] ?? 'Unknown'));
                
                // Show the message content for debugging
                $this->newLine();
                $this->warn('   📝 Message content that failed:');
                $this->line('   ' . str_replace("\n", "\n   ", $message));
            }
            
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }
        
        $this->newLine();
    }
    
    private function showRecentMessages()
    {
        $this->info('📊 Recent WhatsApp Messages from Logs:');
        $this->line('═══════════════════════════════════════════════════════════');
        
        try {
            $logFile = storage_path('logs/laravel.log');
            if (file_exists($logFile)) {
                $content = file_get_contents($logFile);
                preg_match_all('/WhatsApp message sent successfully.*"message_id":"([^"]+)"/', $content, $matches);
                
                if (!empty($matches[1])) {
                    $this->line('   Recent successful message IDs:');
                    $recentMessages = array_slice($matches[1], -5); // Last 5 messages
                    foreach ($recentMessages as $index => $messageId) {
                        $this->line('   ' . ($index + 1) . '. ' . $messageId);
                    }
                } else {
                    $this->warn('   No successful messages found in logs');
                }
            }
        } catch (\Exception $e) {
            $this->error('   Cannot read log file: ' . $e->getMessage());
        }
        
        $this->newLine();
        $this->info('🔍 Things to Check in WhatsApp:');
        $this->line('1. Open WhatsApp and look for messages from: +15551786297');
        $this->line('2. Check different message types sent in the last few minutes');
        $this->line('3. Look for messages with these patterns:');
        $this->line('   - "Hello! This is a simple test message..."');
        $this->line('   - "🏥 RS Sehat Test 2"');
        $this->line('   - "🏥 RS SEHAT - Konfirmasi Janji Temu"');
        $this->line('4. If none appear, check blocked/spam folder');
        $this->line('5. Try refreshing WhatsApp (close and reopen)');
        
        $this->newLine();
        $this->warn('💡 If messages still don\'t appear:');
        $this->line('• WhatsApp may be filtering business messages in development mode');
        $this->line('• Some content might trigger spam filters');
        $this->line('• Try with simpler text content first');
        $this->line('• Consider submitting for production approval');
    }
    
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^\d+]/', '', $phone);
        $phone = ltrim($phone, '+');
        
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
}
