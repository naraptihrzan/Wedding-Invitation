# Wedding Invitation & RSVP System

Web undangan pernikahan digital dengan fitur RSVP otomatis, pembuatan QR Code (Voucher), notifikasi Email & WhatsApp, serta sistem verifikasi tamu (Scan QR) untuk hari-H.

## 📋 Fitur Utama

- **Landing Page Undangan**: Halaman depan undangan dengan informasi acara.
- **Form RSVP**: Tamu dapat mengisi kehadiran (Hadir/Tidak Hadir).
- **Auto-Generate QR Code**: Jika tamu "Hadir", sistem otomatis membuat QR Code unik.
- **Notifikasi Otomatis**:
  - **Email**: Mengirim QR Code ke email tamu.
  - **WhatsApp**: Mengirim link QR Code ke WhatsApp tamu (via Fonnte API).
- **Admin Dashboard**: Melihat daftar tamu dan status RSVP.
- **QR Scanner (Hari-H)**: Fitur untuk panitia men-scan QR Code tamu saat kedatangan untuk validasi/check-in.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **QR Code**: `endroid/qr-code`
- **WhatsApp API**: Fonnte (Unofficial WA API)
- **Queue**: Database Queue (untuk pengiriman email/WA di background)

## 🚀 Instalasi & Setup

Ikuti langkah-langkah ini untuk menjalankan project di local:

### 1. Clone & Install Dependencies
```bash
git clone <repository-url>
cd Wedding-Invitation

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Konfigurasi Environment (.env)
Copy file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Buka file `.env` dan atur konfigurasi berikut:

**Database:**
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding_invitation
DB_USERNAME=root
DB_PASSWORD=
```

**URL Aplikasi (Penting untuk QR Code):**
```ini
APP_URL=http://localhost:8000
```

**Email (SMTP - Contoh menggunakan Mailtrap/Gmail):**
```ini
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@wedding.com"
MAIL_FROM_NAME="Wedding Invitation"
```

**Fonnte API (WhatsApp):**
Dapatkan API Key di [Fonnte.com](https://fonnte.com).
Tambahkan baris ini di paling bawah `.env`:
```ini
FONNTE_API_KEY=isi_api_key_anda_disini
```

### 3. Generate Key & Migrasi
```bash
php artisan key:generate
php artisan migrate
```

### 4. Setup Storage (PENTING!)
Agar gambar QR Code bisa diakses publik, jalankan:
```bash
php artisan storage:link
```

### 5. Jalankan Aplikasi
Anda perlu menjalankan **3 terminal** terpisah:

**Terminal 1 (Server Laravel):**
```bash
php artisan serve
```

**Terminal 2 (Vite - Frontend):**
```bash
npm run dev
```

**Terminal 3 (Queue Worker - PENTING!):**
Karena pengiriman Email & WA menggunakan `Jobs`, queue worker harus jalan agar pesan terkirim.
```bash
php artisan queue:work
```

## 📖 Cara Penggunaan

### 1. Alur Tamu (RSVP)
1. Buka `http://localhost:8000` (Halaman Utama).
2. Scroll ke bagian **RSVP** (paling bawah).
3. Isi Nama, Email, No HP, dan pilih "Hadir".
4. Submit.
5. Cek Email & WhatsApp (pastikan Queue Worker berjalan). Tamu akan menerima QR Code.

### 2. Alur Admin (Scan QR)
1. Login sebagai Admin (pastikan sudah register/seeding user).
2. Buka `http://localhost:8000/admin/voucher/scan`.
3. Gunakan kamera HP/Laptop untuk scan QR Code tamu.
4. Jika valid, status voucher akan berubah menjadi `used` dan muncul notifikasi sukses.

## ❓ Troubleshooting (Masalah Umum)

### QR Code Tidak Muncul / Gambar Broken
- Pastikan sudah menjalankan `php artisan storage:link`.
- Cek folder `public/storage`, pastikan ada file gambar di dalamnya.
- Pastikan `APP_URL` di `.env` sudah benar (`http://localhost:8000`).

### Email / WhatsApp Tidak Terkirim
- **Cek Queue**: Apakah `php artisan queue:work` sudah dijalankan? Job pengiriman ada di antrian.
- **Cek Log**: Buka `storage/logs/laravel.log` untuk melihat detail error.
- **Fonnte**: Pastikan API Key benar dan kuota Fonnte mencukupi.

### Error saat Scan QR
- Pastikan browser mengizinkan akses kamera.
- Pastikan halaman scan dibuka via `https` atau `localhost` (browser memblokir kamera di http biasa kecuali localhost).

## 📝 To-Do Development
- [ ] Memperbaiki tampilan halaman Scan QR (`resources/views/admin/scan.blade.php`).
- [ ] Menambahkan autentikasi untuk halaman Admin.
- [ ] Integrasi data real-time dashboard.
