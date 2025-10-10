# 🚗 Website Peminjaman Mobil — SewaMobil

Website **SewaMobil** adalah aplikasi berbasis web yang dibuat untuk mempermudah proses **penyewaan dan pengelolaan data mobil** secara digital.  
Aplikasi ini dirancang menggunakan **PHP Native** dan **MySQL**, serta didukung tampilan responsif dengan **Bootstrap**, sehingga dapat digunakan oleh admin maupun pengguna dengan mudah.

---

## 🧭 Gambaran Umum

Dalam dunia yang serba cepat saat ini, proses penyewaan mobil sering kali masih dilakukan secara manual.  
Website **SewaMobil** hadir sebagai solusi untuk membantu pengelola rental mobil dalam mencatat, mengatur, dan memonitor data kendaraan serta transaksi peminjaman secara online.

Melalui sistem ini:
- **Admin** dapat menambahkan data mobil baru, mengelola transaksi penyewaan, dan memantau status mobil.  
- **Pengguna** dapat melihat daftar mobil yang tersedia, melihat detail mobil, serta melakukan pemesanan secara langsung.

Dengan desain antarmuka yang sederhana dan mudah digunakan, proyek ini cocok untuk dijadikan **tugas akhir, PKL, atau latihan pembuatan aplikasi CRUD berbasis web.**

---

## ⚙️ Teknologi yang Digunakan

| Komponen | Deskripsi |
|-----------|------------|
| **Bahasa Pemrograman** | PHP Native |
| **Database** | MySQL |
| **Tampilan (UI)** | HTML, CSS, dan Bootstrap |
| **Script Tambahan** | JavaScript |
| **Server Lokal** | XAMPP / LAMP / Laragon |

---

## 📂 Struktur Folder Proyek

Berikut struktur utama dari proyek `sewa_mobil/`:


---

## ✨ Fitur Utama

### 👨‍💼 Fitur Admin
- Login dan Logout aman menggunakan session  
- Dashboard berisi ringkasan data mobil & peminjaman  
- CRUD Data Mobil: Tambah, Edit, Hapus, Upload Gambar  
- Kelola Data Peminjaman: tambah, ubah, hapus, dan pengembalian  
- Update status mobil menjadi **“disewa”** atau **“tersedia”**

### 🚘 Fitur Pengguna
- Melihat daftar mobil yang tersedia untuk disewa  
- Melihat detail mobil (harga, gambar, deskripsi)  
- Mengisi form pemesanan mobil secara langsung  
- Tampilan bersih, ringan, dan mudah digunakan  

---

## 🧠 Penjelasan Alur Website

1. **Pengguna** membuka halaman utama `user/index.php`, lalu memilih mobil yang tersedia.  
2. Setelah memilih, pengguna dapat melihat **detail mobil** dan mengklik tombol **Sewa Sekarang** untuk mengisi form pemesanan.  
3. **Admin** dapat login melalui `login.php` untuk mengelola semua data melalui halaman dashboard.  
4. Di dalam panel admin, terdapat fitur **CRUD** mobil serta **data peminjaman**, yang otomatis memperbarui status mobil di database.  
5. Setelah mobil dikembalikan, admin dapat menandainya sebagai **“tersedia”** melalui menu **kembalikan.php**.

Dengan cara ini, seluruh proses penyewaan dapat dikelola tanpa harus menggunakan catatan manual lagi.

---

## 🚀 Cara Menjalankan Proyek

1. **Clone atau ekstrak proyek**
   ```bash
   git clone https://github.com/username/sewa_mobil.git


