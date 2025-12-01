#!/bin/bash

###############################################################################
# Post-Deployment Script untuk Laravel UPA Kerja Sama
# Script ini harus dijalankan di server production setelah deployment
###############################################################################

echo "=========================================="
echo "🚀 Starting Post-Deployment Tasks"
echo "=========================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored messages
print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_info() {
    echo -e "ℹ️  $1"
}

# Check if we're in the correct directory
if [ ! -f "artisan" ]; then
    print_error "artisan file not found. Please run this script from the Laravel root directory."
    exit 1
fi

print_success "Found Laravel installation"

# 1. Run Database Migrations
echo ""
print_info "Step 1: Running database migrations..."
if php artisan migrate --force; then
    print_success "Database migrations completed"
else
    print_error "Database migrations failed"
    exit 1
fi

# 2. Clear and optimize caches
echo ""
print_info "Step 2: Clearing caches..."

php artisan cache:clear
print_success "Application cache cleared"

php artisan config:clear
print_success "Configuration cache cleared"

php artisan route:clear
print_success "Route cache cleared"

php artisan view:clear
print_success "View cache cleared"

# 3. Optimize application
echo ""
print_info "Step 3: Optimizing application..."

php artisan config:cache
print_success "Configuration cached"

php artisan route:cache
print_success "Routes cached"

php artisan view:cache
print_success "Views cached"

php artisan optimize
print_success "Application optimized"

# 4. Create storage link
echo ""
print_info "Step 4: Creating storage symlink..."
if php artisan storage:link; then
    print_success "Storage symlink created"
else
    print_warning "Storage symlink already exists or failed"
fi

# 5. Set proper permissions
echo ""
print_info "Step 5: Setting proper permissions..."

# Storage directory
if chmod -R 775 storage; then
    print_success "Storage permissions set (775)"
else
    print_warning "Failed to set storage permissions"
fi

# Bootstrap cache directory
if chmod -R 775 bootstrap/cache; then
    print_success "Bootstrap/cache permissions set (775)"
else
    print_warning "Failed to set bootstrap/cache permissions"
fi

# 6. Check migration status
echo ""
print_info "Step 6: Checking migration status..."
php artisan migrate:status

# 7. Verify environment
echo ""
print_info "Step 7: Verifying environment..."

if [ -f ".env" ]; then
    print_success ".env file exists"
    
    # Check critical env variables
    if grep -q "APP_KEY=base64:" .env; then
        print_success "APP_KEY is set"
    else
        print_error "APP_KEY is not set! Run: php artisan key:generate"
    fi
    
    if grep -q "DB_DATABASE=" .env; then
        print_success "Database configuration found"
    else
        print_warning "Database configuration might be missing"
    fi
else
    print_error ".env file not found!"
    print_info "Copy .env.production.example to .env and configure it"
fi

# 8. Test database connection
echo ""
print_info "Step 8: Testing database connection..."
if php artisan tinker --execute="DB::connection()->getPdo(); echo 'Connected';" 2>/dev/null | grep -q "Connected"; then
    print_success "Database connection successful"
else
    print_error "Database connection failed. Check your .env configuration"
fi

# Final summary
echo ""
echo "=========================================="
echo "📊 Deployment Summary"
echo "=========================================="
print_success "All post-deployment tasks completed!"
echo ""
print_info "Next steps:"
echo "  1. Visit your website to verify it's working"
echo "  2. Test Google OAuth login"
echo "  3. Check if all assets (CSS/JS) are loading"
echo "  4. Test file uploads and PDF generation"
echo ""
print_warning "Remember to:"
echo "  - Keep .env file secure (never commit to git)"
echo "  - Monitor storage/logs/laravel.log for errors"
echo "  - Set up regular database backups"
echo ""
echo "=========================================="
print_success "🎉 Deployment Complete!"
echo "=========================================="
