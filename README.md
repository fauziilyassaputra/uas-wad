# Sistem Manajemen Inventaris Gudang

Aplikasi web full-stack berbasis server-side untuk mengelola inventaris gudang: data kategori dan produk, pencatatan barang masuk dan keluar, serta dashboard ringkasan stok. Dibangun dengan Laravel menggunakan arsitektur MVC dan basis data MySQL, sebagai tugas UAS mata kuliah Web Application Development, Universitas Cakrawala.

- **Nama:** Fauzi Ilyas Saputra
- **NIM:** 25110300008
- **Aplikasi live:** https://uas-wad.onrender.com
- **Repository:** https://github.com/fauziilyassaputra/uas-wad

> Catatan: instance gratis di Render tertidur saat tidak dipakai, sehingga permintaan pertama bisa memakan waktu sekitar satu menit. Tunggu hingga halaman tampil, lalu muat ulang jika perlu. Kredensial aplikasi live tercantum pada dokumen pengumpulan, bukan di README ini.

## Daftar Isi

1. [Fitur](#fitur)
2. [Teknologi](#teknologi)
3. [Hak Akses Pengguna](#hak-akses-pengguna)
4. [Menjalankan di Komputer Lokal](#menjalankan-di-komputer-lokal)
5. [Akun Uji Lokal](#akun-uji-lokal)
6. [Struktur Direktori dan MVC](#struktur-direktori-dan-mvc)
7. [Struktur Basis Data](#struktur-basis-data)
8. [Pengujian](#pengujian)
9. [Keamanan](#keamanan)
10. [Deployment](#deployment)
11. [Pemecahan Masalah](#pemecahan-masalah)

## Fitur

- **Autentikasi:** registrasi, login, logout, dan manajemen session. Pembatasan percobaan login (maksimal 5 per menit).
- **Kategori:** tambah, lihat, ubah, hapus, dengan validasi server-side. Kategori yang masih memiliki produk tidak dapat dihapus.
- **Produk:** CRUD lengkap dengan relasi ke kategori, SKU unik, satuan, dan batas stok minimum. Penanda "menipis" muncul saat stok kurang dari atau sama dengan batas minimum.
- **Transaksi stok:** pencatatan barang masuk dan keluar dengan nomor referensi otomatis. Stok produk hanya berubah melalui transaksi. Barang keluar ditolak jika melebihi stok. Seluruh proses dibungkus transaksi database sehingga tidak ada data setengah jadi.
- **Dashboard:** total produk dan kategori, total unit di stok, jumlah produk stok menipis, pergerakan stok 30 hari terakhir, dan lima transaksi terbaru.
- **Hak akses berbasis role:** `admin` dan `staff` (lihat tabel di bawah).

## Teknologi

| Komponen         | Teknologi                                              |
| ---------------- | ------------------------------------------------------ |
| Framework        | Laravel 13.x (constraint `^13.17`, terpasang `13.39.0`) |
| Bahasa           | PHP 8.3                                                |
| Tampilan         | Blade Template + CSS manual (`public/css/app.css`)     |
| Basis data       | MySQL (Eloquent ORM)                                   |
| Dependency       | Composer 2 (`composer.json` dan `composer.lock`)       |
| Aset front-end   | tanpa Node/npm/Vite, CSS ditulis manual                |
| Pengujian        | PHPUnit 12                                             |
| Kontainer        | Docker (PHP 8.3 + Apache)                              |
| Hosting aplikasi | Render                                                 |
| Hosting database | Aiven for MySQL                                        |

Dependensi yang tercatat di `composer.json`:

- **Runtime:** `php ^8.3`, `laravel/framework ^13.17`, `laravel/tinker ^3.0`.
- **Pengembangan:** `phpunit/phpunit ^12.5`, `laravel/pint`, `laravel/pail`, `laravel/boost`, `laravel/pao`, `fakerphp/faker`, `mockery/mockery`, `nunomaduro/collision`.
- Tidak ada `package.json`, sehingga tidak perlu `npm install` dan tidak ada langkah build aset.

## Hak Akses Pengguna

| Fitur                                             | Admin | Staff |
| ------------------------------------------------- | :---: | :---: |
| Registrasi dan login                              |   ✔   |   ✔   |
| Melihat dashboard                                 |   ✔   |   ✔   |
| Melihat daftar dan detail kategori dan produk     |   ✔   |   ✔   |
| Menambah, mengubah, menghapus kategori dan produk |   ✔   |   ✘   |
| Mencatat transaksi barang masuk dan keluar        |   ✔   |   ✔   |
| Melihat daftar dan detail transaksi               |   ✔   |   ✔   |

Pengguna yang mendaftar lewat form registrasi selalu mendapat role `staff`. Akun `admin` hanya dibuat melalui seeder.

## Menjalankan di Komputer Lokal

### Prasyarat

- PHP 8.3 atau lebih baru, dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, dan `fileinfo`
- Composer 2
- MySQL 8 (misalnya melalui Laragon atau XAMPP)
- Git

### Langkah instalasi

1. **Clone repository dan masuk ke foldernya.**

    ```bash
    git clone https://github.com/fauziilyassaputra/uas-wad.git
    cd uas-wad
    ```

2. **Pasang dependensi.**

    ```bash
    composer install
    ```

3. **Buat file konfigurasi.**

    ```bash
    cp .env.example .env
    ```

    Di Windows (Command Prompt) gunakan `copy .env.example .env`.

4. **Buat kunci aplikasi.**

    ```bash
    php artisan key:generate
    ```

5. **Buat database MySQL kosong**, misalnya bernama `uas_wad`, lewat phpMyAdmin atau MySQL client (collation `utf8mb4_unicode_ci`). Jangan membuat tabel apa pun, karena tabel dibuat oleh migrasi. Jika ingin memakai dump SQL, lihat bagian [Berkas `database/laravel.sql`](#berkas-databaselaravelsql) dan lewati langkah 7.

6. **Sesuaikan koneksi database di `.env`.**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=uas_wad
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    Pastikan `APP_ENV=local`, karena seeder hanya memakai password bawaan di lingkungan lokal. `.env.example` sudah memakai `DB_CONNECTION=mysql` dan `DB_DATABASE=laravel`, tetapi tetap sesuaikan host, port, nama database, dan kredensial dengan MySQL Anda.

7. **Buat tabel dan isi data contoh.**

    ```bash
    php artisan migrate --seed
    ```

8. **Jalankan server.**

    ```bash
    php artisan serve
    ```

    Buka http://127.0.0.1:8000 lalu login dengan akun uji di bawah.

### Mengulang dari awal

Untuk mengosongkan dan mengisi ulang database lokal:

```bash
php artisan migrate:fresh --seed
```

Perintah ini menghapus seluruh tabel. Jangan dijalankan pada database yang berisi data penting.

## Akun Uji Lokal

Akun berikut dibuat oleh seeder dan **hanya berlaku di lingkungan lokal**:

| Role  | Email                  | Password   |
| ----- | ---------------------- | ---------- |
| Admin | `wise@randomplay.id`   | `password` |
| Staff | `vivian@randomplay.id` | `password` |

Akun admin memakai password dari `SEED_ADMIN_PASSWORD` dan akun staff memakai password dari `SEED_STAFF_PASSWORD`. Bila variabel tersebut kosong, seeder memakai `password` di lingkungan `local` dan `testing`. Di lingkungan lain, seeder menolak berjalan jika variabel yang dibutuhkan belum diisi.

Data contoh yang ikut dibuat: 3 kategori, 7 produk, dan 2 transaksi stok — `IN-0001` menambah 10 unit pada setiap produk, sedangkan `OUT-0001` mengurangi stok tiga produk pertama.

### Berkas `database/laravel.sql`

Berkas `database/laravel.sql` adalah dump MySQL (format phpMyAdmin) untuk database `laravel`. Berkas ini menyediakan struktur dan data contoh sebagai alternatif `migrate --seed`, dan hanya ditujukan untuk pengujian lokal.

- **Struktur:** 13 tabel, yaitu `users`, `categories`, `products`, `transactions`, `transaction_items`, `migrations`, serta tabel bawaan `cache`, `cache_locks`, `failed_jobs`, `jobs`, `job_batches`, `password_reset_tokens`, dan `sessions`. Setiap `CREATE TABLE` didahului `DROP TABLE IF EXISTS`.
- **Data:** 2 akun (`wise@randomplay.id` sebagai admin dan `vivian@randomplay.id` sebagai staff), 3 kategori, 8 produk, 4 transaksi, dan 12 baris `transaction_items`. Angka ini adalah kondisi database saat dump dibuat, sehingga dapat berbeda dari data seeder.
- **Password:** kolom `password` berisi hash bcrypt (diawali `$2y$`), bukan teks biasa. Hash tersebut sesuai dengan password `password`, sehingga kedua akun dapat login di lingkungan lokal memakai `password`.
- **Constraint:** 4 foreign key dibuat dengan `ALTER TABLE ... ADD CONSTRAINT`, sesuai aturan di bagian [Struktur Basis Data](#struktur-basis-data).
- Berkas ini tidak berisi `CREATE DATABASE` maupun `USE`, sehingga database harus dibuat dan dipilih terlebih dahulu.

Contoh impor (Git Bash atau Command Prompt):

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p laravel < database/laravel.sql
```

Impor akan menghapus tabel yang sudah ada dengan nama yang sama, sehingga jangan dijalankan pada database yang berisi data penting. Setelah impor, jangan menjalankan `php artisan migrate` pada database yang sama karena tabelnya sudah ada.

## Struktur Direktori dan MVC

Bagian yang dibuat atau diubah untuk aplikasi ini (folder bawaan Laravel seperti `config/`, `storage/`, dan `vendor/` tidak ditampilkan):

```
uas-wad/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php        # registrasi, login, logout
│   │   │   ├── DashboardController.php   # ringkasan stok
│   │   │   ├── KategoriController.php    # CRUD kategori
│   │   │   ├── ProdukController.php      # CRUD produk
│   │   │   └── TransaksiController.php   # transaksi stok
│   │   └── Middleware/
│   │       └── CekRole.php               # pembatasan akses per role
│   ├── Models/
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── Transaction.php
│   │   └── TransactionItem.php
│   └── Providers/
│       └── AppServiceProvider.php        # Gate manage-master, https di production
├── bootstrap/app.php                     # alias middleware, trust proxy
├── database/
│   ├── migrations/                       # struktur tabel
│   ├── seeders/                          # data contoh
│   └── laravel.sql                       # dump MySQL siap impor (lihat Akun Uji Lokal)
├── public/
│   ├── index.php                         # front controller Laravel
│   └── css/app.css                       # seluruh gaya tampilan (CSS manual)
├── resources/views/
│   ├── layouts/app.blade.php             # kerangka halaman
│   ├── partials/navbar.blade.php         # navigasi bersama
│   ├── auth/                             # login dan register
│   ├── kategori/
│   ├── produk/                           # termasuk _form.blade.php
│   ├── transaksi/
│   ├── errors/403.blade.php
│   └── dashboard.blade.php
├── routes/web.php                        # seluruh rute aplikasi
├── tests/                                # uji Feature dan Unit (PHPUnit)
├── phpunit.xml                           # konfigurasi pengujian (SQLite in-memory)
├── certs/ca.pem                          # sertifikat CA publik untuk koneksi SSL ke Aiven
├── Dockerfile                            # image untuk deployment
├── docker-compose.yml                    # uji image Docker secara lokal
├── docker/smoke-test.sh                  # smoke test HTTP di dalam container
└── .env.example                          # contoh konfigurasi
```

### Pembagian peran

- **Model** (`app/Models`): mewakili tabel, mendefinisikan relasi Eloquent dan aturan bisnis (misalnya `Product::isLowStock()` dan scope `lowStock`).
- **View** (`resources/views`): template Blade yang hanya menampilkan data. Keluaran memakai `{{ }}` yang otomatis di-escape.
- **Controller** (`app/Http/Controllers`): menerima request, memvalidasi input, memanggil Model, lalu mengembalikan View atau redirect.

### Alur request

```
Browser → public/index.php → middleware (session, CSRF, auth, role)
        → routes/web.php → Controller → Model (MySQL) → View (Blade) → Browser
```

## Struktur Basis Data

Lima tabel utama dengan relasi satu-ke-banyak:

```
categories 1 ──< products 1 ──< transaction_items >── 1 transactions >── 1 users
```

| Tabel               | Kolom utama                                                                                  |
| ------------------- | -------------------------------------------------------------------------------------------- |
| `users`             | `id`, `name`, `email` (unik), `password` (hash), `role`                                      |
| `categories`        | `id`, `name` (unik), `description`                                                           |
| `products`          | `id`, `category_id` (FK), `sku` (unik), `name`, `unit`, `stock`, `min_stock`                 |
| `transactions`      | `id`, `user_id` (FK), `type` (`in`/`out`), `reference_no` (unik), `transaction_date`, `note` |
| `transaction_items` | `id`, `transaction_id` (FK), `product_id` (FK), `quantity`                                   |

Aturan penghapusan:

| Foreign key                        | Aturan     |
| ---------------------------------- | ---------- |
| `products.category_id`             | `RESTRICT` |
| `transactions.user_id`             | `RESTRICT` |
| `transaction_items.product_id`     | `RESTRICT` |
| `transaction_items.transaction_id` | `CASCADE`  |

Tabel bawaan Laravel seperti `sessions`, `cache`, `jobs`, dan `migrations` ikut dibuat oleh migrasi.

## Pengujian

Pengujian memakai PHPUnit 12 dengan konfigurasi di `phpunit.xml`. Lingkungan uji memakai SQLite `:memory:` (lihat variabel `DB_CONNECTION` dan `DB_DATABASE` pada `phpunit.xml`), sehingga tidak menyentuh database MySQL lokal.

```bash
composer test                                   # artisan config:clear + artisan test
php artisan test                                # alternatif langsung
php artisan test --filter=CreatePageAccessTest  # hanya satu kelas uji
```

| Berkas uji                              | Yang diuji                                                                                                                                                        |
| --------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `tests/Feature/CreatePageAccessTest.php` | halaman create kategori dan produk tidak tertelan route `show`, staff mendapat 403, tamu diarahkan ke `/login`, dan parameter non-angka menghasilkan 404             |
| `tests/Feature/ExampleTest.php`          | rute `/` mengalihkan ke `/dashboard`                                                                                                                              |
| `tests/Unit/ExampleTest.php`             | contoh uji unit dasar                                                                                                                                             |

### Uji image Docker secara lokal

`docker-compose.yml` hanya dipakai untuk menguji image hasil `Dockerfile` (meniru kondisi VPS: tanpa `.env`, seluruh konfigurasi lewat variabel lingkungan). Kontainer berjalan dengan `APP_ENV=production`, jadi seeder membutuhkan `SEED_ADMIN_PASSWORD` dan `SEED_STAFF_PASSWORD` secara eksplisit.

```bash
docker compose up -d --build
docker compose exec -e SEED_ADMIN_PASSWORD=password -e SEED_STAFF_PASSWORD=password app php artisan db:seed --force   # isi data contoh
sh docker/smoke-test.sh                                                              # smoke test HTTP dari host
docker compose down                                                                  # tambahkan -v untuk menghapus volume MySQL
```

`docker/smoke-test.sh` memeriksa `/up`, `/login`, `/register`, pengalihan tamu ke halaman login, alur login (session + CSRF), lalu status `/produk`, `/kategori`, `/transaksi`, serta halaman create kategori dan produk. Skrip keluar dengan kode 1 bila ada pemeriksaan yang gagal. Nilai bawaan `BASE_URL=http://localhost:8080`, `EMAIL=wise@randomplay.id`, dan `PASSWORD=password` dapat ditimpa lewat variabel lingkungan.

## Keamanan

| Ancaman                   | Penanganan                                                                                     |
| ------------------------- | ---------------------------------------------------------------------------------------------- |
| CSRF                      | `@csrf` pada setiap form POST, diverifikasi middleware Laravel                                 |
| XSS                       | keluaran Blade `{{ }}` di-escape otomatis, tanpa `{!! !!}` untuk data pengguna                 |
| SQL Injection             | Eloquent dan Query Builder memakai parameter binding, tanpa query mentah dengan input pengguna |
| Mass assignment           | `$fillable` di setiap model dan hanya data hasil `validate()` yang disimpan                    |
| Penyimpanan password      | di-hash dengan bcrypt                                                                          |
| Session fixation          | `session()->regenerate()` setelah login dan `invalidate()` saat logout                         |
| Brute force login         | `throttle` 5 percobaan per menit                                                               |
| Eskalasi hak akses        | role tidak pernah dibaca dari form, registrasi selalu menghasilkan `staff`                     |
| Akses tanpa hak           | middleware `auth` dan `role`, ditambah Gate untuk tampilan                                     |
| Kebocoran informasi error | `APP_DEBUG=false` di production, error dibaca dari log server                                  |
| Race condition stok       | `DB::transaction` dengan `lockForUpdate()` pada baris produk                                   |

## Deployment

Aplikasi live berjalan di Render dengan basis data MySQL di Aiven.

### Arsitektur

```
Browser ──https──► Render (Docker: PHP 8.3 + Apache) ──SSL──► Aiven for MySQL
```

### Langkah ringkas

1. Siapkan layanan **Aiven for MySQL** (paket gratis), catat host, port, user, password, nama database, dan unduh sertifikat CA. Simpan sertifikat CA di `certs/ca.pem` (sertifikat publik, aman di-commit).
2. Dari komputer lokal, arahkan `.env` sementara ke Aiven lalu jalankan `php artisan migrate --seed --force` satu kali, dengan `SEED_ADMIN_PASSWORD` dan `SEED_STAFF_PASSWORD` berisi password kuat. Variabel pertama dipakai untuk akun admin dan variabel kedua untuk akun staff. Setelah selesai, kembalikan `.env` ke konfigurasi lokal.
3. Di Render, buat **Web Service** dari repository GitHub dengan runtime **Docker**, jenis instance gratis, dan health check path `/up`.
4. Isi variabel lingkungan di Render (tabel di bawah).
5. Render membangun image dari `Dockerfile` dan menjalankan aplikasi. Setiap `git push` memicu deploy ulang.

### Variabel lingkungan di Render

| Variabel                                                          | Keterangan                                        |
| ----------------------------------------------------------------- | ------------------------------------------------- |
| `APP_ENV`                                                         | `production`                                      |
| `APP_DEBUG`                                                       | `false`                                           |
| `APP_KEY`                                                         | kunci baru dari `php artisan key:generate --show` |
| `APP_URL`                                                         | `https://uas-wad.onrender.com`                    |
| `LOG_CHANNEL`                                                     | `stderr`                                          |
| `DB_CONNECTION`                                                   | `mysql`                                           |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | dari layanan Aiven                                |
| `MYSQL_ATTR_SSL_CA`                                               | `/var/www/html/certs/ca.pem`                      |
| `SESSION_DRIVER`                                                  | `database`                                        |
| `SESSION_SECURE_COOKIE`                                           | `true`                                            |
| `CACHE_STORE`                                                     | `array`                                           |
| `QUEUE_CONNECTION`                                                | `sync`                                            |

Password database dan `APP_KEY` hanya disimpan sebagai variabel lingkungan di Render, tidak pernah di repository.

### Catatan deployment

- Aplikasi berada di belakang proxy Render, sehingga `trustProxies` diaktifkan di `bootstrap/app.php` dan skema `https` dipaksa di production.
- Migrasi tidak berjalan otomatis saat deploy. Jika `RUN_MIGRATIONS=true`, kontainer menjalankan `php artisan migrate --force` saat start.
- Layanan gratis Aiven dapat dihentikan bila lama tidak dipakai, dan instance gratis Render tertidur saat sepi. Buka URL aplikasi terlebih dahulu untuk "membangunkannya".

## Pemecahan Masalah

| Gejala                                             | Kemungkinan penyebab dan solusi                                     |
| -------------------------------------------------- | ------------------------------------------------------------------- |
| `No application encryption key has been specified` | jalankan `php artisan key:generate`                                 |
| `could not find driver`                            | aktifkan ekstensi `pdo_mysql` di PHP                                |
| `Unknown database`                                 | database belum dibuat atau nama di `.env` tidak sama                |
| `Access denied for user`                           | periksa `DB_USERNAME` dan `DB_PASSWORD` di `.env`                   |
| `Base table or view not found`                     | jalankan `php artisan migrate --seed`                               |
| 419 Page Expired                                   | form tanpa `@csrf`, session kedaluwarsa, atau `APP_URL` salah       |
| Login selalu gagal setelah seeding                 | pastikan `APP_ENV=local` agar password bawaan `password` dipakai    |
| Seeder meminta `SEED_ADMIN_PASSWORD` atau `SEED_STAFF_PASSWORD` | `APP_ENV` bukan `local`. Ubah ke `local` atau isi variabel tersebut |
| Form memakai `http://` di production               | pastikan `trustProxies` aktif dan `APP_URL` berawalan `https://`    |
| Perubahan `.env` tidak terbaca                     | jalankan `php artisan config:clear`                                 |
| Migrasi membuat `database/database.sqlite`         | `DB_CONNECTION` di `.env` bernilai `sqlite`; ubah ke `mysql` lalu jalankan `php artisan config:clear` |
| `docker compose up` berhenti karena database belum siap | tunggu healthcheck MySQL selesai, lalu periksa `docker compose logs app` |
| Smoke test Docker gagal pada `POST /login`         | data contoh belum diisi: `docker compose exec -e SEED_ADMIN_PASSWORD=password -e SEED_STAFF_PASSWORD=password app php artisan db:seed --force` |
| Koneksi Aiven gagal karena sertifikat CA           | pastikan `certs/ca.pem` ada dan `MYSQL_ATTR_SSL_CA=/var/www/html/certs/ca.pem` |
