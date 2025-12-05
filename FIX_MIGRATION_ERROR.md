# Fix Migration Error

## Problem
Migration fail ho raha hai kyunki `phone` aur `address` columns already exist karte hain.

## Solution

### Option 1: Run Migration Again (Recommended)
Ab migration fix ho gaya hai. Simply run karo:

```bash
php artisan migrate
```

### Option 2: Fresh Migration (If Option 1 doesn't work)
**⚠️ WARNING: This will delete all data!**

```bash
php artisan migrate:fresh
```

### Option 3: Rollback Last Migration
```bash
php artisan migrate:rollback --step=1
php artisan migrate
```

## What Was Fixed

Updated migration file to:
- ✅ Check if columns already exist
- ✅ Only add `city` and `pincode` (phone & address already exist)
- ✅ Skip duplicate columns

## Existing Columns in Users Table

From previous migrations:
- ✅ `phone` - Already exists (from role migration)
- ✅ `address` - Already exists (from role migration)
- ⚠️ `city` - Need to add
- ⚠️ `pincode` - Need to add

## Try This

```bash
php artisan migrate
```

Should work now! ✅

## If Still Failing

Check the exact error:
```bash
php artisan migrate --verbose
```

Then share the error message.
