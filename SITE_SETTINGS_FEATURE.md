# ✅ Site Settings (Header & Footer) - Complete!

## Feature Added

Admin ab backend se header aur footer ko customize kar sakta hai!

## What Admin Can Change

### Header Settings
- ✅ Site Name / Logo Text
- ✅ Logo Image (upload)
- ✅ Header Phone
- ✅ Header Email
- ✅ Book a Table Link

### Footer Settings
- ✅ About Text
- ✅ Address
- ✅ Phone
- ✅ Email
- ✅ Opening Hours
- ✅ Copyright Text

### Social Media Links
- ✅ Facebook URL
- ✅ Instagram URL
- ✅ Twitter/X URL
- ✅ YouTube URL

## Setup

### Step 1: Run Migration
```bash
php artisan migrate
```

### Step 2: Access Settings
1. Login as admin
2. Go to Dashboard
3. Click "Site Settings" in sidebar
4. Update settings
5. Save!

## Files Created

### Migration
- `database/migrations/2025_12_05_100000_create_site_settings_table.php`

### Model
- `app/Models/SiteSetting.php`

### Controller
- `app/Http/Controllers/Admin/SiteSettingController.php`

### View
- `resources/views/admin/settings/index.blade.php`

## Files Modified

### Routes
- `routes/web.php` - Added settings routes

### Layouts
- `resources/views/layouts/header.blade.php` - Dynamic site name/logo
- `resources/views/layouts/footer.blade.php` - Dynamic footer content
- `resources/views/layouts/dashboard.blade.php` - Added settings link in sidebar

## How It Works

### Singleton Pattern
The `SiteSetting::getSettings()` method:
1. Checks if settings exist
2. If not, creates default settings
3. Returns the active settings

### Header
```php
@php
    $siteSettings = \App\Models\SiteSetting::getSettings();
@endphp

// Logo or Site Name
@if($siteSettings->logo)
    <img src="{{ asset($siteSettings->logo) }}" alt="{{ $siteSettings->site_name }}">
@else
    <h1>{{ $siteSettings->site_name }}</h1>
@endif
```

### Footer
```php
@php
    $footerSettings = \App\Models\SiteSetting::getSettings();
@endphp

// Address
{{ $footerSettings->footer_address }}

// Social Links
@if($footerSettings->facebook_url)
    <a href="{{ $footerSettings->facebook_url }}">Facebook</a>
@endif
```

## Admin Panel

### Settings Page Features
- ✅ Header Settings section
- ✅ Footer Settings section
- ✅ Social Media Links section
- ✅ Logo upload with preview
- ✅ Form validation
- ✅ Success message on save

## Routes

```php
// Site Settings (Admin)
GET  /admin/settings     -> Show settings form
PUT  /admin/settings     -> Update settings
```

## Database Schema

```sql
site_settings
├── id
├── site_name (default: 'Yummy')
├── logo (nullable)
├── header_phone (nullable)
├── header_email (nullable)
├── book_table_link (default: '#book-a-table')
├── footer_about (nullable)
├── footer_address (nullable)
├── footer_phone (nullable)
├── footer_email (nullable)
├── footer_timing (nullable)
├── facebook_url (nullable)
├── instagram_url (nullable)
├── twitter_url (nullable)
├── youtube_url (nullable)
├── copyright_text (nullable)
├── is_active (default: true)
├── created_at
└── updated_at
```

## Testing

1. **Run Migration**
```bash
php artisan migrate
```

2. **Login as Admin**
```
Go to: /login
```

3. **Access Settings**
```
Dashboard → Site Settings
```

4. **Update Settings**
- Change site name
- Upload logo
- Update footer info
- Add social links
- Save

5. **Check Frontend**
- Go to home page
- Check header (site name/logo)
- Check footer (address, phone, social links)
- ✅ All should be updated!

## Benefits

✅ **No Code Changes** - Admin can update without developer  
✅ **Logo Upload** - Easy logo management  
✅ **Social Links** - Add/remove social media  
✅ **Contact Info** - Update phone, email, address  
✅ **Opening Hours** - Change timing easily  
✅ **Copyright** - Update copyright text  

---

**Site settings feature complete! Run migration and test! 🎉**
