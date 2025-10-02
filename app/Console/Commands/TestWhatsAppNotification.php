<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WhatsAppService;
use App\Models\Appointment;

class TestWhatsAppNotification extends Command
{
    protected $signature = 'test:whatsapp {phone : The phone number to send test message} {--mock : Run in mock mode without sending actual messages}';
    
    protected $description = 'Test WhatsApp notification system';

    public function handle()
    {
        $this->info('🧪 Testing WhatsApp Notification System...');
        
        $phone = $this->argument('phone');
        $this->info("📱 Sending test WhatsApp message to: {$phone}");
        
        // Create sample appointment data for testing
        $sampleAppointment = new Appointment();
        $sampleAppointment->patient_name = 'John Doe Testing';
        $sampleAppointment->appointment_date = now()->addDays(3)->format('Y-m-d');
        $sampleAppointment->appointment_time = '10:00:00';
        $sampleAppointment->service_name = 'Konsultasi Dokter Umum';
        $sampleAppointment->doctor_name = 'Dr. Sarah Wilson';
        $sampleAppointment->phone = $phone;
        $sampleAppointment->email = 'test@example.com';
        
        $this->info('📋 Sample appointment data:');
        $this->line("   - Patient: {$sampleAppointment->patient_name}");
        $this->line("   - Date: {$sampleAppointment->appointment_date}");
        $this->line("   - Time: {$sampleAppointment->appointment_time}");
        $this->line("   - Service: {$sampleAppointment->service_name}");
        $this->line("   - Doctor: {$sampleAppointment->doctor_name}");
        $this->line("   - Phone: {$phone}");
        
        try {
            $whatsappService = new WhatsAppService();
            
            // Check if running in mock mode
            if ($this->option('mock')) {
                $this->info('🧪 Running in MOCK mode - no actual messages will be sent');
                $result = [
                    'success' => true,
                    'message_id' => 'wamid.mock_' . time(),
                    'status' => 'sent (mock)',
                    'phone' => $phone
                ];
            } else {
                $result = $whatsappService->sendAppointmentConfirmation($sampleAppointment);
            }
            
            if ($result['success']) {
                $this->info('✅ WhatsApp message sent successfully!');
                $this->line("📱 Message ID: " . ($result['message_id'] ?? 'N/A'));
                $this->line("📊 Status: " . ($result['status'] ?? 'sent'));
                $this->line("📞 Phone: " . ($result['phone'] ?? $phone));
                
                if ($this->option('mock')) {
                    $this->warn('⚠️  This was a MOCK test - no real message was sent');
                }
            } else {
                $this->error('❌ Failed to send WhatsApp message!');
                $this->error('Error: ' . ($result['error'] ?? 'Unknown error'));
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to send WhatsApp message!');
            $this->error('Error: ' . $e->getMessage());
        }
        
        $this->newLine();
        $this->info('🔧 WhatsApp API Configuration Check:');
        $this->line('   - Access Token: ' . (config('services.whatsapp.access_token') ? '✅ Set' : '❌ Not set'));
        $this->line('   - Phone Number ID: ' . (config('services.whatsapp.phone_number_id') ? '✅ Set' : '❌ Not set'));
        $this->line('   - Business Account ID: ' . (config('services.whatsapp.business_account_id') ? '✅ Set' : '❌ Not set'));
        
        $this->newLine();
        $this->info('🔧 Setup Instructions:');
        $this->line('1. Create Meta Developer Account: https://developers.facebook.com/');
        $this->line('2. Create WhatsApp Business App');
        $this->line('3. Get Phone Number ID from WhatsApp Business API');
        $this->line('4. Generate Access Token');
        $this->line('5. Update .env file with your credentials');
        $this->line('6. Add test phone number to your WhatsApp Business Account');
        
        return 0;
    }
}
