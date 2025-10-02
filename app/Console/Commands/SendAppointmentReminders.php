<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'appointments:send-reminders';

    /**
     * The console command description.
     */
    protected $description = 'Send WhatsApp reminders for appointments scheduled for tomorrow';

    private $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        parent::__construct();
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to send appointment reminders...');

        // Ambil janji temu yang dijadwalkan besok
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        
        $appointments = Appointment::where('appointment_date', $tomorrow)
            ->where('status', 'scheduled') // Hanya yang sudah dikonfirmasi
            ->with(['service', 'doctor'])
            ->get();

        if ($appointments->isEmpty()) {
            $this->info('No appointments found for tomorrow.');
            return;
        }

        $successCount = 0;
        $failureCount = 0;

        foreach ($appointments as $appointment) {
            try {
                $sent = $this->whatsAppService->sendAppointmentReminder($appointment);
                
                if ($sent) {
                    $successCount++;
                    $this->info("Reminder sent to {$appointment->name} ({$appointment->phone})");
                    
                    // Update status reminder
                    $appointment->update(['reminder_sent' => true]);
                } else {
                    $failureCount++;
                    $this->error("Failed to send reminder to {$appointment->name}");
                }
                
                // Delay sedikit untuk menghindari rate limiting
                sleep(1);
                
            } catch (\Exception $e) {
                $failureCount++;
                $this->error("Error sending reminder to {$appointment->name}: " . $e->getMessage());
                Log::error('Reminder sending failed', [
                    'appointment_id' => $appointment->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $this->info("Reminders sending completed:");
        $this->info("- Success: {$successCount}");
        $this->info("- Failed: {$failureCount}");
        $this->info("- Total: " . $appointments->count());
    }
}
