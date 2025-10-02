<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    private $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function create()
    {
        $services = Service::active()->get();
        $doctors = Doctor::active()->get();
        
        return view('appointments.create', compact('services', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'service_id' => 'required|exists:services,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'notes' => 'nullable|string|max:1000'
        ]);

        // Buat appointment
        $appointment = Appointment::create($request->all());

        // Load relasi untuk email dan WhatsApp
        $appointment->load(['service', 'doctor']);

        // Kirim email konfirmasi
        try {
            Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment));
            Log::info('Confirmation email sent successfully', ['appointment_id' => $appointment->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email: ' . $e->getMessage(), ['appointment_id' => $appointment->id]);
        }

        // Kirim WhatsApp notification
        try {
            $whatsappSent = $this->whatsAppService->sendAppointmentConfirmation($appointment);
            if ($whatsappSent) {
                Log::info('WhatsApp notification sent successfully', ['appointment_id' => $appointment->id]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp notification: ' . $e->getMessage(), ['appointment_id' => $appointment->id]);
        }

        return redirect()->route('appointments.success')
            ->with('success', 'Janji temu berhasil dibuat! Kami telah mengirim konfirmasi via email dan WhatsApp.');
    }

    public function success()
    {
        return view('appointments.success');
    }
}
