# Konfigurasi Email Brevo untuk Sistem Registrasi Mitra

## Setup Brevo (Sendinblue)

### 1. Dapatkan API Key dari Brevo

1. Login ke [Brevo](https://www.brevo.com/)
2. Go to **Settings** → **SMTP & API**
3. Generate **SMTP Key** atau **API Key**
4. Copy key tersebut

### 2. Konfigurasi di File `.env`

Tambahkan konfigurasi berikut di file `.env`:

```env
# Email Configuration - Brevo (Sendinblue)
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-brevo-email@example.com
MAIL_PASSWORD=your-brevo-smtp-key-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@polindra.ac.id
MAIL_FROM_NAME="${APP_NAME}"

# Admin Email (untuk menerima notifikasi registrasi mitra)
MAIL_ADMIN_EMAIL=admin@polindra.ac.id
```

**Penjelasan:**

-   `MAIL_USERNAME`: Email yang Anda daftarkan di Brevo
-   `MAIL_PASSWORD`: SMTP Key dari Brevo (bukan password email Anda)
-   `MAIL_FROM_ADDRESS`: Email pengirim (bisa custom domain atau email Brevo)
-   `MAIL_ADMIN_EMAIL`: Email admin yang akan menerima notifikasi

### 3. Install Package (Jika Belum)

Laravel sudah include mail support, tapi pastikan dependencies terinstall:

```bash
composer require symfony/mailer
```

### 4. Test Email

Test apakah konfigurasi email sudah benar:

```bash
php artisan tinker
```

Kemudian jalankan:

```php
Mail::raw('Test email from Laravel', function($message) {
    $message->to('test@example.com')->subject('Test Email');
});
```

## Cara Kerja Sistem

### Flow Registrasi Mitra:

1. **Mitra mengisi form** di `/mitra/register`
2. **Data tersimpan** di tabel `mitra_registration_requests` dengan status "pending"
3. **Email otomatis terkirim** ke admin (sesuai `MAIL_ADMIN_EMAIL`)
4. **Admin login** dan review request di admin panel
5. **Admin approve/reject** request
6. **Email terkirim** ke mitra dengan hasil (approved/rejected)
7. **Jika approved**: Akun mitra otomatis dibuat, credentials dikirim via email

### Email yang Dikirim:

1. **Ke Admin** - Saat ada registrasi baru

    - Subject: "Request Registrasi Mitra Baru dari [Nama Perusahaan]"
    - Berisi: Detail perusahaan + link ke admin panel

2. **Ke Mitra** - Saat di-approve (akan dibuat nanti)

    - Subject: "Akun Mitra Anda Telah Disetujui"
    - Berisi: Email + password untuk login

3. **Ke Mitra** - Saat di-reject (akan dibuat nanti)
    - Subject: "Permohonan Registrasi Mitra"
    - Berisi: Alasan rejection + saran

## Troubleshooting

### Email tidak terkirim?

1. **Cek log Laravel**: `storage/logs/laravel.log`
2. **Verifikasi SMTP credentials** di Brevo dashboard
3. **Cek quota Brevo**: Free plan = 300 emails/day
4. **Test koneksi SMTP**:
    ```bash
    telnet smtp-relay.brevo.com 587
    ```

### Error "Connection refused"?

-   Pastikan port 587 tidak diblock oleh firewall
-   Coba gunakan port 465 dengan `MAIL_ENCRYPTION=ssl`

### Email masuk spam?

-   Verifikasi domain di Brevo
-   Setup SPF dan DKIM records
-   Gunakan custom domain untuk `MAIL_FROM_ADDRESS`

## Next Steps

Setelah konfigurasi email selesai, yang perlu dibuat:

1. ✅ Login UI (Sudah)
2. ✅ Register Form (Sudah)
3. ✅ Email ke Admin (Sudah)
4. ⏳ Admin Panel untuk review requests
5. ⏳ Email approval/rejection ke mitra
6. ⏳ Auto-create akun mitra saat approved

## Testing

1. Buka `/mitra/login` → Lihat UI baru
2. Klik "Daftar Sebagai Mitra"
3. Isi form dan submit
4. Cek email admin → Harus terima notifikasi
5. Login sebagai admin → Review request (akan dibuat)
