-- ================================================
-- SQL Setup Database untuk HRIS V2
-- Database: MySQL (Laragon Default)
-- ================================================

-- Buat Database
CREATE DATABASE IF NOT EXISTS hrisv2_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Gunakan Database
USE hrisv2_db;

-- Buat User (Optional - jika ingin user khusus)
-- CREATE USER IF NOT EXISTS 'hrisv2_user'@'localhost' IDENTIFIED BY 'hrisv2_password';
-- GRANT ALL PRIVILEGES ON hrisv2_db.* TO 'hrisv2_user'@'localhost';
-- FLUSH PRIVILEGES;

-- ================================================
-- Setelah menjalankan SQL ini, lanjutkan dengan:
-- 1. Update file .env dengan konfigurasi database
-- 2. Jalankan: php artisan migrate
-- 3. (Optional) Jalankan: php artisan db:seed
-- ================================================
