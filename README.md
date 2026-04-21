# Neo E-Library (Appperpustakaan)

Aplikasi perpustakaan berbasis web (Laravel 12) dengan fitur katalog buku, keranjang peminjaman, peminjaman online, dan panel admin untuk verifikasi/approve peminjaman.

## Kebutuhan

- Windows 10/11
- XAMPP (disarankan yang PHP 8.2+)
- Composer
- MySQL / MariaDB (via XAMPP)
- (Opsional) Node.js + NPM jika ingin build asset Vite

## Instalasi (Laptop Dosen / Windows + XAMPP)

1. Letakkan project di folder XAMPP:
   - `C:\xampp\htdocs\Appperpustakaan`

2. Aktifkan Apache dan MySQL di XAMPP Control Panel.

3. Buka terminal di folder project:
   - `C:\xampp\htdocs\Appperpustakaan`

4. Install dependency PHP:

   ```bash
   composer install
   ```

5. Buat file `.env`:

   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

6. Buat database di phpMyAdmin:
   - Nama DB: misalnya `appperpustakaan`

7. Atur koneksi database di `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eperpustakaan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

8. Migrasi database + seed admin:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

9. Storage link (untuk file di storage/app/public supaya bisa tampil via browser):

   ```bash
   php artisan storage:link
   ```

10. Jalankan aplikasi (cara paling mudah):

   ```bash
   php artisan serve
   ```

   Buka di browser:
   - `http://127.0.0.1:8000`

## Akun Default

Admin (hasil seeder):
- URL: `http://127.0.0.1:8000/admin/login`
- Username: `admin`
- Password: `admin12345`

Mahasiswa:
- URL: `http://127.0.0.1:8000/mahasiswa/register`
- Setelah register, akun perlu diverifikasi admin sebelum bisa login.

## URL Penting

- Beranda: `/`
- Katalog: `/katalog`
- Admin dashboard: `/admin`
- Keranjang mahasiswa: `/mahasiswa/keranjang`
- Riwayat peminjaman mahasiswa: `/mahasiswa/peminjaman`

## Catatan Media (Gambar)

- Cover buku disimpan di: `public/image/books`
- Foto mahasiswa disimpan di: `public/uploads/peminjams`
- Jika nantinya ada file yang disimpan via disk `public` (Laravel), pastikan `php artisan storage:link` sudah dijalankan.

## Troubleshooting

- Kalau error versi PHP saat `composer install`, pastikan XAMPP menggunakan PHP 8.2+.
  Cek:
  ```bash
  php -v
  ```
- Kalau `storage:link` gagal karena sudah ada folder/link, hapus `public/storage` lalu jalankan lagi:
  ```bash
  php artisan storage:link
  ```
- Setelah ubah `.env`, jika masih tidak kebaca, jalankan:
  ```bash
  php artisan config:clear
  ```
