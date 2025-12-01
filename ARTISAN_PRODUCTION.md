# Cara Menjalankan PHP Artisan di Production

Ada beberapa cara untuk menjalankan perintah `php artisan` di server production setelah deployment.

## 🎯 Pilihan 1: Via SSH (Recommended)

Jika Anda punya akses SSH ke server:

```bash
# Login ke server
ssh username@yourserver.com

# Masuk ke directory project
cd /public_html/  # atau path project Anda

# Jalankan artisan commands
php artisan migrate --force
php artisan key:generate
php artisan storage:link
php artisan optimize
```

## 🌐 Pilihan 2: Via Web (Tanpa SSH)

Jika **TIDAK** ada akses SSH, buat file PHP untuk menjalankan artisan commands via browser.

### Langkah-langkah:

1. **Buat file `artisan-web.php` di root project:**

```php
<?php
// artisan-web.php
// PENTING: Hapus file ini setelah selesai digunakan!

// Password sederhana untuk keamanan
$password = 'your-secure-password-here'; // GANTI INI!

if (!isset($_GET['pass']) || $_GET['pass'] !== $password) {
    die('❌ Unauthorized');
}

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<pre>";
echo "🚀 Running Artisan Commands...\n\n";

// 1. Generate APP_KEY (hanya jika belum ada)
if (empty(env('APP_KEY'))) {
    echo "📝 Generating APP_KEY...\n";
    $kernel->call('key:generate');
    echo "✅ APP_KEY generated\n\n";
} else {
    echo "✅ APP_KEY already exists\n\n";
}

// 2. Run Migrations
echo "🗄️  Running migrations...\n";
$kernel->call('migrate', ['--force' => true]);
echo "✅ Migrations completed\n\n";

// 3. Create Storage Link
echo "🔗 Creating storage link...\n";
try {
    $kernel->call('storage:link');
    echo "✅ Storage link created\n\n";
} catch (Exception $e) {
    echo "⚠️  Storage link already exists or failed: " . $e->getMessage() . "\n\n";
}

// 4. Clear Caches
echo "🧹 Clearing caches...\n";
$kernel->call('cache:clear');
$kernel->call('config:clear');
$kernel->call('route:clear');
$kernel->call('view:clear');
echo "✅ Caches cleared\n\n";

// 5. Optimize Application
echo "⚡ Optimizing application...\n";
$kernel->call('config:cache');
$kernel->call('route:cache');
$kernel->call('view:cache');
$kernel->call('optimize');
echo "✅ Application optimized\n\n";

// 6. Migration Status
echo "📊 Migration Status:\n";
$kernel->call('migrate:status');

echo "\n✅ All tasks completed!\n";
echo "\n⚠️  PENTING: Hapus file artisan-web.php setelah selesai!\n";
echo "</pre>";
```

2. **Upload file `artisan-web.php` ke root project via FTP**

3. **Akses via browser:**

    ```
    https://yourdomain.com/artisan-web.php?pass=your-secure-password-here
    ```

4. **⚠️ PENTING: Hapus file `artisan-web.php` setelah selesai!**

## 🤖 Pilihan 3: Otomatis via GitHub Actions (Advanced)

Tambahkan step di workflow untuk menjalankan artisan commands via SSH.

### Update `.github/workflows/deploy.yml`:

Tambahkan step ini setelah FTP upload:

```yaml
- name: Run Artisan Commands via SSH
  uses: appleboy/ssh-action@v1.0.0
  with:
      host: ${{ secrets.FTP_SERVER }}
      username: ${{ secrets.SSH_USERNAME }}
      password: ${{ secrets.SSH_PASSWORD }}
      # atau gunakan key:
      # key: ${{ secrets.SSH_PRIVATE_KEY }}
      port: 22
      script: |
          cd ${{ secrets.REMOTE_PATH }}
          php artisan migrate --force
          php artisan optimize
          php artisan storage:link
          chmod -R 775 storage bootstrap/cache
```

**GitHub Secrets yang perlu ditambahkan:**

-   `SSH_USERNAME` - Username SSH
-   `SSH_PASSWORD` - Password SSH (atau `SSH_PRIVATE_KEY` jika pakai key)

## 📋 Pilihan 4: Via cPanel Terminal

Jika hosting Anda pakai cPanel:

1. Login ke cPanel
2. Cari **Terminal** atau **SSH Access**
3. Klik untuk membuka terminal
4. Jalankan commands:

```bash
cd public_html  # atau path project Anda
php artisan migrate --force
php artisan key:generate
php artisan storage:link
php artisan optimize
```

## 🔧 Pilihan 5: Via File Manager + PHP Selector

Untuk shared hosting tanpa SSH:

1. **Buat file `run-migrate.php`:**

```php
<?php
$password = 'your-password';
if ($_GET['pass'] ?? '' !== $password) die('Unauthorized');

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<pre>";
$kernel->call('migrate', ['--force' => true]);
echo "Migration completed!";
echo "</pre>";
```

2. **Akses:** `https://yourdomain.com/run-migrate.php?pass=your-password`

3. **Hapus file setelah selesai!**

## 📝 Commands yang Perlu Dijalankan Setelah Deployment

### Pertama Kali Deploy:

```bash
# 1. Generate APP_KEY (WAJIB!)
php artisan key:generate

# 2. Run migrations
php artisan migrate --force

# 3. Create storage symlink
php artisan storage:link

# 4. Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Setiap Deploy Berikutnya:

```bash
# 1. Run migrations (jika ada yang baru)
php artisan migrate --force

# 2. Clear & optimize caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 3. Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## ⚠️ Catatan Penting

### APP_KEY

-   **WAJIB** di-generate sebelum aplikasi bisa jalan
-   Hanya perlu dijalankan sekali saat setup awal
-   Jangan generate ulang jika sudah ada (akan break encrypted data)

### Storage Link

-   Membuat symlink dari `public/storage` ke `storage/app/public`
-   Diperlukan agar uploaded files bisa diakses via web
-   Hanya perlu dijalankan sekali

### Migrations

-   Jalankan setiap kali ada migration baru
-   Gunakan `--force` flag di production (skip confirmation)
-   Check status: `php artisan migrate:status`

### Permissions

-   `storage/` dan `bootstrap/cache/` harus writable (775 atau 777)
-   Jika ada error "Permission denied", set ke 777

## 🆘 Troubleshooting

### Error: "Could not open input file: artisan"

```bash
# Pastikan Anda di directory yang benar
pwd
ls -la artisan  # file artisan harus ada
```

### Error: "Class not found"

```bash
# Install dependencies dulu
composer install --no-dev --optimize-autoloader
```

### Error: "Permission denied"

```bash
# Fix permissions
chmod -R 775 storage bootstrap/cache
# Atau jika masih error:
chmod -R 777 storage bootstrap/cache
```

### Error: "Database connection failed"

```bash
# Check .env file
cat .env | grep DB_

# Test connection
php artisan tinker
>>> DB::connection()->getPdo();
```

## 🎯 Rekomendasi

**Untuk Production:**

1. **Terbaik:** SSH Access (Pilihan 1)
2. **Alternatif:** cPanel Terminal (Pilihan 4)
3. **Darurat:** Web-based artisan (Pilihan 2) - tapi **HAPUS** file setelah selesai!

**Untuk Automation:**

-   Gunakan GitHub Actions + SSH (Pilihan 3) untuk fully automated deployment

---

**Dibuat untuk:** UPA Kerja Sama - Laravel Application  
**Last Updated:** December 2025
