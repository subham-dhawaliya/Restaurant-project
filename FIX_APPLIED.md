# Session Error Fixed ✅

## Problem
```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'restaurant-db.sessions' doesn't exist
```

## Solution Applied

Changed session and cache drivers from `database` to `file` in `.env`:

### Before:
```env
SESSION_DRIVER=database
CACHE_STORE=database
```

### After:
```env
SESSION_DRIVER=file
CACHE_STORE=file
```

## What This Means

- Sessions will now be stored in `storage/framework/sessions/` folder
- Cache will be stored in `storage/framework/cache/` folder
- No database tables needed for sessions/cache
- Simpler setup, works immediately

## Next Steps

1. **Restart your development server:**
   ```bash
   # Stop current server (Ctrl+C)
   php artisan serve
   ```

2. **Clear browser cache and refresh:**
   - Press `Ctrl + Shift + R` (hard refresh)
   - Or clear browser cache

3. **Test the contact page:**
   - Visit: `http://localhost:8000/contact`
   - Fill and submit the form
   - Should work without errors

## Alternative (If you want database sessions)

If you prefer database sessions, run:
```bash
php artisan session:table
php artisan migrate
```

Then change back to:
```env
SESSION_DRIVER=database
```

But file-based sessions work perfectly fine for most applications!

---

**Status:** ✅ Fixed
**Action Required:** Restart server and refresh browser
