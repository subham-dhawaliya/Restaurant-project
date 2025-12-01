# Hero Section Management System

## ✅ Setup Complete!

Admin ab backend se home page ka hero section completely manage kar sakta hai.

## Features

### Database Table: `hero_sections`
- **title** - Hero section ka main heading
- **description** - Description text
- **button_text** - Primary button ka text (default: "Book a Table")
- **button_link** - Button ka link (default: "#book-a-table")
- **video_text** - Video button ka text (default: "Watch Video")
- **video_link** - YouTube video URL
- **image** - Hero section ki image (optional)
- **is_active** - Active/Inactive status

## Admin Panel Access

### Menu Location
Dashboard → Home Page → Hero Section

### Routes
- **List**: `/admin/hero` - Sab hero sections dikhega
- **Create**: `/admin/hero/create` - Naya hero section banao
- **Edit**: `/admin/hero/{id}/edit` - Edit karo
- **Delete**: Delete button se remove karo

## How to Use

### 1. Admin Dashboard Login
```
URL: http://127.0.0.1:8000/login
```

### 2. Navigate to Hero Section
- Sidebar mein "Home Page" par click karo
- Dropdown mein "Hero Section" select karo

### 3. Create/Edit Hero Section
- Title aur description enter karo
- Image upload karo (optional)
- Button text aur links customize karo
- Video link add karo (YouTube URL)
- Active checkbox check karo
- Save karo

### 4. Frontend Display
- Sirf active hero section home page par dikhega
- Agar multiple active hain, to latest wala dikhega
- Agar koi active nahi hai, to default content dikhega

## Files Created

### Migration
- `database/migrations/2025_11_29_045900_create_hero_sections_table.php`

### Model
- `app/Models/HeroSection.php`

### Controller
- `app/Http/Controllers/Admin/HeroSectionController.php`

### Views
- `resources/views/admin/hero/index.blade.php` - List view
- `resources/views/admin/hero/create.blade.php` - Create form
- `resources/views/admin/hero/edit.blade.php` - Edit form

### Seeder
- `database/seeders/HeroSectionSeeder.php` - Default data

## Image Upload
- Images `storage/app/public/hero-images/` mein save hote hain
- Public access ke liye storage link create kiya gaya hai
- Supported formats: JPEG, PNG, JPG, GIF
- Max size: 2MB

## Notes
- Multiple hero sections create kar sakte ho
- Sirf ek active hero section home page par dikhega (latest wala)
- Image optional hai - agar nahi hai to default image dikhega
- Video link bhi optional hai
