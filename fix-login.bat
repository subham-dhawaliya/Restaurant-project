@echo off
echo ========================================
echo Fixing "Page Expired" Error
echo ========================================
echo.

echo [1/5] Clearing config cache...
php artisan config:clear
echo.

echo [2/5] Clearing application cache...
php artisan cache:clear
echo.

echo [3/5] Clearing route cache...
php artisan route:clear
echo.

echo [4/5] Clearing view cache...
php artisan view:clear
echo.

echo [5/5] Clearing compiled files...
php artisan clear-compiled
echo.

echo ========================================
echo All caches cleared successfully!
echo ========================================
echo.
echo Now:
echo 1. Close your browser completely
echo 2. Open a new browser window (or use Incognito)
echo 3. Go to http://localhost:8000/login
echo 4. Try logging in again
echo.
echo If server is not running, start it with:
echo php artisan serve
echo.
pause
