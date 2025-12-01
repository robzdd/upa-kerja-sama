# 🚀 Quick Start - CI/CD Deployment

Panduan cepat untuk deployment menggunakan GitHub Actions.

## ⚡ Setup Cepat (5 Menit)

### 1. Setup GitHub Secrets

Buka: **Repository Settings** → **Secrets and variables** → **Actions**

Tambahkan 5 secrets ini:

```
FTP_SERVER=ftp.yourserver.com
FTP_USERNAME=your_username
FTP_PASSWORD=your_password
FTP_PORT=21
REMOTE_PATH=/public_html/
```

### 2. Setup Server Production

```bash
# Di server, buat .env dari template
cp .env.production.example .env

# Edit .env dengan credentials Anda
nano .env

# Generate APP_KEY
php artisan key:generate
```

### 3. Deploy!

```bash
git add .
git commit -m "Setup CI/CD"
git push origin main
```

Monitor di: **GitHub → Actions tab**

### 4. Post-Deployment (Di Server)

```bash
# Run script otomatis
bash deploy-script.sh

# Atau manual:
php artisan migrate --force
php artisan optimize
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

## ✅ Checklist

-   [ ] GitHub Secrets configured
-   [ ] `.env` file di server
-   [ ] Database created
-   [ ] Google OAuth redirect URI updated
-   [ ] First deployment successful
-   [ ] Migrations run
-   [ ] Website accessible

## 📚 Dokumentasi Lengkap

-   [DEPLOYMENT.md](./DEPLOYMENT.md) - Panduan lengkap deployment
-   [deploy-script.sh](./deploy-script.sh) - Post-deployment script
-   [.env.production.example](./.env.production.example) - Environment template

## 🆘 Troubleshooting

**FTP Failed?** → Check credentials di GitHub Secrets  
**500 Error?** → Check `.env` file & run `php artisan key:generate`  
**Assets not loading?** → Run `npm run build` locally & push  
**Migration failed?** → Check database credentials di `.env`

## 🔗 Links

-   [GitHub Actions](https://github.com/YOUR_USERNAME/YOUR_REPO/actions)
-   [Google Cloud Console](https://console.cloud.google.com/)

---

**Need help?** Lihat [DEPLOYMENT.md](./DEPLOYMENT.md) untuk panduan lengkap.
