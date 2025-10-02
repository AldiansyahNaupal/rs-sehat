#!/bin/bash

echo "🚀 RS Sehat - Setup Ngrok Demo"
echo "================================"

# Kill existing ngrok processes
echo "🔄 Stopping existing ngrok processes..."
pkill -f ngrok 2>/dev/null

# Start ngrok in background and capture URL
echo "🌐 Starting ngrok..."
ngrok http 8005 > /dev/null 2>&1 &

# Wait for ngrok to start
sleep 3

# Get the ngrok URL
NGROK_URL=$(curl -s http://localhost:4040/api/tunnels | grep -o '"public_url":"[^"]*' | grep https | cut -d'"' -f4)

if [ -z "$NGROK_URL" ]; then
    echo "❌ Failed to get ngrok URL. Please check if ngrok is running."
    exit 1
fi

echo "✅ Ngrok URL: $NGROK_URL"

# Update Laravel .env file
echo "⚙️  Updating Laravel configuration..."
sed -i '' "s|APP_URL=.*|APP_URL=$NGROK_URL|" .env

# Clear Laravel cache
php artisan config:clear > /dev/null 2>&1

echo "🎉 Setup complete!"
echo ""
echo "📱 Access your demo at: $NGROK_URL"
echo "⏰ Keep this terminal open to maintain the connection"
echo ""
echo "💡 To stop: Press Ctrl+C and run 'pkill -f ngrok'"
