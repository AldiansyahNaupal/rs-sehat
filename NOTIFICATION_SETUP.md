# Setup Notifikasi Email & WhatsApp - RS Sehat

## 📧 Setup Email Otomatis

### 1. Konfigurasi Gmail SMTP

1. **Enable 2-Factor Authentication** di akun Gmail Anda
2. **Generate App Password**:
   - Buka Google Account Settings
   - Security → 2-Step Verification → App passwords
   - Pilih "Mail" dan "Other" → beri nama "RS Sehat"
   - Copy password yang digenerate

3. **Update file .env**:
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password-dari-google
MAIL_FROM_ADDRESS="noreply@rssehat.com"
MAIL_FROM_NAME="RS Sehat"
MAIL_ENCRYPTION=tls
```

### 2. Alternative Email Providers

#### Menggunakan Mailtrap (untuk testing):
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
```

#### Menggunakan SendGrid:
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
```

---

## 💬 Setup WhatsApp Business API

### 1. Menggunakan Meta WhatsApp Business API (Gratis)

1. **Buat Meta Business Account**:
   - Kunjungi https://business.facebook.com/
   - Buat business account baru

2. **Setup WhatsApp Business API**:
   - Masuk ke Meta for Developers (https://developers.facebook.com/)
   - Buat app baru → Business → WhatsApp
   - Ikuti wizard setup

3. **Dapatkan Credentials**:
   - **Phone Number ID**: Dari WhatsApp → API Setup
   - **Access Token**: Dari WhatsApp → API Setup → Temporary token
   - **Webhook Verify Token**: Buat sendiri (string acak)

4. **Update .env**:
```bash
WHATSAPP_TOKEN=your-temporary-or-permanent-token
WHATSAPP_PHONE_NUMBER_ID=your-phone-number-id
WHATSAPP_WEBHOOK_VERIFY_TOKEN=your-verify-token
```

### 2. Alternative: Menggunakan Twilio

```bash
WHATSAPP_TOKEN=your-twilio-auth-token
WHATSAPP_PHONE_NUMBER_ID=your-twilio-phone-number
WHATSAPP_ACCOUNT_SID=your-twilio-account-sid
```

### 3. Alternative: Menggunakan Wati.io (Mudah untuk bisnis kecil)

```bash
WHATSAPP_TOKEN=your-wati-api-token
WHATSAPP_PHONE_NUMBER_ID=your-wati-phone-number
```

---

## 🚀 Testing Notifikasi

### 1. Test Email
```bash
php artisan tinker
```
```php
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

$appointment = Appointment::first();
Mail::to('test@example.com')->send(new AppointmentConfirmation($appointment));
```

### 2. Test WhatsApp
```bash
php artisan tinker
```
```php
use App\Services\WhatsAppService;
use App\Models\Appointment;

$whatsapp = new WhatsAppService();
$appointment = Appointment::first();
$whatsapp->sendAppointmentConfirmation($appointment);
```

---

## 📅 Setup Pengingat Otomatis

### 1. Tambahkan ke Cron Job (untuk server production)

Edit crontab:
```bash
crontab -e
```

Tambahkan:
```bash
# Kirim pengingat setiap hari jam 6 sore
0 18 * * * cd /path/to/rs-sehat && php artisan appointments:send-reminders
```

### 2. Untuk Development (manual)
```bash
php artisan appointments:send-reminders
```

---

## 🔧 Troubleshooting

### Email Issues

1. **Email tidak terkirim**:
   - Periksa credentials di .env
   - Pastikan "Less secure apps" atau App Password sudah diaktifkan
   - Cek log: `tail -f storage/logs/laravel.log`

2. **Email masuk spam**:
   - Setup SPF, DKIM, DMARC record di DNS
   - Gunakan domain yang sama untuk MAIL_FROM_ADDRESS

### WhatsApp Issues

1. **Message tidak terkirim**:
   - Periksa format nomor telepon
   - Pastikan token masih valid
   - Cek rate limiting Meta API

2. **Template tidak ditemukan**:
   - Buat dan approve template di Meta Business Manager
   - Gunakan fallback ke simple message

---

## 📱 Template WhatsApp di Meta

Buat template dengan nama: `appointment_confirmation`

**Template Body**:
```
Halo {{1}}, janji temu Anda di RS Sehat telah dijadwalkan:

📅 Tanggal: {{2}}
🕐 Waktu: {{3}}
🏥 Layanan: {{4}}
👨‍⚕️ Dokter: {{5}}

Tim kami akan menghubungi Anda untuk konfirmasi. Terima kasih!
```

---

## 💰 Estimasi Biaya

### Email:
- **Gmail**: Gratis (limit 500 email/hari)
- **SendGrid**: $14.95/bulan (40,000 email)
- **Mailgun**: $35/bulan (50,000 email)

### WhatsApp:
- **Meta Business API**: Gratis (1,000 pesan/bulan)
- **Twilio**: $0.005 per pesan
- **Wati.io**: $39/bulan (unlimited)

---

## 🔒 Security Notes

1. **Jangan commit .env** ke repository
2. **Gunakan App Password** untuk Gmail, bukan password utama
3. **Rotate tokens** secara berkala
4. **Monitor usage** untuk menghindari abuse
5. **Backup database** sebelum deploy ke production

---

## 📞 Support

Jika ada kendala dalam setup:
1. Cek dokumentasi Laravel Mail: https://laravel.com/docs/mail
2. Cek dokumentasi WhatsApp Business API: https://developers.facebook.com/docs/whatsapp
3. Contact: developer@rssehat.com
