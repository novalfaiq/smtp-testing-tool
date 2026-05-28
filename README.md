# SMTP Testing Tool

A Laravel web application for testing SMTP connections by sending a real email through any SMTP server you configure — directly from the browser.

Created by [Nauval Faiq](https://github.com/novalfaiq)

## Features

- Dynamic SMTP configuration form (host, port, encryption, credentials)
- Sends a real test email to verify the connection
- Supports TLS, SSL, and unencrypted connections
- Works with Gmail, Outlook, custom SMTP servers, etc.
- Real-time success/error feedback via Blade flash messages

## Requirements

- PHP ^8.3
- Composer
- Node.js & npm
- Laravel 13

## Setup

```bash
composer install
npm install --ignore-scripts && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --force
```

## Running

```bash
composer run dev
```

This starts the Laravel dev server, queue listener, and Vite build in parallel.

## Usage

1. Open `http://localhost:8000/smtp-form`
2. Fill in the SMTP server details (host, port, encryption, username/password)
3. Enter a recipient email address
4. Click "Cek Koneksi SMTP"
5. If the configuration is correct, a test email is sent and you'll see a success message
