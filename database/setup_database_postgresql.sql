-- ================================================
-- SQL Setup Database untuk HRIS V2
-- Database: PostgreSQL
-- ================================================

-- Buat Database
CREATE DATABASE hrisv2_db
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'en_US.UTF-8'
    LC_CTYPE = 'en_US.UTF-8'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

-- Connect to database
\c hrisv2_db

-- Buat Schema global (untuk user_auth table)
CREATE SCHEMA IF NOT EXISTS global;

-- Grant privileges
GRANT ALL ON SCHEMA global TO postgres;
GRANT ALL ON SCHEMA public TO postgres;

-- Set search path (agar bisa akses schema global dan public)
ALTER DATABASE hrisv2_db SET search_path TO public, global;

-- ================================================
-- Setelah menjalankan SQL ini, lanjutkan dengan:
-- 1. Update file .env dengan konfigurasi database
-- 2. Jalankan: php artisan migrate
-- 3. (Optional) Jalankan: php artisan db:seed
-- ================================================
