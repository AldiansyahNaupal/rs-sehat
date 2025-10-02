<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Janji Temu - RS Sehat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        /* Dynamic header based on service type */
        .header {
            @php
                $serviceColors = [
                    'Konsultasi Dokter Umum' => 'linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%)',
                    'Spesialis Jantung' => 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)', 
                    'Spesialis Mata' => 'linear-gradient(135deg, #F59E0B 0%, #D97706 100%)',
                    'Dental' => 'linear-gradient(135deg, #10B981 0%, #059669 100%)',
                    'MCU' => 'linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%)',
                    'default' => 'linear-gradient(135deg, #3B82F6 0%, #10B981 100%)'
                ];
                $serviceName = $appointment->service->name ?? 'default';
                $headerBg = $serviceColors[$serviceName] ?? $serviceColors['default'];
            @endphp
            background: {{ $headerBg }};
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><path d="M0,0v46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1047.21,6.24,1120,13.75V0Z"></path></svg>') repeat-x;
            background-size: 1000px 100px;
            animation: wave 20s linear infinite;
        }
        
        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-1000px); }
        }
        
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            position: relative;
            z-index: 2;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 18px;
            position: relative;
            z-index: 2;
        }
        
        /* Progress Timeline */
        .progress-timeline {
            background: #f8fafc;
            padding: 30px;
            margin: 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .timeline-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }
        
        .timeline-line {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            z-index: 1;
        }
        
        .timeline-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: {{ $headerBg }};
            border-radius: 2px;
            width: 33.33%;
            transition: width 2s ease;
        }
        
        .timeline-step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }
        
        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .timeline-step.completed .timeline-icon {
            background: {{ str_replace(['linear-gradient(135deg, ', ' 100%)'], ['', ''], $headerBg) }};
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .timeline-step.active .timeline-icon {
            background: #FEF3C7;
            color: #D97706;
            border: 3px solid #F59E0B;
            animation: pulse 2s infinite;
        }
        
        .timeline-step.pending .timeline-icon {
            background: #F3F4F6;
            color: #9CA3AF;
            border: 2px solid #E5E7EB;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        
        .timeline-label {
            font-size: 12px;
            font-weight: 600;
            color: #6B7280;
            margin-top: 5px;
        }
        
        .timeline-step.completed .timeline-label {
            color: #374151;
        }
        
        .timeline-step.active .timeline-label {
            color: #D97706;
        }
        
        .content {
            padding: 30px;
        }
        .success-badge {
            background: {{ $headerBg }};
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            animation: slideInDown 0.8s ease;
        }
        
        @keyframes slideInDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        /* Doctor Profile Card */
        .doctor-profile {
            background: linear-gradient(45deg, #f8fafc 0%, #ffffff 100%);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .doctor-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .doctor-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: {{ $headerBg }};
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-right: 20px;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .doctor-info h3 {
            margin: 0 0 5px 0;
            color: #1f2937;
            font-size: 24px;
            font-weight: 700;
        }
        
        .doctor-specialization {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .doctor-rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .stars {
            color: #F59E0B;
            font-size: 16px;
        }
        
        .rating-text {
            color: #6b7280;
            font-size: 14px;
        }
        
        /* Enhanced Appointment Details */
        .appointment-details {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .appointment-details h3 {
            margin-top: 0;
            color: #1f2937;
            font-size: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #f3f4f6;
            text-align: center;
        }
        
        .detail-icon {
            font-size: 24px;
            margin-bottom: 8px;
            display: block;
        }
        
        .detail-label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }
        
        /* Countdown Timer */
        .countdown-section {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border: 1px solid #F59E0B;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        
        .countdown-title {
            color: #92400E;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .countdown-item {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .countdown-number {
            font-size: 24px;
            font-weight: 700;
            color: #92400E;
            display: block;
        }
        
        .countdown-label {
            font-size: 12px;
            color: #92400E;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        /* Weather Widget */
        .weather-widget {
            background: linear-gradient(135deg, #EBF8FF 0%, #DBEAFE 100%);
            border: 1px solid #3B82F6;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        
        .weather-title {
            color: #1E40AF;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .weather-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .weather-icon {
            font-size: 32px;
        }
        
        .weather-temp {
            font-size: 24px;
            font-weight: 700;
            color: #1E40AF;
        }
        
        .weather-desc {
            color: #3B82F6;
            font-size: 14px;
        }
            border-left: 4px solid #3B82F6;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .detail-label {
            font-weight: 600;
            color: #374151;
        }
        .detail-value {
            color: #6b7280;
            text-align: right;
        }
        .next-steps {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .next-steps h3 {
            color: #92400e;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .step-number {
            background-color: #3B82F6;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .step-text {
            color: #92400e;
        }
        .contact-info {
            background-color: #eff6ff;
            border: 1px solid #3B82F6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .contact-info h3 {
            color: #1e40af;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #1e40af;
        }
        .contact-item:last-child {
            margin-bottom: 0;
        }
        .contact-icon {
            width: 20px;
            margin-right: 10px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px 10px 10px 0;
        }
        .button:hover {
            opacity: 0.9;
        }
        .footer {
            background-color: #f8fafc;
            padding: 30px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .footer a {
            color: #3B82F6;
            text-decoration: none;
        }
        @media only screen and (max-width: 600px) {
            .container {
                margin: 0;
            }
            .header, .content, .footer {
                padding: 20px;
            }
            .detail-row {
                flex-direction: column;
            }
            .detail-value {
                text-align: left;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🏥 RS Sehat</h1>
            <p>Rumah Sakit Terdepan untuk Kesehatan Anda</p>
        </div>

        <!-- Progress Timeline -->
        <div class="progress-timeline">
            <div class="timeline-container">
                <div class="timeline-line">
                    <div class="timeline-progress"></div>
                </div>
                
                <div class="timeline-step completed">
                    <div class="timeline-icon">✓</div>
                    <div class="timeline-label">Booking</div>
                </div>
                
                <div class="timeline-step active">
                    <div class="timeline-icon">📞</div>
                    <div class="timeline-label">Konfirmasi</div>
                </div>
                
                <div class="timeline-step pending">
                    <div class="timeline-icon">🏥</div>
                    <div class="timeline-label">Kunjungan</div>
                </div>
                
                <div class="timeline-step pending">
                    <div class="timeline-icon">✨</div>
                    <div class="timeline-label">Selesai</div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="success-badge">
                ✅ Janji Temu Berhasil Dibuat
            </div>

            <h2>Halo {{ $appointment->name }},</h2>
            
            <p>Terima kasih telah mempercayakan kesehatan Anda kepada <strong>RS Sehat</strong>. Janji temu Anda telah berhasil dijadwalkan dan sedang dalam proses konfirmasi.</p>

            @if($appointment->doctor)
            <!-- Doctor Profile Card -->
            <div class="doctor-profile">
                <div class="doctor-header">
                    <div class="doctor-avatar">
                        {{ substr($appointment->doctor->name, 0, 1) }}
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. {{ $appointment->doctor->name }}</h3>
                        <div class="doctor-specialization">{{ $appointment->doctor->specialization }}</div>
                        <div class="doctor-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="rating-text">(4.9/5 • 127 reviews)</span>
                        </div>
                    </div>
                </div>
                <p style="margin: 0; color: #6b7280; font-size: 14px;">
                    <strong>Pengalaman:</strong> {{ $appointment->doctor->experience ?? '10+ tahun di bidang ' . $appointment->doctor->specialization }}
                </p>
            </div>
            @endif

            <!-- Countdown Timer -->
            @php
                try {
                    // Parse date and time separately to avoid format conflicts
                    $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date);
                    $appointmentTime = \Carbon\Carbon::parse($appointment->appointment_time);
                    
                    // Combine date and time
                    $appointmentDateTime = $appointmentDate->setTimeFromTimeString($appointmentTime->format('H:i:s'));
                    $now = \Carbon\Carbon::now();
                    $diff = $appointmentDateTime->diff($now);
                } catch (\Exception $e) {
                    // Fallback if parsing fails
                    $appointmentDateTime = \Carbon\Carbon::parse($appointment->appointment_date);
                    $now = \Carbon\Carbon::now();
                    $diff = $appointmentDateTime->diff($now);
                }
            @endphp
            
            <div class="countdown-section">
                <div class="countdown-title">⏰ Waktu Menuju Appointment Anda</div>
                <div class="countdown-timer">
                    <div class="countdown-item">
                        <span class="countdown-number">{{ $diff->days }}</span>
                        <span class="countdown-label">Hari</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number">{{ $diff->h }}</span>
                        <span class="countdown-label">Jam</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number">{{ $diff->i }}</span>
                        <span class="countdown-label">Menit</span>
                    </div>
                </div>
                <p style="margin: 0; color: #92400E; font-size: 14px;">
                    📅 {{ $appointmentDateTime->format('l, d F Y \p\u\k\u\l H:i') }}
                </p>
            </div>

            <!-- Weather Info (Mock data for demo) -->
            <div class="weather-widget">
                <div class="weather-title">🌤️ Cuaca untuk {{ date('d M Y', strtotime($appointment->appointment_date)) }}</div>
                <div class="weather-info">
                    <div class="weather-icon">☀️</div>
                    <div>
                        <div class="weather-temp">28°C</div>
                        <div class="weather-desc">Cerah berawan</div>
                    </div>
                </div>
                <p style="margin: 10px 0 0 0; color: #3B82F6; font-size: 12px;">
                    💡 Cuaca bagus untuk perjalanan ke RS Sehat
                </p>
            </div>

            <!-- Enhanced Appointment Details -->
            <div class="appointment-details">
                <h3>📋 Detail Janji Temu</h3>
                
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-icon">📅</span>
                        <div class="detail-label">Tanggal</div>
                        <div class="detail-value">{{ date('d M Y', strtotime($appointment->appointment_date)) }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-icon">🕐</span>
                        <div class="detail-label">Waktu</div>
                        <div class="detail-value">{{ $appointment->appointment_time }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-icon">🏥</span>
                        <div class="detail-label">Layanan</div>
                        <div class="detail-value">{{ $appointment->service->name ?? 'Umum' }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-icon">📱</span>
                        <div class="detail-label">Telepon</div>
                        <div class="detail-value">{{ $appointment->phone }}</div>
                    </div>
                </div>
                
                @if($appointment->notes)
                <div style="background: #F9FAFB; padding: 15px; border-radius: 8px; margin-top: 15px;">
                    <div class="detail-label" style="margin-bottom: 8px;">📝 Catatan Khusus:</div>
                    <div style="color: #374151; font-style: italic;">{{ $appointment->notes }}</div>
                </div>
                @endif
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>🚀 Langkah Selanjutnya</h3>
                
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-text">
                        <strong>Konfirmasi Telepon:</strong> Tim kami akan menghubungi Anda dalam 2-4 jam untuk mengonfirmasi jadwal dan memberikan instruksi persiapan.
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-text">
                        <strong>Persiapan Dokumen:</strong> Siapkan kartu identitas, kartu BPJS/asuransi, dan riwayat kesehatan Anda.
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-text">
                        <strong>Kunjungi RS Sehat:</strong> Datang 15 menit lebih awal untuk proses administrasi.
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h3>📞 Butuh Bantuan?</h3>
                
                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <span><strong>Telepon:</strong> (021) 123-4567</span>
                </div>
                
                <div class="contact-item">
                    <span class="contact-icon">📧</span>
                    <span><strong>Email:</strong> info@rssehat.com</span>
                </div>
                
                <div class="contact-item">
                    <span class="contact-icon">💬</span>
                    <span><strong>WhatsApp:</strong> +62 812-3456-7890</span>
                </div>
                
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <span><strong>Alamat:</strong> Jl. Kesehatan No. 123, Jakarta Pusat</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="https://wa.me/6281234567890?text=Halo%20RS%20Sehat%2C%20saya%20ingin%20konfirmasi%20janji%20temu%20atas%20nama%20{{ urlencode($appointment->name) }}" class="button">
                    💬 Hubungi via WhatsApp
                </a>
                <a href="tel:+622112345678" class="button">
                    📞 Telepon Sekarang
                </a>
            </div>

            <!-- Important Note -->
            <div style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 6px; padding: 15px; margin: 20px 0;">
                <p style="margin: 0; color: #991b1b; font-size: 14px;">
                    <strong>⚠️ Penting:</strong> Jika Anda perlu membatalkan atau mengubah jadwal, hubungi kami minimal 24 jam sebelumnya untuk menghindari biaya pembatalan.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                Email ini dikirim otomatis oleh sistem RS Sehat.<br>
                Jangan balas email ini. Untuk pertanyaan, hubungi <a href="mailto:info@rssehat.com">info@rssehat.com</a>
            </p>
            <p>
                <a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a> | <a href="#">Unsubscribe</a>
            </p>
            <p style="margin-top: 20px; color: #9ca3af;">
                © {{ date('Y') }} RS Sehat. Hak cipta dilindungi undang-undang.
            </p>
        </div>
    </div>
</body>
</html>
