# 📚 Website Sistem Administrasi Perpustakaan

## Deskripsi Singkat
Aplikasi ini adalah sistem informasi berbasis web yang dirancang untuk mendigitalisasi proses administrasi perpustakaan. Sistem ini menyediakan layanan mandiri (*self-service*) bagi anggota serta alat manajemen lengkap (*back office*) bagi pustakawan, menggantikan proses manual menjadi sistem yang terintegrasi dan *real-time*.

## ✨ Fitur Utama

Sistem ini memiliki 3 kategori fitur utama:

### 1. Fitur Publik & Anggota (Self-Service)
Fitur yang memudahkan anggota mencari buku secara mandiri.
* 🔍 **Pencarian Buku**: Anggota dapat mencari buku berdasarkan judul dan penulis.
* 🏷️ **Filter Pencarian**: Memfilter hasil pencarian berdasarkan kategori buku.
* ✅ **Cek Ketersediaan Real-time**: Memastikan stok buku yang dicari tersedia saat itu juga.
* 📜 **Riwayat Peminjaman**: Anggota dapat melihat log sejarah buku apa saja yang pernah dipinjam.
* 💬 **Memberi Ulasan**: Anggota dapat menulis ulasan buku setelah buku dikembalikan.
* ⭐ **Memberi Rating**: Anggota dapat memberikan penilaian (bintang) setelah buku dikembalikan.

### 2. Fitur Inti & Pasif (Sistem)
Fungsi dasar yang menjembatani sistem dan bekerja secara otomatis.
* 🔐 **Autentikasi Pengguna**: Sistem Login/Logout aman untuk dua role pengguna (Anggota dan Pustakawan).
* 🔔 **Notifikasi Jatuh Tempo**: Sistem otomatis mengecek tanggal dan mengirim peringatan jika waktu pengembalian sudah dekat atau terlewat.

### 3. Fitur Internal Pustakawan (Back Office)
Dashboard admin khusus untuk staf perpustakaan mengelola operasional.
* 🛠️ **Manajemen CRUD**: Pustakawan bisa Menambah, Mengubah, atau Menghapus data (*books, authors, categories, users*).
* 📤 **Transaksi Peminjaman**: Validasi sistem saat anggota meminjam buku.
* 📥 **Transaksi Pengembalian & Denda**: Memproses pengembalian buku, di mana sistem otomatis menghitung keterlambatan dan memproses denda.
* 📄 **Ekspor Laporan**: Mengunduh data rekapitulasi laporan peminjaman dengan status dipinjam beserta denda yang didapat oleh anggota jika terkena denda ke dalam format dokumen.

## 🛠️ Teknologi yang Digunakan
Project ini dibangun menggunakan *stack* berikut:
* **Backend**: PHP, Framework Laravel
* **Frontend Logic**: Livewire (Full-stack framework)
* **UI Framework**: Bootstrap 5 / Tailwind CSS
* **Database**: MySQL
* **Tools**: Composer, Visual Studio Code, Laragon

## ⚙️ Cara Instalasi
Pastikan komputer Anda telah terinstal **PHP**, **Composer**, dan **MySQL**.

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username-kamu/nama-project.git](https://github.com/username-kamu/nama-project.git)
    cd nama-project
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    * Duplikat file `.env.example` menjadi `.env`.
    * Sesuaikan konfigurasi database di file `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_kamu
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate App Key**
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database**
    Jalankan perintah ini untuk membuat tabel dan data awal (seeder):
    ```bash
    php artisan migrate --seed
    ```

## 🚀 Cara Menjalankan Project
Untuk menjalankan server lokal, gunakan perintah berikut di terminal:

```bash
php artisan serve
