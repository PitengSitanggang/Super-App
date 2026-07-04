<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## 📄 DOKUMENTASI INSTALASI & SETTING PROGRAM "SUPER APP"
A. Kebutuhan Sistem (Prerequisites)
Sebelum menjalankan aplikasi, pastikan sistem komputer telah terinstal perangkat lunak berikut:

Web Server & Database: Laragon (direkomendasikan) atau XAMPP.

PHP: Versi 8.1 atau lebih baru.

Composer: Untuk manajemen dependency PHP (Laravel).

Node.js & NPM: Untuk kompilasi aset frontend (Tailwind CSS & JavaScript).

Git: Untuk mengunduh source code dari repository.

B. Langkah-Langkah Instalasi (Setup Program)

Langkah 1: Mengunduh Source Code

Buka aplikasi Laragon, lalu jalankan Terminal.

Arahkan direktori ke dalam folder www (contoh: cd C:\laragon\www).

Lakukan clone repository GitHub dengan perintah:

Bash
git clone https://github.com/PitengSitanggang/Super-App.git
Masuk ke dalam folder project:

Bash
cd Super-App
Langkah 2: Instalasi Dependency
Karena folder vendor dan node_modules tidak ikut diunggah ke GitHub, Anda wajib menginstalnya secara manual melalui terminal:

Instal dependency backend (Laravel):

Bash
composer install
Instal dependency frontend (Tailwind CSS, dll):

Bash
npm install
Langkah 3: Konfigurasi Environment & Database

Gandakan file pengaturan bawaan Laravel menjadi file .env utama:

Bash
copy .env.example .env
Generate kunci keamanan aplikasi:

Bash
php artisan key:generate
Buka aplikasi database (misalnya HeidiSQL atau phpMyAdmin dari Laragon), lalu buat database baru dengan nama: super_app_db (atau sesuaikan dengan kebutuhan).

Buka file .env menggunakan code editor (VS Code) dan sesuaikan kredensial database pada baris berikut:

Cuplikan kode
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=super_app_db
DB_USERNAME=root
DB_PASSWORD=
Langkah 4: Pembuatan Tabel & Tautan Penyimpanan

Jalankan perintah migrasi untuk membangun struktur tabel di database:

Bash
php artisan migrate
Buat tautan penyimpanan (symlink) agar gambar yang diunggah (upload foto profil/logo aplikasi) dapat diakses oleh publik:

Bash
php artisan storage:link
Langkah 5: Menjalankan Aplikasi
Untuk menjalankan aplikasi Super App, diperlukan dua proses terminal yang berjalan secara bersamaan:

Terminal 1 (Menjalankan Server Backend):

Bash
php artisan serve
Terminal 2 (Menjalankan Server Frontend/Tailwind):
Buka jendela terminal baru, arahkan ke folder project, lalu ketik:

Bash
npm run dev
Buka browser (Google Chrome/Firefox) dan akses aplikasi melalui alamat: http://localhost:8000