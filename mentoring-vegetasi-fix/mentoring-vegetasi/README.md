# Sistem Informasi Data Vegetasi

Aplikasi web berbasis Laravel untuk mendata, mengklasifikasikan, dan memetakan spesies vegetasi di berbagai wilayah. Data taksonomi (kelas, ordo, famili, genus, spesies) dikelola secara hierarkis dan setiap spesies dapat ditampilkan lokasinya pada peta interaktif.

## Fitur Utama

- **Manajemen data taksonomi bertingkat** — Kelas (Classis) → Ordo → Famili → Genus → Spesies, masing-masing dengan relasi foreign key berjenjang (cascade on delete).
- **Manajemen wilayah** — data wilayah pengamatan (kode, nama, luas area) tempat spesies ditemukan.
- **Manajemen tipe vegetasi** — kategori vegetasi lengkap dengan kode warna (hex) untuk keperluan visualisasi.
- **Data spesies detail** — tinggi, diameter, warna daun, koordinat (latitude/longitude), deskripsi, dan foto spesies.
- **Peta interaktif** — visualisasi sebaran spesies berdasarkan koordinat dan tipe vegetasi (`/dashboard/peta`).
- **Ekspor data** — setiap modul (wilayah, vegetasi, kelas, ordo, famili, genus, spesies) dapat diekspor ke Excel dan PDF.
- **Autentikasi dua peran**:
  - **User** — login/register mandiri, akses ke dashboard data & peta.
  - **Admin** — login terpisah (`/admin/login`), mengelola akun pengguna dari dashboard admin.

## Teknologi

| Layer | Teknologi |
|---|---|
| Backend | Laravel 11 (PHP 8.2+) |
| Frontend | Blade, Bootstrap 5, Sass, Vite |
| Database | SQLite (default) / MySQL (opsional) |
| Export | maatwebsite/excel, mpdf/mpdf |

## Struktur Data (Model)

```
Classis (kelas)
  └── Ordo
        └── Famili
              └── Genus
                    └── Spesies ──┬── Wilayah
                                  └── Vegetasi
```

Setiap entitas anak menyimpan `code` unik dan foreign key ke induknya (`fk_id_kelas`, `fk_id_ordo`, `fk_id_famili`, `fk_id_genus`). Spesies juga terhubung ke `Wilayah` dan `Vegetasi`.

## Instalasi & Menjalankan Proyek

1. **Clone repository & masuk ke direktori proyek**
   ```bash
   git clone <repo-url>
   cd mentoring-vegetasi
   ```

2. **Install dependency PHP & JavaScript**
   ```bash
   composer install
   npm install
   ```

3. **Siapkan environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Secara default menggunakan SQLite. Untuk MySQL, ubah `DB_CONNECTION` dan kredensial di `.env`, lalu buat database-nya.

4. **Migrasi database** (opsional tambahkan `--seed` jika ada data awal)
   ```bash
   php artisan migrate
   ```

5. **Jalankan aplikasi**
   ```bash
   php artisan serve
   npm run dev
   ```
   Aplikasi dapat diakses di `http://localhost:8000`.

## Struktur Routing Singkat

- `/` — halaman utama (guest)
- `/login`, `/register` — autentikasi user
- `/dashboard` — dashboard utama (auth)
- `/dashboard/{wilayah|vegetasi|kelas|ordo|famili|genus|spesies}` — CRUD tiap modul + `export/excel` & `export/pdf`
- `/dashboard/peta` — peta sebaran spesies
- `/admin/login` — autentikasi admin
- `/admin/dashboard` — manajemen akun pengguna (auth admin)

## Kontributor

Proyek ini dikembangkan sebagai tugas kelompok mata kuliah Pemrograman Web.
