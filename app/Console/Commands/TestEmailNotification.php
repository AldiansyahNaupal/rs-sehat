<?php

namespace App\Console\Commands;

use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'test:email {email? : Email address to send test to}';

    /**
     * The console command description.
     */
    protected $description = 'Test email notification with sample appointment data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testing Email Notification System...');
        
        // Get email from argument or ask user
        $email = $this->argument('email') ?? $this->ask('Enter email address for testing');
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address!');
            return;
        }

        // Create sample appointment data
        $appointment = $this->createSampleAppointment();
        
        $this->info("📧 Sending test email to: {$email}");
        $this->info("📋 Sample appointment data:");
        $this->line("   - Patient: {$appointment->name}");
        $this->line("   - Date: {$appointment->appointment_date}");
        $this->line("   - Time: {$appointment->appointment_time}");
        $this->line("   - Service: " . ($appointment->service->name ?? 'N/A'));
        $this->line("   - Doctor: " . ($appointment->doctor ? 'Dr. ' . $appointment->doctor->name : 'N/A'));

        try {
            // Send email
            Mail::to($email)->send(new AppointmentConfirmation($appointment));
            
            $this->info('✅ Email sent successfully!');
            $this->line('');
            $this->info('📬 Check your Mailtrap inbox:');
            $this->line('   🌐 https://mailtrap.io/inboxes');
            $this->line('');
            $this->info('📧 Email details:');
            $this->line("   From: " . config('mail.from.name') . " <" . config('mail.from.address') . ">");
            $this->line("   To: {$email}");
            $this->line("   Subject: Konfirmasi Janji Temu - RS Sehat");
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to send email!');
            $this->error('Error: ' . $e->getMessage());
            $this->line('');
            $this->info('🔧 Troubleshooting tips:');
            $this->line('   1. Check your .env file configuration');
            $this->line('   2. Verify Mailtrap credentials');
            $this->line('   3. Ensure internet connection');
            $this->line('   4. Check Laravel logs: tail -f storage/logs/laravel.log');
        }
    }

    private function createSampleAppointment()
    {
        // Create temporary appointment object (not saved to database)
        $appointment = new Appointment([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '081234567890',
            'appointment_date' => now()->addDays(2)->format('Y-m-d'),
            'appointment_time' => '10:00',
            'notes' => 'Konsultasi untuk pemeriksaan rutin kesehatan umum'
        ]);

        // Mock service relationship
        $service = new Service([
            'name' => 'Konsultasi Dokter Umum',
            'description' => 'Pemeriksaan kesehatan umum dan konsultasi'
        ]);
        $appointment->setRelation('service', $service);

        // Mock doctor relationship  
        $doctor = new Doctor([
            'name' => 'Sarah Wilson',
            'specialization' => 'Dokter Umum',
            'experience' => '8 tahun pengalaman'
        ]);
        $appointment->setRelation('doctor', $doctor);

        return $appointment;
    }
}
