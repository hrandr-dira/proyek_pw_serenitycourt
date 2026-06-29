# Serenity Court - Sistem Reservasi Lapangan Olahraga

**Serenity Court** adalah platform reservasi digital untuk pemesanan lapangan Futsal, Badminton, dan Basket secara real-time [3, 4]. Proyek ini bertujuan meningkatkan efisiensi pengelolaan reservasi tanpa harus datang ke lokasi [5].

## 🚀 Fitur Utama
* **Multi-User Access:** Login terpisah untuk Customer dan Admin [6, 7].
* **Real-time Booking:** Cek ketersediaan jadwal melalui kalender interaktif [8].
* **Sistem Pembayaran:** Mendukung Transfer Bank, E-wallet, dan Cash [8, 9].
* **Feedback & Support:** Fitur rating layanan dan bantuan admin via WhatsApp/Email [10-12].

## 🛠️ Tech Stack & Environment
* **Local Server:** Laragon
* **Database Manager:** HeidiSQL
* **Database Name:** serenity-court
* **Editor:** Anti Gravity
* **Languages:** HTML, CSS, JavaScript (Node.js) [13]

## 📂 Struktur Database (ERD)
Berdasarkan ERD sistem, tabel utama meliputi [14]:
1. **User:** (ID_User, Nama, Email, Password, Nomor_Telepon, Role)
2. **Lapangan:** (ID_Lapangan, Jenis, Fasilitas, Harga, Foto)
3. **Reservasi:** (ID_Reservasi, Tanggal, Waktu, Status)
4. **Pembayaran:** (ID_Pembayaran, Bukti_Transaksi, Status_Pembayaran)
5. **Feedback:** (ID_Feedback, Bintang, Ulasan)