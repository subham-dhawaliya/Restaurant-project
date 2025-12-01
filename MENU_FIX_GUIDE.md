# Menu Fix Guide

## Issues Fixed
✅ Footer duplicate scripts removed
✅ Menu route properly configured
✅ Database migration completed
✅ Sample data seeder created

## How to Add Sample Menu Items

### Option 1: Using Admin Panel (Recommended)
1. Server start karo (agar nahi chal raha): `php artisan serve`
2. Browser mein jao: `http://localhost:8000/login`
3. Login karo
4. Dashboard → Home Page → Menu
5. "Add New Menu Item" button pe click karo
6. Form fill karo aur submit karo

### Option 2: Using SQL File
1. Database client open karo (phpMyAdmin, TablePlus, etc.)
2. `insert_menu_items.sql` file open karo
3. SQL queries run karo

### Option 3: Using Seeder (Terminal se)
Server stop karo (Ctrl+C), phir:
```bash
php artisan db:seed --class=MenuSectionSeeder
php artisan serve
```

## Testing Menu Page
1. Browser mein jao: `http://localhost:8000/menu`
2. Tabs check karo: All, Food, Beverages
3. Menu items show hone chahiye

## Image Path Fix
Menu items mein images optional hain. Agar image nahi hai toh default image show hoga:
- Default path: `assets/img/menu/menu-item-1.png`
- Upload path: `storage/menu-images/`

Agar images upload karne hain:
1. Admin panel se menu item edit karo
2. Image select karo
3. Save karo

## Storage Link (Important!)
Agar uploaded images show nahi ho rahe:
```bash
php artisan storage:link
```

## Common Issues

### Issue: Page load nahi ho raha
**Solution**: Browser console check karo (F12), koi JS error hai toh batao

### Issue: Menu items show nahi ho rahe
**Solution**: 
1. Database check karo: `menu_sections` table mein data hai?
2. `is_active` column 1 hai?
3. Browser console mein error check karo

### Issue: Images show nahi ho rahe
**Solution**:
1. `php artisan storage:link` run karo
2. `public/storage` folder exist karta hai?
3. Image path check karo: `storage/app/public/menu-images/`

## Quick Test
Browser mein ye URL kholo:
- Menu page: `http://localhost:8000/menu`
- Admin menu: `http://localhost:8000/admin/menu` (login required)

Agar koi specific error aa raha hai toh screenshot share karo!
