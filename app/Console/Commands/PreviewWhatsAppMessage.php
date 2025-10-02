<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WhatsAppService;
use App\Models\Appointment;
use ReflectionClass;

class PreviewWhatsAppMessage extends Command
{
    protected $signature = 'preview:whatsapp-message {--patient=John Doe} {--date=tomorrow} {--time=10:00} {--service=Konsultasi Dokter Umum} {--doctor=Dr. Sarah Wilson}';
    
    protected $description = 'Preview WhatsApp message template without sending';

    public function handle()
    {
        $this->info('📱 WhatsApp Message Preview');
        $this->line('═══════════════════════════════════════════════════════════');
        
        // Create sample appointment from options
        $sampleAppointment = new Appointment();
        $sampleAppointment->patient_name = $this->option('patient');
        $sampleAppointment->appointment_date = date('Y-m-d', strtotime($this->option('date')));
        $sampleAppointment->appointment_time = $this->option('time') . ':00';
        $sampleAppointment->service_name = $this->option('service');
        $sampleAppointment->doctor_name = $this->option('doctor');
        $sampleAppointment->phone = '+6281234567890';
        
        // Use reflection to access private method
        $whatsappService = new WhatsAppService();
        $reflection = new ReflectionClass($whatsappService);
        $method = $reflection->getMethod('buildAppointmentMessage');
        $method->setAccessible(true);
        
        $message = $method->invoke($whatsappService, $sampleAppointment);
        
        $this->newLine();
        $this->info('📋 Appointment Details:');
        $this->line("Patient: {$sampleAppointment->patient_name}");
        $this->line("Date: " . date('d F Y', strtotime($sampleAppointment->appointment_date)));
        $this->line("Time: {$sampleAppointment->appointment_time}");
        $this->line("Service: {$sampleAppointment->service_name}");
        $this->line("Doctor: {$sampleAppointment->doctor_name}");
        
        $this->newLine();
        $this->info('📱 WhatsApp Message:');
        $this->line('─────────────────────────────────────────────────────────');
        $this->line($message);
        $this->line('─────────────────────────────────────────────────────────');
        
        $this->newLine();
        $this->info('📊 Message Statistics:');
        $this->line('Characters: ' . strlen($message));
        $this->line('Lines: ' . substr_count($message, "\n") + 1);
        $this->line('Words: ' . str_word_count($message));
        
        $this->newLine();
        $this->info('💡 Usage Examples:');
        $this->line('php artisan preview:whatsapp-message');
        $this->line('php artisan preview:whatsapp-message --patient="Jane Smith" --date="next monday" --time="14:30"');
        $this->line('php artisan preview:whatsapp-message --service="Konsultasi Spesialis Jantung" --doctor="Dr. Ahmad Cardiology"');
        
        return 0;
    }
}
