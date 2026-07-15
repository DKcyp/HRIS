@echo off
echo ============================================
echo Script untuk Mengaktifkan PostgreSQL di PHP
echo ============================================
echo.

set PHP_INI=C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.ini

echo Mencari extension pdo_pgsql di php.ini...
findstr /C:"extension=pdo_pgsql" "%PHP_INI%" >nul
if %errorlevel% equ 0 (
    echo Extension pdo_pgsql sudah ada di php.ini
) else (
    echo Menambahkan extension pdo_pgsql...
    echo extension=pdo_pgsql >> "%PHP_INI%"
)

echo.
echo Mencari extension pgsql di php.ini...
findstr /C:"extension=pgsql" "%PHP_INI%" >nul
if %errorlevel% equ 0 (
    echo Extension pgsql sudah ada di php.ini
) else (
    echo Menambahkan extension pgsql...
    echo extension=pgsql >> "%PHP_INI%"
)

echo.
echo ============================================
echo Selesai! Silakan restart Laragon
echo ============================================
pause
