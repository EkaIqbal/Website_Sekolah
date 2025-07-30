# 📦 Panduan Instalasi Website Sekolah

Berikut langkah-langkah untuk menginstal dan menjalankan project ini secara lokal.

## 🔧 Prasyarat

Pastikan kamu sudah menginstal:

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM
- Laravel >= 10
- XAMPP atau Laravel Herd (opsional)

## 🚀 Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/EkaIqbal/Website_Sekolah_SD.git
   cd Website_Sekolah_SD
   ```

2. **Install dependency Laravel**
   ```bash
   composer install
   ```

3. **Copy file environment**
   ```bash
   cp .env.example .env
   ```
   > Di Windows:
   ```cmd
   copy .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Atur konfigurasi database**
   Edit isi file `.env`:
   ```env
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```

7. **Install dependency frontend**
   ```bash
   npm install
   npm run dev
   ```

8. **Menjalankan website**
   ```bash
   php artisan serve
   ```

   Buka di browser:
   ```
   http://127.0.0.1:8000
   ```
