<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WhatsAppService;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class TestMultiChannelNotification extends Command
{
    protected $signature = 'test:notification {email : Email address} {phone : Phone number} {--mock : Run WhatsApp in mock mode}';
    
    protected $description = 'Test multi-channel notification system (Email + WhatsApp)';

    public function handle()
    {
        $this->info('🚀 Testing Multi-Channel Notification System...');
        $this->newLine();
        
        $email = $this->argument('email');
        $phone = $this->argument('phone');
        $mockMode = $this->option('mock');
        
        $this->info("📧 Email: {$email}");
        $this->info("📱 WhatsApp: {$phone}");
        $this->info("🧪 Mock Mode: " . ($mockMode ? 'ON' : 'OFF'));
        $this->newLine();
        
        // Create sample appointment data
        $sampleAppointment = new Appointment();
        $sampleAppointment->patient_name = 'Jane Doe Multi-Test';
        $sampleAppointment->appointment_date = now()->addDays(2)->format('Y-m-d');
        $sampleAppointment->appointment_time = '14:30:00';
        $sampleAppointment->service_name = 'Konsultasi Spesialis Jantung';
        $sampleAppointment->doctor_name = 'Dr. Ahmad Cardiology';
        $sampleAppointment->phone = $phone;
        $sampleAppointment->email = $email;
        
        $this->info('📋 Sample appointment data:');
        $this->line("   - Patient: {$sampleAppointment->patient_name}");
        $this->line("   - Date: {$sampleAppointment->appointment_date}");
        $this->line("   - Time: {$sampleAppointment->appointment_time}");
        $this->line("   - Service: {$sampleAppointment->service_name}");
        $this->line("   - Doctor: {$sampleAppointment->doctor_name}");
        $this->newLine();
        
        // Test Email First
        $this->info('📧 Testing Email Notification...');
        try {
            Mail::to($email)->send(new AppointmentConfirmation($sampleAppointment));
            $this->info('✅ Email sent successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Failed to send email!');
            $this->error('Error: ' . $e->getMessage());
        }
        
        $this->newLine();
        
        // Test WhatsApp
        $this->info('📱 Testing WhatsApp Notification...');
        try {
            $whatsappService = new WhatsAppService();
            
            if ($mockMode) {
                $this->info('🧪 Running WhatsApp in MOCK mode');
                $result = [
                    'success' => true,
                    'message_id' => 'wamid.multi_mock_' . time(),
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
                
                if ($mockMode) {
                    $this->warn('⚠️  WhatsApp was in MOCK mode - no real message sent');
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
        $this->info('🎯 Multi-Channel Test Summary:');
        $this->line('   📧 Email: Check your email inbox (or Mailtrap)');
        $this->line('   📱 WhatsApp: ' . ($mockMode ? 'Mock mode - no real message sent' : 'Check your WhatsApp'));
        $this->line('   🔧 Production: Configure real WhatsApp credentials for live testing');
        
        $this->newLine();
        $this->info('💡 Next Steps:');
        $this->line('1. Setup real WhatsApp Business API credentials');
        $this->line('2. Test with real phone numbers');
        $this->line('3. Setup cron jobs for automated reminders');
        $this->line('4. Implement webhook for delivery status');
        
        return 0;
    }
}
