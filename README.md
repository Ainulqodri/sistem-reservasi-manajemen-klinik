<div align="center">
<h1>Sistem Reservasi & Manajemen Klinik Gigi</h1>
<p><strong>Digitalisasi Layanan Kesehatan Gigi yang Modern, Efisien, dan Terintegrasi</strong></p>
</div>

<br />

📖 Deskripsi Proyek

Proyek ini adalah solusi manajemen digital untuk klinik gigi (seperti drgputri) yang mencakup seluruh alur kerja operasional, mulai dari pendaftaran pasien secara mandiri hingga pengelolaan rekam medis oleh dokter. Sistem ini bertujuan mengurangi antrean fisik dan mengorganisir data medis pasien secara terpusat.

✨ Fitur Utama

<table>
<tr>
<td width="50%">
<h4>🗓️ Reservasi Pasien</h4>
<p>Pasien dapat memilih jadwal kunjungan secara online tanpa harus datang ke klinik terlebih dahulu.</p>
</td>
<td width="50%">
<h4>📂 Rekam Medis Digital</h4>
<p>Penyimpanan riwayat pemeriksaan pasien (odontogram, catatan tindakan) secara digital dan aman.</p>
</td>
</tr>
<tr>
<td>
<h4>💬 Notifikasi WhatsApp</h4>
<p>Integrasi dengan <b>Fonnte Service</b> untuk mengirimkan konfirmasi booking dan pengingat otomatis.</p>
</td>
<td>
<h4>📊 Dashboard Admin</h4>
<p>Panel kontrol untuk melihat statistik harian, mengelola dokter, layanan, dan laporan reservasi.</p>
</td>
</tr>
</table>

🛠️ Stack Teknologi

Sistem ini dibangun menggunakan kombinasi teknologi modern:

    Backend: Laravel 11 (PHP 8.2+)
    
    Frontend: Blade Templating & Tailwind CSS
    
    Interaktivitas: Alpine.js (Lightweight JavaScript)
    
    Integrasi: WhatsApp Gateway via Fonnte Service
    
    Tools: Laragon / XAMPP, Composer, NPM

🚀 Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan project di lingkungan lokal:

### Clone Repository

    git clone [https://github.com/username-kamu/drgputri.git](https://github.com/username-kamu/drgputri.git)


### Instal Dependensi

    composer install
    npm install && npm run build


### Konfigurasi Database

    Buat database baru di MySQL (contoh: db_klinik_gigi).
    
    Salin file .env.example menjadi .env.
    
    Update DB_DATABASE, DB_USERNAME, dan DB_PASSWORD di .env.

### Generate Key & Migrasi

    php artisan key:generate
    php artisan migrate --seed


### Jalankan Aplikasi

    php artisan serve


📂 Struktur Folder Utama

    app/Services/FonnteService.php: Logika pengiriman pesan WhatsApp.
    
    resources/views/UI/: Halaman depan (User Interface) untuk pasien.
    
    resources/views/rekam_medis/: Modul pengelolaan data medis pasien.
    
    app/Helpers/NotifikasiHelper.php: Helper untuk format pesan notifikasi.

<hr />

<div align="center">
<p>© 2026 Drg. Putri Dental Clinic Management System. Developed with ❤️</p>
</div>
