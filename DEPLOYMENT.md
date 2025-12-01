-   ✅ Repository GitHub dengan project ini
-   ✅ Akses FTP ke server production
-   ✅ Database MySQL/PostgreSQL di server production
-   ✅ PHP 8.2+ di server production
-   ✅ Composer installed di server production

## Setup GitHub Secrets

GitHub Secrets digunakan untuk menyimpan informasi sensitif seperti credentials FTP.

### Langkah-langkah:

1. **Buka Repository Settings**

    - Masuk ke repository GitHub Anda
    - Klik **Settings** → **Secrets and variables** → **Actions**

2. **Tambahkan Secrets Berikut:**

    | Secret Name    | Deskripsi                | Contoh                                 |
    | -------------- | ------------------------ | -------------------------------------- |
    | `FTP_SERVER`   | Alamat FTP server        | `ftp.example.com` atau `192.168.1.100` |
    | `FTP_USERNAME` | Username FTP             | `username@example.com`                 |
    | `FTP_PASSWORD` | Password FTP             | `your-secure-password`                 |
    | `FTP_PORT`     | Port FTP (biasanya 21)   | `21`                                   |
    | `REMOTE_PATH`  | Path direktori di server | `/public_html/` atau `/htdocs/`        |

3. **Cara Menambahkan Secret:**
    - Klik **New repository secret**
    - Masukkan **Name** (contoh: `FTP_SERVER`)
    - Masukkan **Value** (contoh: `ftp.example.com`)
    - Klik **Add secret**
    - Ulangi untuk semua secrets di atas

## Konfigurasi FTP Server

### Persyaratan Server:

1. **FTP Access**

    - Pastikan FTP service aktif
    - Port 21 (atau custom port) terbuka
    - Username dan password sudah dibuat

2. **Directory Structure**

    ```
    /public_html/  (atau /htdocs/)
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── public/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    └── .env
    ```

3. **Permissions**
    - `storage/` → 775 atau 777
    - `bootstrap/cache/` → 775 atau 777
    - Files lainnya → 644
    - Directories lainnya → 755

### Set Permissions via FTP/SSH:

```bash
# Via SSH
chmod -R 775 storage
chmod -R 775 bootstrap/cache
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
```

## Environment Production

### 1. Buat File `.env` di Server

Setelah deployment pertama, buat file `.env` di root directory server dengan konfigurasi berikut:

```env
APP_NAME="UPA Kerja Sama"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Session & Cache
SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Mail Configuration (Brevo/SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your_brevo_username
MAIL_PASSWORD=your_brevo_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
```

### 2. Generate APP_KEY

Jika belum ada APP_KEY, generate via SSH:

```bash
php artisan key:generate
```

### 3. Update Google OAuth Redirect URI

