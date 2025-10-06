<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Membuat Fitur Login Dengan Laravel

Membuat rangkaian sistem login menggunakan framework "Laravel", project ini bertujuan untuk login dengan menggunakan sistem verifikasi OTP via email. Dan juga sudah menambahkan implemntasi spatie untuk user.

## Fitur

Proyek ini dilengkapi dengan berbagai fitur modern untuk memastikan fungsionalitas, keamanan, dan pengalaman pengguna yang baik:

1.  **Sistem Autentikasi Lengkap**:
    -   Registrasi pengguna baru.
    -   Login dengan validasi *real-time*.
    -   Proses verifikasi akun melalui OTP (One-Time Password) yang dikirim via email.

2.  **Manajemen Pengguna (CRUD)**:
    -   Fitur Create, Read, Update, dan Delete untuk mengelola data pengguna.
    -   Hanya dapat diakses oleh pengguna dengan peran `superadmin dan admin`.

3.  **Manajemen Peran & Hak Akses**:
    -   Implementasi *role-based access control* (RBAC) menggunakan paket `spatie/laravel-permission`.   
    -   Memungkinkan pengaturan hak akses yang fleksibel untuk setiap peran pengguna.

4.  **Antarmuka Pengguna Interaktif**:
    -   Validasi form sisi klien secara *real-time* menggunakan **jQuery Validator**.
    -   Notifikasi dinamis dan modern dengan **Bootstrap Modals** dan **SweetAlert**.
    -   Template admin yang responsif dan kaya fitur menggunakan **AdminLTE 3**.

## Teknologi yang Digunakan

-   **Backend**: Laravel 11, PHP 8.2
-   **Frontend**: Blade, AdminLTE 3, Bootstrap, jQuery
-   **UI Libraries**: jQuery Validator, SweetAlert
-   **Database**: MySQL / MariaDB
-   **Otorisasi**: Spatie Laravel-Permission

### Cara instalasi

## Prasyarat
Sebelum memulai, pastikan sudah terinstall di komputer Anda:
- **PHP** ^8.2
- **Composer**
- **MySQL/MariaDB**
- **Node.js & NPM**

## Instalasi Laravel-12

1. **Clone repository**
   ```bash
   git clone https://github.com/username/nama-project.git
   cd nama-project

2. **Install dependency Laravel**
   ```bash
   composer instal

3. **Copy file environment**
   ```bash
   cp .env.example .env

4. **Generate application key**
   ```bash
   php artisan key:generate

5. **Jalankan migrasi database**
   ```bash
   php artisan migrate --seed

6. **Install dependency frontend**
   ```bash
   npm install && npm run dev

7. **Jalankan server lokal**
   ```bash
   php artisan serve


