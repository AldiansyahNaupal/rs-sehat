# 🧪 Setup Mailtrap untuk Testing Email RS Sehat

## 📋 Langkah-langkah Setup Mailtrap

### 1. **Buat Akun Mailtrap**

1. Kunjungi https://mailtrap.io/
2. Klik **"Sign Up"** dan daftar dengan:
   - Email dan password, atau
   - Google/GitHub account
3. Pilih **"Email Testing"** (gratis)
4. Verifikasi email jika diperlukan

### 2. **Dapatkan SMTP Credentials**

1. Setelah login, pilih **"Email Testing"**
2. Klik **"My Inbox"** atau buat inbox baru
3. Di halaman inbox, klik tab **"SMTP Settings"**
4. Pilih **"Laravel 9+"** dari dropdown
5. Copy credentials yang muncul

### 3. **Update File .env**

Copy credentials dari Mailtrap ke file `.env`:

```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=1a2b3c4d5e6f7g    # Username dari Mailtrap
MAIL_PASSWORD=9h8i7j6k5l4m3n    # Password dari Mailtrap
MAIL_FROM_ADDRESS="noreply@rssehat.com"
MAIL_FROM_NAME="RS Sehat"
MAIL_ENCRYPTION=tls
```

### 4. **Test Email System**

Jalankan command test email:

```bash
# Test dengan email tertentu
php artisan test:email your-email@example.com

# Test dengan prompt input
php artisan test:email
```

### 5. **Cara Cek Email di Mailtrap**

1. Buka https://mailtrap.io/inboxes
2. Pilih inbox Anda
3. Email yang dikirim akan muncul di list
4. Klik email untuk melihat:
   - **HTML preview** (tampilan email)
   - **Raw source** (kode HTML)
   - **Text version** 
   - **Headers** (detail teknis)

---

## ✅ **Testing Checklist**

- [ ] Akun Mailtrap sudah dibuat
- [ ] SMTP credentials sudah dicopy
- [ ] File .env sudah diupdate
- [ ] Command `php artisan test:email` berhasil
- [ ] Email muncul di Mailtrap inbox
- [ ] Template email tampil dengan benar
- [ ] All links dan buttons berfungsi

---

## 🔧 **Troubleshooting**

### **Email tidak terkirim:**
```bash
# Cek konfigurasi
php artisan config:clear
php artisan config:cache

# Cek log error
tail -f storage/logs/laravel.log
```

### **Template tidak tampil:**
- Pastikan file `resources/views/emails/appointment-confirmation.blade.php` ada
- Cek permission folder storage
- Clear view cache: `php artisan view:clear`

### **Credentials salah:**
- Re-copy username/password dari Mailtrap
- Pastikan tidak ada spasi di awal/akhir
- Restart server: `php artisan serve`

---

## 🎯 **Keunggulan Mailtrap untuk Development**

1. **Safe Testing**: Email tidak benar-benar terkirim ke user
2. **Unlimited Testing**: Bisa test sebanyak-banyaknya gratis
3. **HTML Preview**: Lihat tampilan email persis seperti di email client
4. **Spam Testing**: Cek apakah email masuk spam atau tidak
5. **Multiple Inboxes**: Bisa buat beberapa inbox untuk testing berbeda
6. **Team Collaboration**: Bisa share inbox dengan tim
7. **API Testing**: Support testing email via API calls

---

## 🚀 **Next Steps Setelah Testing**

Setelah email template sempurna di Mailtrap:

1. **Production**: Ganti ke Gmail/SendGrid untuk live website
2. **WhatsApp**: Setup WhatsApp API untuk notification lengkap
3. **Automation**: Setup cron job untuk reminder email
4. **Analytics**: Track email open rate dan click rate

---

## 📞 **Support**

Jika ada kendala:
- Check dokumentasi Mailtrap: https://mailtrap.io/docs/
- Laravel Mail docs: https://laravel.com/docs/mail
- Contact: support@rssehat.com
