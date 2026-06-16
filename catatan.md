# 🐾 PANDUAN PERTAHANAN SKRIPSI: SISTEM MANAJEMEN PET SHOP & KLINIK HEWAN

Catatan ini disusun khusus untuk **Ka Syahla** agar dapat memahami sistem secara mendalam dan menjawab pertanyaan dosen penguji dengan tegas dan teknis.

---

## 1. KONSEP DASAR SISTEM (The "Why")
Jika dosen bertanya: *"Apa inti dari sistem yang kamu buat?"*

**Jawaban:**
"Sistem ini adalah **Clinical Management System** yang mengintegrasikan alur operasional klinik hewan (medis) dengan sistem kasir (administrasi). Keunggulannya bukan sekadar CRUD data, melainkan pada **State Management** (pengelolaan status) yang memastikan setiap pasien melewati prosedur yang benar, mulai dari pendaftaran hingga pembayaran."

---

## 2. PENJELASAN ALUR KERJA (Workflow)
Dosen sering bertanya tentang alur data. Hafalkan urutan status ini:

1.  **Booking**: Pemilik mendaftarkan hewan untuk layanan (Vet, Grooming, atau Hotel).
2.  **Advent**: Hewan telah tiba di lokasi (Check-in).
3.  **Checkup**: Dokter hewan melakukan pemeriksaan dan mengisi **Medical Record** (Rekam Medis).
4.  **Pharmacy**: Dokter meresepkan obat (mengurangi stok di database).
5.  **Payment**: Admin/Kasir membuat **Invoice** berdasarkan layanan dan obat.
6.  **Done**: Status otomatis berubah menjadi selesai setelah invoice dibayar.

---

## 3. ASPEK TEKNIS (The "How")
Gunakan istilah ini untuk terlihat sangat paham koding:

*   **Framework**: Laravel (PHP). 
    *   *Kenapa?* Karena memiliki fitur keamanan bawaan seperti proteksi CSRF, SQL Injection, dan sistem Middleware yang kuat.
*   **Database Relasional**: 
    *   Relasi **One-to-Many**: Satu Pemilik (Owner) bisa punya banyak Hewan (Pet).
    *   Relasi **Many-to-Many**: Satu Rekam Medis (`medical_records`) bisa berisi banyak Obat (`medicines`) melalui tabel pivot, sehingga dosis dan jumlah obat bisa tercatat spesifik.
*   **Middleware Role**: Sistem membedakan akses Admin dan Doctor secara otomatis. Jika user mencoba masuk ke halaman yang bukan haknya, sistem akan menolak (403 Forbidden).

---

## 4. ANATOMI APLIKASI (Di mana letak "Otak" sistem?)

Jika dosen bertanya: *"Di mana kamu meletakkan logika sistem ini?"* atau *"Bagaimana file-file ini saling terhubung?"*

### A. Otak Aplikasi (Controllers)
Lokasi: `app/Http/Controllers/`
*   **Fungsi**: Di sinilah "otak" aplikasi berada. Controller menerima perintah dari user, mengolah data, dan memutuskan apa yang harus ditampilkan.
*   **Contoh Penting**: 
    *   `Admin/InvoiceController.php`: Otak yang mengatur perhitungan uang dan pembuatan tagihan.
    *   `Doctor/AppointmentController.php`: Otak yang mengatur alur pasien (dari datang sampai pulang).
    *   `Doctor/MedicalRecordController.php`: Otak yang mencatat riwayat penyakit dan resep obat.

### B. Struktur Data (Models)
Lokasi: `app/Models/`
*   **Fungsi**: Representasi dari tabel database. File ini memberitahu Laravel tentang hubungan antar data (misal: "Satu hewan memiliki banyak rekam medis").
*   **File Kunci**: `Pet.php`, `Owner.php`, `Appointment.php`.

### C. Wajah Aplikasi (Views / Blade)
Lokasi: `resources/views/`
*   **Fungsi**: Apa yang dilihat oleh user di browser. Menggunakan teknologi **Blade Engine** milik Laravel.
*   **Kenapa pakai Blade?** Karena kita bisa menyisipkan logika PHP yang simpel langsung di HTML (seperti `@if`, `@foreach`) sehingga tampilan bisa dinamis (misal: menampilkan warna merah jika invoice belum lunas).
*   **Pembagian Folder**:
    *   `admin/`: Tampilan khusus untuk Admin (Invoices, Products, Services).
    *   `doctor/`: Tampilan khusus untuk Dokter (Appointments, Medical Records, Inpatients).
    *   `layouts/`: Template dasar agar header dan sidebar konsisten di semua halaman.

### D. Peta Jalan (Routes)
Lokasi: `routes/web.php`
*   **Fungsi**: Peta jalan aplikasi. File ini yang menentukan: "Jika user klik tombol Dashboard, arahkan ke Controller mana". Ini adalah pintu masuk pertama setiap permintaan user.

### E. Cetak Biru Database (Migrations)
Lokasi: `database/migrations/`
*   **Fungsi**: Instruksi untuk membuat tabel-tabel di database secara otomatis. Jika sistem ini dipindah ke komputer lain, kita cukup menjalankan perintah `php artisan migrate`.

---

## 5. PREDIKSI PERTANYAAN "KILLER" & JAWABANNYA

**Q: Bagaimana cara sistem menjamin stok obat berkurang saat dokter memberikan resep?**
**A:** "Pada `MedicalRecordController`, saya menggunakan fungsi `attach` atau `sync` pada relasi Many-to-Many. Secara sistem, data obat terhubung dengan tabel rekam medis, dan Admin bisa memantau sisa stok di menu Medicines untuk melakukan restock jika sudah tipis."

**Q: Mengapa Invoice tidak dibuat manual saja? Mengapa harus terhubung dengan Appointment?**
**A:** "Untuk menjaga **Integritas Data**. Dengan menghubungkan Invoice ke Appointment ID, kita mencegah terjadinya kesalahan input harga atau kelalaian pembayaran. Sistem memastikan tidak ada pasien yang pulang sebelum tagihannya tercatat (status 'Done' hanya aktif jika 'Paid')."

**Q: Bagaimana jika ada hewan yang harus dirawat inap (Inpatient)?**
**A:** "Sistem memiliki modul khusus `Inpatient`. Dokter bisa mengubah status hewan menjadi 'Active' di ruang inap, mencatat rencana perawatan (`treatment_plan`), dan memantau tanggal keluar (`discharge_date`) secara real-time."

---

## 6. TEKNOLOGI YANG DIGUNAKAN (Tech Stack)
*   **Backend**: Laravel 11.
*   **Frontend**: Blade Templating + Vanilla CSS (untuk performa ringan dan kustomisasi desain premium).
*   **Database**: MySQL.
*   **Library Tambahan**: Chart.js (untuk grafik pertumbuhan klien di dashboard admin).

---

**Tips Tambahan untuk Ka Syahla:**
- Jangan panik. Jika ditanya sesuatu yang belum ada di aplikasi, jawab: *"Itu adalah rencana pengembangan (future development) untuk meningkatkan skalabilitas sistem."*
- Tunjukkan bagian **Dashboard**. Dosen sangat suka melihat data yang divisualisasikan dengan grafik (Chart.js).

---
*Dibuat dengan presisi oleh Malxgmn Asistent atas perintah Tuan Versaa.*
