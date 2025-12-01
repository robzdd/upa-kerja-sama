# GitHub Actions Workflow - SSH Automation (Optional)

Jika Anda ingin menjalankan artisan commands secara otomatis setelah FTP deployment, tambahkan step SSH ke workflow.

## Setup

### 1. Tambahkan GitHub Secrets untuk SSH

Buka: **Repository Settings** → **Secrets and variables** → **Actions**

Tambahkan secrets berikut:

| Secret Name    | Deskripsi                                | Contoh           |
| -------------- | ---------------------------------------- | ---------------- |
| `SSH_HOST`     | Server SSH (bisa sama dengan FTP_SERVER) | `yourserver.com` |
| `SSH_USERNAME` | Username SSH                             | `username`       |
| `SSH_PASSWORD` | Password SSH                             | `your-password`  |
| `SSH_PORT`     | Port SSH (default: 22)                   | `22`             |

**Atau jika menggunakan SSH Key:**

| Secret Name       | Deskripsi                         |
| ----------------- | --------------------------------- |
| `SSH_PRIVATE_KEY` | Private SSH key (isi file id_rsa) |

### 2. Update Workflow File

Tambahkan step ini di `.github/workflows/deploy.yml` setelah step "Deploy to Server via FTP":

```yaml
- name: Run Post-Deployment Commands via SSH
  uses: appleboy/ssh-action@v1.0.3
  with:
      host: ${{ secrets.SSH_HOST }}
      username: ${{ secrets.SSH_USERNAME }}
      password: ${{ secrets.SSH_PASSWORD }}
      port: ${{ secrets.SSH_PORT }}
      script: |
          cd ${{ secrets.REMOTE_PATH }}
          echo "📍 Current directory: $(pwd)"

          # Run migrations
          echo "🗄️  Running migrations..."
          php artisan migrate --force

          # Clear caches
          echo "🧹 Clearing caches..."
          php artisan cache:clear
          php artisan config:clear
          php artisan route:clear
          php artisan view:clear

          # Optimize application
          echo "⚡ Optimizing..."
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          php artisan optimize

          # Create storage link (ignore if exists)
          echo "🔗 Creating storage link..."
          php artisan storage:link || true

          # Set permissions
          echo "🔐 Setting permissions..."
          chmod -R 775 storage bootstrap/cache

          echo "✅ Post-deployment tasks completed!"
```

**Atau jika menggunakan SSH Key:**

```yaml
- name: Run Post-Deployment Commands via SSH
  uses: appleboy/ssh-action@v1.0.3
  with:
      host: ${{ secrets.SSH_HOST }}
      username: ${{ secrets.SSH_USERNAME }}
      key: ${{ secrets.SSH_PRIVATE_KEY }}
      port: ${{ secrets.SSH_PORT }}
      script: |
          cd ${{ secrets.REMOTE_PATH }}
          php artisan migrate --force
          php artisan optimize
          php artisan storage:link || true
          chmod -R 775 storage bootstrap/cache
```

## Workflow Lengkap dengan SSH

Berikut contoh workflow lengkap dengan SSH automation:

```yaml
name: Deploy to Production via FTP

on:
    push:
        branches:
            - main
    workflow_dispatch:

jobs:
    deploy:
        name: Build and Deploy
        runs-on: ubuntu-latest

        steps:
            - name: Checkout Code
              uses: actions/checkout@v4

            - name: Setup PHP
              uses: shivammathur/setup-php@v2
              with:
                  php-version: "8.2"
                  extensions: mbstring, xml, ctype, json, bcmath, fileinfo, pdo, pdo_mysql
                  coverage: none

            - name: Setup Node.js
              uses: actions/setup-node@v4
              with:
                  node-version: "20"
                  cache: "npm"

            - name: Install Composer Dependencies
              run: composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

            - name: Install NPM Dependencies
              run: npm ci

            - name: Build Assets
              run: npm run build

            - name: Create Deployment Package
              run: |
                  mkdir -p deploy
                  rsync -av --exclude='.git' \
                            --exclude='node_modules' \
                            --exclude='tests' \
                            --exclude='.env' \
                            --exclude='.github' \
                            --exclude='deploy' \
                            ./ deploy/

            - name: Deploy to Server via FTP
              uses: SamKirkland/FTP-Deploy-Action@v4.3.5
              with:
                  server: ${{ secrets.FTP_SERVER }}
                  username: ${{ secrets.FTP_USERNAME }}
                  password: ${{ secrets.FTP_PASSWORD }}
                  port: ${{ secrets.FTP_PORT }}
                  local-dir: ./deploy/
                  server-dir: ${{ secrets.REMOTE_PATH }}

            # ========================================
            # SSH AUTOMATION (OPTIONAL)
            # ========================================
            - name: Run Post-Deployment Commands via SSH
              uses: appleboy/ssh-action@v1.0.3
              with:
                  host: ${{ secrets.SSH_HOST }}
                  username: ${{ secrets.SSH_USERNAME }}
                  password: ${{ secrets.SSH_PASSWORD }}
                  port: ${{ secrets.SSH_PORT }}
                  script: |
                      cd ${{ secrets.REMOTE_PATH }}
                      php artisan migrate --force
                      php artisan cache:clear
                      php artisan config:clear
                      php artisan route:clear
                      php artisan view:clear
                      php artisan config:cache
                      php artisan route:cache
                      php artisan view:cache
                      php artisan optimize
                      php artisan storage:link || true
                      chmod -R 775 storage bootstrap/cache

            - name: Deployment Success
              if: success()
              run: |
                  echo "✅ Deployment completed successfully!"
                  echo "🚀 All artisan commands executed automatically"
```

## Catatan

### Keamanan SSH

-   **Password:** Lebih mudah setup, tapi kurang aman
-   **SSH Key:** Lebih aman, recommended untuk production

### Generate SSH Key

Jika ingin pakai SSH key:

```bash
# Di komputer lokal
ssh-keygen -t rsa -b 4096 -C "github-actions"

# Copy public key ke server
ssh-copy-id username@yourserver.com

# Copy private key content untuk GitHub Secret
cat ~/.ssh/id_rsa
```

### Troubleshooting

**SSH Connection Failed:**

-   Verify SSH credentials di GitHub Secrets
-   Check SSH port (biasanya 22)
-   Pastikan SSH service aktif di server

**Permission Denied:**

-   Verify username punya akses ke directory
-   Check file permissions

**Command Not Found:**

-   Verify path ke PHP binary
-   Mungkin perlu full path: `/usr/bin/php artisan`

## Alternatif: Tanpa SSH

Jika tidak ada SSH access, gunakan salah satu metode di `ARTISAN_PRODUCTION.md`:

-   Web-based runner (`artisan-web.php`)
-   cPanel Terminal
-   Manual via FTP + file manager

---

**Recommended:** Gunakan SSH automation untuk fully automated deployment!
