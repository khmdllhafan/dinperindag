# 🏛️ Sistem Informasi Perjalanan Dinas (SIMPD) - Dinperindag Kab. Pekalongan

> **Sistem Informasi Manajemen dan Pelacakan Perjalanan Dinas Berbasis Web**  
> Dikembangkan untuk Dinas Perindustrian dan Perdagangan Kabupaten Pekalongan.

---

## 📋 Tentang Proyek
**SIMPD Dinperindag** adalah aplikasi berbasis web yang dirancang untuk mengotomatisasi proses pengelolaan, pencatatan, dan pelacakan data perjalanan dinas pegawai secara efektif dan transparan. Sistem ini mempermudah pencatatan kegiatan dinas, rekapitulasi data bulanan, visualisasi grafik analitik, serta pembuatan laporan resmi berupa dokumen spreadsheet maupun PDF secara instan.

---

## ✨ Fitur Utama
* **Manajemen Pengguna (User Management)**: Pengaturan hak akses dan akun pengguna internal instansi.
* **Pencatatan Perjalanan Dinas**: Modul input, pembaruan, dan pelacakan data detail kegiatan perjalanan dinas pegawai.
* **Analitik & Visualisasi Grafik**: Menampilkan grafik statistik dan rekapitulasi perjalanan dinas bulanan secara dinamis.
* **Ekspor Laporan Otomatis**: Fitur untuk menghasilkan lembar laporan terstruktur dan dokumen akuntansi dalam format Spreadsheet (Excel) menggunakan pustaka PhpSpreadsheet serta cetak PDF.
* **Dashboard Instansi**: Ringkasan data operasional perjalanan dinas untuk mendukung pengambilan keputusan.

---

## 🛠️ Teknologi yang Digunakan
* **Framework Backend**: [CodeIgniter 4](https://codeigniter.com/) (PHP Full-Stack Framework)
* **Bahasa Pemrograman**: PHP, JavaScript, HTML5, CSS3
* **Library Export**: PhpOffice / PhpSpreadsheet
* **Database**: MySQL
* **Server Lokal**: Laragon / Apache

---

## 📂 Struktur Direktori Proyek
```text
dinperindag/
├── app/
│   ├── Controllers/     # Logika kontroler (Auth, Perjalanan Dinas, Laporan, User)
│   ├── Models/          # Model interaksi database MySQL
│   └── Views/           # Antarmuka web (Dashboard, Form Dinas, Grafik Analitik)
├── public/              # Document Root (index.php, aset CSS/JS/Gambar)
├── writable/            # Direktori log, sesi, dan penyimpanan file sementara
├── .env                 # Konfigurasi environment & koneksi database
└── README.md
