#!/bin/bash

SERVICE="web-projet-app"

cleanup() {
    echo ""
    echo "Ctrl+C detected — restarting $SERVICE..."
    sudo systemctl start $SERVICE
    exit 0
}

# capture Ctrl+C
trap cleanup SIGINT SIGTERM

# stop prod service seulement si il tourne
if systemctl is-active --quiet $SERVICE; then
    echo "Stopping $SERVICE..."
    sudo systemctl stop $SERVICE
fi

# run next dev
echo "Starting Next.js in dev mode..."
npm run dev

# si npm run dev se termine normalement
cleanup
