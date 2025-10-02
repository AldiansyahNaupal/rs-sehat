# 🚨 WhatsApp API Troubleshooting Guide

## ❌ Problem: "Recipient phone number not in allowed list"

### 📊 Analisis dari Log
```
✅ BERHASIL: WhatsApp sent ke 6285964232183 (appointment_id 4,5)
❌ GAGAL: WhatsApp gagal ke +6281234567890 (not in allowed list)
```

## 🔧 Solusi untuk WhatsApp Business API Development Mode

### 1. **Tambah Nomor ke Allowed List**

**Langkah-langkah:**
1. Login ke **Meta Business Manager**: https://business.facebook.com/
2. Pilih **WhatsApp Business Account** Anda
3. Masuk ke **Phone Numbers** tab
4. Klik **Manage Phone Number List**
5. Tambahkan nomor telepon yang ingin ditest
6. Verifikasi nomor via SMS/call

### 2. **Alternative: Test dengan Nomor yang Sudah Verified**

Dari log, nomor `6285964232183` sudah berhasil menerima pesan. Coba test dengan nomor ini:

```bash
# Test dengan nomor yang sudah working
php artisan test:whatsapp +6285964232183
```

### 3. **Upgrade ke Production Mode (Recommended)**

**Benefits:**
- Bisa kirim ke semua nomor WhatsApp
- Tidak ada limitation allowed list
- Professional messaging capabilities

**Langkah-langkah:**
1. Complete WhatsApp Business verification
2. Submit app untuk review
3. Upload business documents
4. Wait for approval (usually 1-7 days)

## 🧪 Testing Strategy

### A. Development Mode Testing
```bash
# Test dengan nomor yang sudah di allowed list
php artisan test:whatsapp +6285964232183

# Lihat hasilnya di log
tail -f storage/logs/laravel.log
```

### B. Add Multiple Test Numbers
1. Tambah semua nomor tim/tester ke allowed list
2. Test dengan berbagai format nomor
3. Verify message delivery

### C. Mock Testing untuk Development
```bash
# Gunakan mock mode untuk testing tanpa API calls
php artisan test:whatsapp +6281234567890 --mock
```

## 📱 Troubleshooting Common Issues

### Issue 1: "Invalid OAuth access token"
**Solusi:**
- Regenerate access token di Meta Developer Console
- Update WHATSAPP_ACCESS_TOKEN di .env
- Restart application

### Issue 2: "Phone number not in allowed list"
**Solusi:**
- Add number to allowed list di Meta Business Manager
- Verify number dengan SMS/call
- Wait 5-10 minutes untuk propagation

### Issue 3: "Rate limit exceeded"
**Solusi:**
- Wait sebelum test lagi
- Use different test numbers
- Upgrade to paid plan

### Issue 4: Message sent but not received
**Solusi:**
- Check recipient WhatsApp app status
- Verify number format (+62xxx vs 62xxx)
- Check spam/blocked messages

## 🔍 Debugging Commands

### Check API Status
```bash
# Test API connectivity
curl -X GET "https://graph.facebook.com/v18.0/me?access_token=YOUR_ACCESS_TOKEN"
```

### Check Phone Number Status
```bash
# Verify phone number registration
curl -X GET "https://graph.facebook.com/v18.0/YOUR_PHONE_NUMBER_ID?access_token=YOUR_ACCESS_TOKEN"
```

### Monitor Logs
```bash
# Real-time monitoring
tail -f storage/logs/laravel.log | grep -i whatsapp
```

## ✅ Current Working Configuration

Berdasarkan log, konfigurasi Anda sudah BENAR:
- ✅ Access Token valid
- ✅ Phone Number ID valid  
- ✅ API calls successful
- ✅ Message delivery working untuk nomor yang verified

**Yang perlu dilakukan:**
1. Tambah nomor test ke allowed list, ATAU
2. Test dengan nomor yang sudah working: `+6285964232183`
3. Submit untuk production approval untuk unlimited messaging

## 🚀 Next Steps

### Immediate (Today)
1. Test dengan nomor yang sudah working
2. Add nomor tim ke allowed list
3. Verify message templates

### Short-term (This Week)  
1. Submit app untuk production review
2. Complete business verification
3. Setup webhook untuk delivery status

### Long-term (Next Month)
1. Implement advanced features (buttons, media)
2. Setup automated reminders
3. Analytics dan monitoring

---

**Status**: WhatsApp API configuration sudah BENAR! ✅
**Issue**: Hanya limitation development mode untuk allowed numbers
**Solution**: Add numbers to allowed list atau upgrade ke production
