# Fix "Page Expired" Error - Admin Login

## Problem
Admin login karte waqt "Page Expired" error aa raha hai.

## Cause
Ye error tab aata hai jab:
1. CSRF token expire ho jata hai
2. Session configuration mein issue ho
3. Cache purana ho jata hai
4. Multiple guards ke saath session conflict ho

## Solution - Run These Commands

### Step 1: Clear All Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 2: Clear Session Files (if using file driver)
```bash
php artisan session:clear
```

Ya manually delete karo:
```bash
rmdir /s /q storage\framework\sessions
mkdir storage\framework\sessions
```

### Step 3: Restart Server
```bash
# Stop current server (Ctrl+C)
php artisan serve
```

### Step 4: Clear Browser Cache
- Browser mein Ctrl+Shift+Delete
- Cookies aur Cache clear karo
- Ya Incognito/Private window use karo

## Configuration Changes Made

### 1. Session Config Updated
**`config/session.php`**
- Default lifetime: 120 minutes (was 12)
- Default driver: file (matches .env)

### 2. .env Settings
```
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
```

## Testing Steps

1. **Clear Everything**:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

2. **Restart Server**:
```bash
php artisan serve
```

3. **Clear Browser**:
   - Open Incognito/Private window
   - Ya browser cache clear karo

4. **Test Admin Login**:
   - Go to: `http://localhost:8000/login`
   - Enter admin credentials
   - Should work now! ✅

## If Still Not Working

### Option 1: Check Storage Permissions
```bash
# Make sure storage folder is writable
icacls storage /grant Everyone:F /t
```

### Option 2: Use Database Session Driver
Update `.env`:
```
SESSION_DRIVER=database
```

Then run:
```bash
php artisan session:table
php artisan migrate
php artisan config:clear
```

### Option 3: Check APP_KEY
Make sure `.env` has APP_KEY:
```bash
php artisan key:generate
```

## Common Causes & Fixes

| Problem | Solution |
|---------|----------|
| Old cache | `php artisan cache:clear` |
| Old config | `php artisan config:clear` |
| Old sessions | Delete `storage/framework/sessions/*` |
| Browser cache | Clear browser or use Incognito |
| Wrong APP_KEY | `php artisan key:generate` |
| Storage permissions | `icacls storage /grant Everyone:F /t` |

## Quick Fix Command (Run All at Once)

```bash
php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear && php artisan serve
```

## Prevention

To prevent this in future:
1. Don't keep login page open for too long
2. Clear cache after config changes
3. Use proper session lifetime
4. Keep APP_KEY consistent

---

**Try the commands above and test again! 🚀**
