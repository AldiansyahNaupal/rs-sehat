#!/bin/bash

echo "🚀 RS Sehat - Setup Demo Online dengan Ngrok"
echo "=============================================="
echo ""

# Check if ngrok is installed
if ! command -v ngrok &> /dev/null; then
    echo "❌ Ngrok tidak ditemukan. Installing..."
    brew install ngrok
fi

echo "📋 Langkah-langkah setup:"
echo "1. Copy authtoken dari: https://dashboard.ngrok.com/get-started/your-authtoken"
echo "2. Jalankan: ngrok config add-authtoken YOUR_TOKEN"
echo "3. Jalankan: ngrok http 8001"
echo ""

# Check if Laravel server is running
if lsof -Pi :8001 -sTCP:LISTEN -t >/dev/null ; then
    echo "✅ Laravel server sudah berjalan di port 8001"
else
    echo "🔄 Starting Laravel server..."
    cd /Users/naupalshidqi/rs-sehat
    php artisan serve --port=8001 &
    sleep 3
    echo "✅ Laravel server started di http://localhost:8001"
fi

echo ""
echo "🌐 Setelah setup ngrok, Anda akan mendapat URL seperti:"
echo "   https://abc123.ngrok-free.app"
echo ""
echo "📱 URL tersebut bisa diakses dari mana saja di internet!"
echo "⏰ Server akan tetap online selama terminal ngrok berjalan"
echo ""
echo "💡 Tips:"
echo "   - Jangan tutup terminal Laravel server"
echo "   - Jangan tutup terminal ngrok"
echo "   - Share URL ngrok untuk demo"
