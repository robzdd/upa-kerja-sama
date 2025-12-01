# 🚀 Quick Reference - aaPanel Setup (No SSH)

Panduan cepat untuk deployment di aaPanel tanpa SSH/Terminal.

## 📋 Checklist Setup Database

### 1. Buat Database di aaPanel

```
Login aaPanel → Database → Add Database
- Database Name: upa_kerja_sama
- Username: upa_user
- Password: [generate strong password]
- Access: localhost
```

### 2. Setup File `.env`

```
aaPanel → Files → Navigate ke project directory → New File → .env
```

Copy template dari `.env.production.example` dan edit:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=upa_kerja_sama
DB_USERNAME=upa_user
DB_PASSWORD=your_password_here
```

### 3. Set Permissions

```
aaPanel → Files → Right-click folder:
- storage/ → Permission → 755 atau 775
- bootstrap/cache/ → Permission → 755 atau 775
```

## 🔧 File Helper yang Tersedia

### 1. **artisan-web.php** - Complete Setup

Menjalankan semua artisan commands:

-   ✅ Generate APP_KEY
-   ✅ Run migrations
-   ✅ Create storage link
-   ✅ Clear & optimize caches

**Cara pakai:**

1. Edit password di baris 12
2. Upload ke server via FTP
3. Akses: `https://yourdomain.com/artisan-web.php?pass=your-password`
4. **Hapus file setelah selesai!**

### 2. **database-info.php** - Database Info

Melihat informasi database:

-   ✅ Test koneksi database
-   ✅ List semua tables
-   ✅ Migration status
-   ✅ Environment info
-   ✅ Storage permissions

**Cara pakai:**

1. Edit password di baris 12
2. Upload ke server via FTP
3. Akses: `https://yourdomain.com/database-info.php?pass=your-password`
4. **Hapus file setelah selesai!**

### 3. **migrate-only.php** - Migration Only

Hanya untuk run migrations (simple):

-   ✅ Test database connection
-   ✅ Run migrations
-   ✅ Show migration status

**Cara pakai:**

1. Edit password di baris 12
2. Upload ke server via FTP
3. Akses: `https://yourdomain.com/migrate-only.php?pass=your-password`
4. **Hapus file setelah selesai!**

## 📝 Workflow Deployment

```
1. Setup Database di aaPanel
   ↓
2. Buat file .env via File Manager
   ↓
3. Push code ke GitHub (trigger auto deploy)
   ↓
4. Upload artisan-web.php (edit password dulu!)
   ↓
5. Akses artisan-web.php via browser
   ↓
6. Hapus artisan-web.php
   ↓
7. Test website - Done! ✅
```

## ⚠️ PENTING - Keamanan

### File Helper

-   **SELALU** edit password sebelum upload
-   **HAPUS** file setelah selesai digunakan
-   **JANGAN** commit file helper ke Git

### File `.env`

-   **JANGAN** commit ke Git (sudah di .gitignore)
-   Backup file ini secara terpisah
-   Set permission 644

## 🆘 Troubleshooting Cepat

### Database Connection Failed

```
1. Check .env file - DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
2. Verify database exists di aaPanel
3. Try ganti DB_HOST=localhost dengan DB_HOST=127.0.0.1
```

### 500 Internal Server Error

```
1. Check APP_KEY sudah di-generate (via artisan-web.php)
2. Check permissions storage/ dan bootstrap/cache/ (775)
3. Check error log di storage/logs/laravel.log
```

### Migration Failed

```
1. Gunakan database-info.php untuk test koneksi
2. Check database credentials di .env
3. Pastikan database kosong atau backup dulu jika ada data
```

### File Upload Error

```
1. Check permissions storage/app/ (775)
2. Check disk space di aaPanel
3. Check PHP upload_max_filesize di aaPanel → PHP → Settings
```

## 📚 Dokumentasi Lengkap

-   **DATABASE_SETUP_AAPANEL.md** - Setup database lengkap
-   **DEPLOYMENT.md** - Panduan deployment
-   **DEPLOYMENT_QUICKSTART.md** - Quick start deployment

## 🔗 Links Penting

-   aaPanel: `http://your-server-ip:7800`
-   phpMyAdmin: aaPanel → Database → phpMyAdmin
-   File Manager: aaPanel → Files

---

**Platform:** aaPanel (No SSH)  
**Last Updated:** December 2025
