# 📱 WhatsApp Business API Setup Guide

## 🚀 Langkah-langkah Setup WhatsApp Business API

### 1. Buat Meta Developer Account
1. Kunjungi: https://developers.facebook.com/
2. Login atau buat akun Meta Developer
3. Verifikasi akun dengan nomor telepon

### 2. Buat WhatsApp Business App
1. Di Meta Developer Console, klik "Create App"
2. Pilih "Business" sebagai app type
3. Masukkan nama app (contoh: "RS Sehat Notifications")
4. Pilih Business Account yang akan digunakan

### 3. Setup WhatsApp Business API
1. Di dashboard app, tambahkan produk "WhatsApp"
2. Setup webhook URL (untuk production)
3. Dapatkan Phone Number ID dari dashboard
4. Generate Access Token dari dashboard

### 4. Konfigurasi .env File
```bash
# WhatsApp Business API Configuration
WHATSAPP_ACCESS_TOKEN=your_actual_access_token_here
WHATSAPP_PHONE_NUMBER_ID=your_actual_phone_number_id_here
WHATSAPP_BUSINESS_ACCOUNT_ID=your_business_account_id_here
WHATSAPP_WEBHOOK_VERIFY_TOKEN=your_webhook_verify_token_here
```

### 5. Testing Mode
Untuk testing, kita bisa menggunakan mode mock yang tidak mengirim pesan asli.

## 🔧 Template Pesan yang Digunakan

### Pesan Konfirmasi Appointment
```
🏥 *RS SEHAT - Konfirmasi Janji Temu*

Halo {{patient_name}},

Terima kasih telah membuat janji temu dengan kami!

📋 *Detail Appointment:*
📅 Tanggal: {{appointment_date}}
🕐 Waktu: {{appointment_time}}
👨‍⚕️ Dokter: {{doctor_name}}
🏥 Layanan: {{service_name}}

📍 *Lokasi:*
RS Sehat
Jl. Kesehatan No. 123
Jakarta Selatan

📞 *Info & Bantuan:*
Call Center: (021) 1234-5678
WhatsApp: +62 811-2345-6789

⚠️ *Penting:*
- Datang 15 menit sebelum jadwal
- Bawa kartu identitas
- Bawa kartu BPJS (jika ada)

Terima kasih atas kepercayaan Anda!

---
RS Sehat - Melayani dengan Sepenuh Hati ❤️
```

## 🧪 Testing Commands

### Test dengan Mock Mode (tanpa credentials)
```bash
php artisan test:whatsapp +6281234567890 --mock
```

### Test dengan Real API (perlu credentials)
```bash
php artisan test:whatsapp +6281234567890
```

### Test Email + WhatsApp bersamaan
```bash
php artisan test:notification email@example.com +6281234567890
```

## 📊 Monitoring & Analytics

### Log WhatsApp Messages
Semua pesan WhatsApp dicatat di:
- `storage/logs/laravel.log`
- Dashboard Meta Business (jika sudah setup)

### Delivery Status
- ✅ Sent: Pesan berhasil dikirim ke WhatsApp
- 📱 Delivered: Pesan sampai ke device pengguna
- 👁️ Read: Pengguna membaca pesan

## 🔐 Security Best Practices

1. **Access Token**: Jangan commit ke repository
2. **Webhook**: Gunakan HTTPS untuk webhook URL
3. **Verify Token**: Gunakan token yang kuat untuk webhook
4. **Rate Limiting**: WhatsApp memiliki limit 1000 pesan/hari untuk testing

## 💰 Pricing (Meta WhatsApp Business API)

### Free Tier
- 1000 percakapan gratis per bulan
- Cocok untuk testing dan hospital kecil

### Paid Tier
- $0.005 - $0.009 per percakapan
- Unlimited messaging
- Advanced analytics

## 🔄 Integration dengan Email

Sistem sudah terintegrasi dengan email:
1. Email dikirim pertama (lebih reliable)
2. WhatsApp dikirim sebagai backup/reminder
3. Jika WhatsApp gagal, user tetap mendapat email

## 🚨 Troubleshooting

### Error: "Invalid OAuth access token"
- Pastikan WHATSAPP_ACCESS_TOKEN benar
- Token mungkin expired, generate ulang

### Error: "Phone number not allowed"
- Tambahkan nomor test ke WhatsApp Business Account
- Verifikasi nomor di Meta Business Manager

### Error: "Rate limit exceeded"
- Tunggu beberapa menit sebelum test lagi
- Upgrade ke paid plan jika perlu volume tinggi

---

*Untuk bantuan lebih lanjut, hubungi Meta Support atau dokumentasi WhatsApp Business API*
