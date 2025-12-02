# Upload Vendor Folder Manual ke Server

Karena folder `vendor/` sangat besar (~15,000 files), workflow sudah di-set untuk **TIDAK upload vendor/** via GitHub Actions. Anda perlu upload vendor manual.

## 📦 Cara Upload Vendor Manual

### **Opsi 1: Via FTP Client (Recommended)**

**Menggunakan FileZilla atau WinSCP:**

1. **Generate vendor folder di local:**

    ```bash
    composer install --no-dev --optimize-autoloader
    ```

2. **Compress vendor folder:**

    - Windows: Right-click folder `vendor/` → Send to → Compressed (zipped) folder
    - Atau gunakan 7-Zip/WinRAR untuk compress
    - Nama: `vendor.zip`

3. **Upload via FTP:**

    - Connect ke FTP server
    - Navigate ke: `/home/proyek_tik_pkk/wwwroot/proyek-tik-pkk.proyek.jti.polindra.ac.id/upa-kerja-sama/`
    - Upload file `vendor.zip`

4. **Extract di server via aaPanel:**
    - Login aaPanel
    - Files → Navigate ke folder `upa-kerja-sama/`
    - Right-click `vendor.zip` → **Decompress**
    - Pilih "Decompress to current directory"
    - Hapus `vendor.zip` setelah extract

### **Opsi 2: Via aaPanel File Manager**

1. **Compress vendor folder** di local (seperti Opsi 1)

2. **Upload via aaPanel:**

    - Login aaPanel
    - Files → Navigate ke `upa-kerja-sama/`
    - Click **Upload**
    - Select `vendor.zip`
    - Wait for upload (bisa lama, tergantung ukuran)

3. **Extract:**
    - Right-click `vendor.zip` → Decompress
    - Hapus zip file setelah extract

### **Opsi 3: Via Composer di Server (Jika Ada SSH/Terminal)**

Jika aaPanel punya terminal atau SSH access:

```bash
cd /home/proyek_tik_pkk/wwwroot/proyek-tik-pkk.proyek.jti.polindra.ac.id/upa-kerja-sama/
composer install --no-dev --optimize-autoloader
```

## ⚡ Estimasi Waktu

### **Upload vendor.zip (compressed):**

-   Ukuran: ~10-20 MB (compressed)
-   Waktu: 2-5 menit

### **Upload vendor/ folder langsung (tidak compressed):**

-   Files: ~15,000 files
-   Waktu: 20-40 menit

**Jadi lebih cepat upload dalam bentuk ZIP!**

## 📋 Checklist Upload Vendor

-   [ ] Generate vendor folder di local: `composer install --no-dev --optimize-autoloader`
-   [ ] Compress vendor folder menjadi `vendor.zip`
-   [ ] Upload `vendor.zip` ke server via FTP/aaPanel
-   [ ] Extract `vendor.zip` di server
-   [ ] Hapus `vendor.zip` setelah extract
-   [ ] Verify folder `vendor/` ada di server dengan struktur lengkap

## 🔍 Verify Vendor Folder

Setelah upload, pastikan struktur seperti ini:

```
/home/proyek_tik_pkk/wwwroot/proyek-tik-pkk.proyek.jti.polindra.ac.id/upa-kerja-sama/
├── app/
├── vendor/                    ← Folder ini harus ada
│   ├── laravel/
│   ├── spatie/
│   ├── barryvdh/
│   ├── symfony/
│   ├── autoload.php          ← File penting
│   └── ...
├── public/
├── artisan
└── ...
```

## ⚠️ Penting

**Vendor folder hanya perlu di-upload SEKALI** saat setup awal.

**Update vendor** hanya perlu jika:

-   Ada perubahan di `composer.json`
-   Ada update dependencies
-   Dalam kasus ini, upload ulang `vendor.zip` yang baru

## 🚀 Workflow Deployment Setelah Vendor Ter-upload

Setelah vendor manual ter-upload, deployment berikutnya akan **sangat cepat** (2-5 menit) karena hanya upload:

-   Application code
-   Built assets (public/build/)
-   Config files

---

**Dibuat untuk:** UPA Kerja Sama - Laravel Application  
**Last Updated:** December 2025
