# Setup Google OAuth untuk Login Guru

## Langkah 1: Buat Google OAuth Credentials

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang ada
3. Aktifkan Google+ API
4. Buat OAuth 2.0 Client ID:
   - Jenis: Web Application
   - Authorized Redirect URI: `http://localhost:8000/auth/google/callback` (untuk development)
   - Untuk production: sesuaikan dengan domain aplikasi Anda

## Langkah 2: Setup .env

Tambahkan credentials di file `.env`:

```
GOOGLE_CLIENT_ID=your_client_id_here.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

## Langkah 3: Migrasi Database

Jalankan migrasi untuk menambah kolom role ke tabel users:

```bash
php artisan migrate
```

## Fitur Google Login

- Guru bisa login dengan Google di halaman login admin
- Jika email guru sudah terdaftar sebagai admin, langsung masuk ke dashboard
- Jika email baru, otomatis dibuat akun admin baru
- Jika email bukan akun admin, login ditolak

## Alur Login Guru

1. Landing page → Klik "Daftar sebagai guru"
2. Form registrasi guru → Isi data dan buat password
3. Login page → Bisa login dengan email/password ATAU Google
4. Dashboard admin