Di [Google Cloud Console](https://console.cloud.google.com/):

-   Masuk ke **APIs & Services** → **Credentials**
-   Edit OAuth 2.0 Client ID Anda
-   Tambahkan Authorized redirect URI: `https://yourdomain.com/auth/google/callback`

## Database Migration

### Otomatis (Recommended)

Workflow sudah include deployment notification, tapi migration harus dijalankan manual di server untuk keamanan.

### Manual via SSH:

```bash
# 1. Masuk ke directory project
cd /public_html/

# 2. Run migrations
php artisan migrate --force

# 3. Verify migrations
php artisan migrate:status
```

### Manual via FTP + Web:

Jika tidak ada SSH access, buat file `migrate.php` di root:

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('migrate', ['--force' => true]);
echo "Migration completed!";
```

Akses via browser: `https://yourdomain.com/migrate.php`

**⚠️ PENTING:** Hapus file `migrate.php` setelah selesai!

### Database Tables yang Akan Dibuat:

Total **39 migrations** akan membuat tables:

-   `users` - User authentication
-   `alumnis` - Data alumni
-   `mitra_perusahaans` - Data perusahaan mitra
-   `lowongan_pekerjaans` - Job postings
-   `pelamars` - Job applications
-   `artikels` - Articles/news
-   `dokumen_publiks` - Public documents
-   `program_studis` - Study programs
-   `riwayat_pendidikan` - Education history
-   `pengalaman_kerja_organisasi` - Work experience
-   `pengalaman_sertifikasi` - Certifications
-   `saved_jobs` - Saved job listings
-   `notifications` - User notifications
-   Dan lainnya...

## Cara Deploy

### Deployment Otomatis (Push to Main)

Setiap kali Anda push ke branch `main`, deployment akan otomatis berjalan:

```bash
git add .
git commit -m "Your commit message"
git push origin main
```

### Deployment Manual (Workflow Dispatch)

1. Buka repository di GitHub
2. Klik tab **Actions**
3. Pilih workflow **Deploy to Production via FTP**
4. Klik **Run workflow**
5. Pilih branch `main`
6. Klik **Run workflow**

### Monitor Deployment

1. Buka tab **Actions** di GitHub
2. Klik pada workflow run yang sedang berjalan
3. Lihat progress setiap step
4. Jika ada error, check logs untuk detail

## Post-Deployment Tasks

Setelah deployment selesai, jalankan tasks berikut di server:

### 1. Database Migration

```bash
php artisan migrate --force
```

### 2. Optimize Application

```bash
php artisan optimize
```

### 3. Create Storage Link

```bash
php artisan storage:link
```

### 4. Clear Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 5. Set Permissions

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Running Artisan Commands

Ada beberapa cara untuk menjalankan `php artisan` commands di production server:

### 📚 Dokumentasi Lengkap

Lihat [ARTISAN_PRODUCTION.md](./ARTISAN_PRODUCTION.md) untuk panduan lengkap dengan berbagai metode:

1. **Via SSH** (Recommended) - Akses langsung ke server
2. **Via Web** - Menggunakan `artisan-web.php` untuk server tanpa SSH
3. **Via cPanel Terminal** - Untuk hosting dengan cPanel
4. **Otomatis via GitHub Actions** - Lihat [GITHUB_ACTIONS_SSH.md](./GITHUB_ACTIONS_SSH.md)

### 🚀 Quick Start

**Jika punya SSH access:**

```bash
ssh username@yourserver.com
cd /public_html/
php artisan migrate --force
php artisan optimize
php artisan storage:link
```

**Jika TIDAK ada SSH access:**

1. Upload file `artisan-web.php` ke server
2. Edit password di file tersebut
3. Akses: `https://yourdomain.com/artisan-web.php?pass=your-password`
4. **Hapus file setelah selesai!**

## Troubleshooting

### ❌ FTP Connection Failed

**Penyebab:**

-   FTP credentials salah
-   FTP port salah
-   Firewall blocking

**Solusi:**

-   Verify FTP credentials di GitHub Secrets
-   Check FTP port (biasanya 21, tapi bisa custom)
-   Contact hosting provider untuk whitelist GitHub Actions IP

### ❌ Composer Install Failed

**Penyebab:**

-   Memory limit
-   Missing PHP extensions

**Solusi:**

-   Workflow sudah set memory limit, tapi jika masih error:
    -   Check GitHub Actions logs
    -   Verify `composer.lock` ada di repository

### ❌ NPM Build Failed

**Penyebab:**

-   Node version mismatch
-   Missing dependencies

**Solusi:**

-   Workflow menggunakan Node 20
-   Pastikan `package-lock.json` ada di repository
-   Check build logs untuk error spesifik

### ❌ Migration Failed

**Penyebab:**

-   Database credentials salah
-   Database tidak exist
-   Permissions issue

**Solusi:**

```bash
# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Create database jika belum ada
mysql -u username -p
CREATE DATABASE your_database_name;

# Check migration status
php artisan migrate:status
```

### ❌ 500 Internal Server Error

**Penyebab:**

-   `.env` tidak ada atau salah
-   Storage permissions
-   APP_KEY tidak di-set

**Solusi:**

```bash
# Check .env file exists
ls -la .env

# Generate APP_KEY
php artisan key:generate

# Fix permissions
chmod -R 775 storage bootstrap/cache

# Check error logs
tail -f storage/logs/laravel.log
```

### ❌ Google OAuth Not Working

**Penyebab:**

-   Redirect URI tidak match
-   Client ID/Secret salah

**Solusi:**

1. Verify `.env`:

    ```env
    GOOGLE_CLIENT_ID=your_client_id
    GOOGLE_CLIENT_SECRET=your_secret
    GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
    ```

2. Update Google Cloud Console:
    - Authorized redirect URIs harus exact match
    - Include production URL

### ❌ Assets Not Loading (CSS/JS)

**Penyebab:**

-   Vite build tidak ter-upload
-   Asset path salah

**Solusi:**

```bash
# Verify public/build/ exists
ls -la public/build/

# Re-run build locally dan commit
npm run build
git add public/build
git commit -m "Add built assets"
git push
```

## Dependencies yang Ter-install

### Composer Packages:

-   ✅ Laravel Framework 11.31
-   ✅ Laravel Socialite 5.23 (Google OAuth)
-   ✅ Spatie Laravel Permission 6.21 (Roles & Permissions)
-   ✅ Barryvdh Laravel DomPDF 3.1 (PDF Generation)
-   ✅ Symfony Mailer (Email)
-   ✅ Laravel Tinker 2.9

### NPM Packages:

-   ✅ Vite 6.0.11
-   ✅ Laravel Vite Plugin 1.2.0
-   ✅ TailwindCSS 3.4.13
-   ✅ Axios 1.7.4
-   ✅ PostCSS & Autoprefixer

## Support

Jika mengalami masalah yang tidak tercantum di troubleshooting:

1. Check GitHub Actions logs
2. Check server error logs (`storage/logs/laravel.log`)
3. Contact hosting provider untuk server-specific issues

---

**Dibuat untuk:** UPA Kerja Sama - Laravel Application  
**Last Updated:** December 2025
