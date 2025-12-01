# Setup Database untuk aaPanel (Tanpa SSH)

Panduan lengkap setup database MySQL di aaPanel dan konfigurasi Laravel untuk production.

## 📋 Langkah-langkah Setup Database

### 1. Buat Database di aaPanel

1. **Login ke aaPanel**

    - Akses: `http://your-server-ip:7800` atau `https://your-domain.com:7800`
    - Login dengan credentials aaPanel Anda

2. **Buat Database Baru**

    - Klik menu **Database** di sidebar
    - Klik tombol **Add Database**
    - Isi form:
        - **Database Name**: `upa_kerja_sama` (atau nama lain)
        - **Username**: `upa_user` (atau username lain)
        - **Password**: Generate password yang kuat
        - **Access Permission**: `localhost` (recommended)
    - Klik **Submit**

3. **Catat Informasi Database**
    ```
    DB_HOST: localhost (atau 127.0.0.1)
    DB_PORT: 3306
    DB_DATABASE: upa_kerja_sama
    DB_USERNAME: upa_user
    DB_PASSWORD: [password yang di-generate]
    ```

### 2. Setup File `.env` di Server

Karena tidak ada SSH, Anda perlu membuat file `.env` via FTP atau File Manager aaPanel:

#### **Opsi A: Via File Manager aaPanel**

1. **Buka File Manager**

    - Di aaPanel, klik menu **Files**
    - Navigate ke directory website Anda (biasanya `/www/wwwroot/yourdomain.com/`)

2. **Buat File `.env`**
    - Klik tombol **New File**
    - Nama file: `.env`
    - Copy isi dari `.env.production.example` yang sudah saya buat
    - Edit dengan informasi database Anda:

```env
APP_NAME="UPA Kerja Sama"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# Database Configuration - ISI DENGAN INFO DATABASE ANDA
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=upa_kerja_sama
DB_USERNAME=upa_user
DB_PASSWORD=your_database_password_here

# Broadcast, Cache, Filesystem, Queue, Session
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail Configuration (Brevo SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your_brevo_username
MAIL_PASSWORD=your_brevo_api_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_google_client_id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback

# Vite Configuration
VITE_APP_NAME="${APP_NAME}"
```

3. **Save file**

#### **Opsi B: Via FTP Client**

1. Connect ke server via FTP
2. Navigate ke root directory project
3. Upload file `.env` yang sudah Anda edit
4. Set permission file `.env` ke `644`

### 3. Generate APP_KEY

Karena tidak ada SSH, gunakan file helper yang sudah saya buat:

1. **Upload `artisan-web.php` ke server** (sudah ada di project)
2. **Edit password** di file tersebut
3. **Akses via browser:**
    ```
    https://yourdomain.com/artisan-web.php?pass=your-password
    ```
4. File ini akan otomatis generate APP_KEY jika belum ada

### 4. Set Permissions via aaPanel

1. **Buka File Manager** di aaPanel
2. **Set permissions untuk directories:**
    - `storage/` → 755 atau 775
    - `bootstrap/cache/` → 755 atau 775
3. **Cara set permission:**
    - Right-click pada folder
    - Pilih **Permission**
    - Set ke `755` atau `775`
    - Check **Apply to subdirectories**
    - Click **Submit**

### 5. Import Database (Jika Ada Backup)

Jika Anda punya database backup dari development:

1. **Via phpMyAdmin di aaPanel:**

    - Klik menu **Database**
    - Klik **phpMyAdmin** di database yang sudah dibuat
    - Login dengan credentials database
    - Pilih database Anda
    - Klik tab **Import**
    - Upload file SQL backup
    - Click **Go**

2. **Via File Upload:**
    - Upload file `.sql` ke server
    - Gunakan file helper `import-database.php` (saya akan buatkan)

## 🔧 File Helper untuk Database Management

Saya sudah buatkan file-file helper berikut:

### 1. `artisan-web.php`

-   Generate APP_KEY
-   Run migrations
-   Optimize application
-   Create storage link

### 2. `database-info.php` (akan saya buat)

-   Test koneksi database
-   Lihat informasi database
-   Check migration status

### 3. `migrate-only.php` (akan saya buat)

-   Khusus untuk run migrations
-   Lebih simple dari artisan-web.php

## 📝 Checklist Setup Database

-   [ ] Buat database di aaPanel
-   [ ] Catat credentials database (host, name, user, password)
-   [ ] Buat file `.env` di server via File Manager atau FTP
-   [ ] Isi `.env` dengan database credentials
-   [ ] Upload `artisan-web.php` ke server
-   [ ] Edit password di `artisan-web.php`
-   [ ] Akses `artisan-web.php` via browser untuk generate APP_KEY
-   [ ] Run migrations via `artisan-web.php`
-   [ ] Set permissions untuk `storage/` dan `bootstrap/cache/`
-   [ ] Test website - akses homepage
-   [ ] Hapus `artisan-web.php` setelah selesai

## 🆘 Troubleshooting

### Error: "SQLSTATE[HY000] [1045] Access denied"

**Penyebab:** Database credentials salah

**Solusi:**

1. Check username dan password di `.env`
2. Verify di aaPanel → Database → cek credentials
3. Pastikan user punya permission ke database

### Error: "SQLSTATE[HY000] [2002] Connection refused"

**Penyebab:** DB_HOST salah

**Solusi:**

1. Ganti `DB_HOST=localhost` dengan `DB_HOST=127.0.0.1`
2. Atau sebaliknya

### Error: "Base table or view not found"

**Penyebab:** Migrations belum dijalankan

**Solusi:**

1. Akses `artisan-web.php` untuk run migrations
2. Atau gunakan `migrate-only.php`

### Database Connection Timeout

**Penyebab:** MySQL service tidak running

**Solusi:**

1. Di aaPanel, klik menu **App Store**
2. Cari **MySQL**
3. Click **Restart**

## 🔐 Keamanan

### File `.env`

-   **JANGAN** commit ke Git
-   Set permission `644` (owner read/write, others read)
-   Backup file ini secara terpisah

### Database Password

-   Gunakan password yang kuat
-   Minimal 16 karakter
-   Kombinasi huruf besar, kecil, angka, simbol

### File Helper (artisan-web.php, dll)

-   Selalu gunakan password protection
-   **HAPUS** setelah selesai digunakan
-   Jangan biarkan accessible di production

## 📚 Resources

-   [aaPanel Documentation](https://www.aapanel.com/reference.html)
-   [Laravel Database Configuration](https://laravel.com/docs/11.x/database)
-   [MySQL in aaPanel](https://forum.aapanel.com/d/1234-mysql-configuration)

---

**Dibuat untuk:** UPA Kerja Sama - Laravel Application  
**Platform:** aaPanel (No SSH)  
**Last Updated:** December 2025
