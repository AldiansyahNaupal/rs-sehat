<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private $apiUrl;
    private $token;
    private $phoneNumberId;

    public function __construct()
    {
        // Menggunakan konfigurasi dari config/services.php
        $this->apiUrl = config('services.whatsapp.api_url');
        $this->token = config('services.whatsapp.access_token');
        $this->phoneNumberId = config('services.whatsapp.phone_number_id');
    }

    /**
     * Kirim notifikasi WhatsApp untuk konfirmasi janji temu
     */
    public function sendAppointmentConfirmation($appointment)
    {
        try {
            // Check if credentials are configured
            if (empty($this->token) || empty($this->phoneNumberId)) {
                return [
                    'success' => false,
                    'error' => 'WhatsApp API credentials not configured. Please set WHATSAPP_ACCESS_TOKEN and WHATSAPP_PHONE_NUMBER_ID in .env file.'
                ];
            }

            // Format nomor telepon (hapus 0 di depan, tambah 62)
            $phoneNumber = $this->formatPhoneNumber($appointment->phone);
            
            // Fallback ke simple message jika template tidak tersedia
            $message = $this->buildAppointmentMessage($appointment);
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '/' . $this->phoneNumberId . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $phoneNumber,
                'type' => 'text',
                'text' => [
                    'body' => $message
                ]
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                Log::info('WhatsApp message sent successfully', [
                    'appointment_id' => $appointment->id ?? 'test',
                    'phone' => $phoneNumber,
                    'message_id' => $responseData['messages'][0]['id'] ?? null
                ]);
                
                return [
                    'success' => true,
                    'message_id' => $responseData['messages'][0]['id'] ?? null,
                    'status' => 'sent',
                    'phone' => $phoneNumber
                ];
            } else {
                $errorData = $response->json();
                Log::error('Failed to send WhatsApp message', [
                    'appointment_id' => $appointment->id ?? 'test',
                    'status_code' => $response->status(),
                    'response' => $response->body()
                ]);
                
                return [
                    'success' => false,
                    'error' => $errorData['error']['message'] ?? 'Failed to send WhatsApp message',
                    'status_code' => $response->status(),
                    'phone' => $phoneNumber
                ];
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp service error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Kirim pesan WhatsApp sederhana (fallback jika template tidak tersedia)
     */
    public function sendSimpleMessage($phone, $message)
    {
        try {
            $phoneNumber = $this->formatPhoneNumber($phone);
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . $this->phoneNumberId . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $phoneNumber,
                'type' => 'text',
                'text' => [
                    'body' => $message
                ]
            ]);

            return $response->successful();

        } catch (\Exception $e) {
            Log::error('WhatsApp simple message error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Format nomor telepon untuk WhatsApp API
     */
    private function formatPhoneNumber($phone)
    {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika belum ada kode negara, tambahkan 62
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }

    /**
     * Build pesan WhatsApp untuk konfirmasi janji temu
     */
    private function buildAppointmentMessage($appointment)
    {
        $doctorName = $appointment->doctor_name ?? 'Dokter Umum';
        $serviceName = $appointment->service_name ?? 'Konsultasi Umum';
        $patientName = $appointment->patient_name ?? $appointment->name ?? 'Pasien';
        
        return "🏥 *RS SEHAT - Konfirmasi Janji Temu*\n\n" .
               "Halo *{$patientName}*,\n\n" .
               "Terima kasih telah membuat janji temu dengan kami!\n\n" .
               "📋 *Detail Appointment:*\n" .
               "📅 Tanggal: " . date('d F Y', strtotime($appointment->appointment_date)) . "\n" .
               "🕐 Waktu: {$appointment->appointment_time}\n" .
               "👨‍⚕️ Dokter: {$doctorName}\n" .
               "🏥 Layanan: {$serviceName}\n\n" .
               "� *Lokasi:*\n" .
               "RS Sehat\n" .
               "Jl. Kesehatan No. 123\n" .
               "Jakarta Selatan\n\n" .
               "� *Info & Bantuan:*\n" .
               "Call Center: (021) 1234-5678\n" .
               "WhatsApp: +62 811-2345-6789\n\n" .
               "⚠️ *Penting:*\n" .
               "• Datang 15 menit sebelum jadwal\n" .
               "• Bawa kartu identitas\n" .
               "• Bawa kartu BPJS (jika ada)\n\n" .
               "Terima kasih atas kepercayaan Anda!\n\n" .
               "---\n" .
               "RS Sehat - Melayani dengan Sepenuh Hati ❤️";
    }

    /**
     * Kirim pengingat janji temu (untuk scheduler)
     */
    public function sendAppointmentReminder($appointment)
    {
        $phoneNumber = $this->formatPhoneNumber($appointment->phone);
        $appointmentDate = date('d F Y', strtotime($appointment->appointment_date));
        
        $message = "🔔 *Pengingat Janji Temu RS Sehat*\n\n" .
                   "Halo *{$appointment->name}*,\n\n" .
                   "Mengingatkan janji temu Anda:\n" .
                   "📅 *Besok, {$appointmentDate}*\n" .
                   "🕐 *Pukul:* {$appointment->appointment_time}\n\n" .
                   "📍 RS Sehat, Jl. Kesehatan No. 123\n" .
                   "⏰ Datang 15 menit lebih awal\n\n" .
                   "Sampai jumpa besok! 👋";

        return $this->sendSimpleMessage($appointment->phone, $message);
    }
}
