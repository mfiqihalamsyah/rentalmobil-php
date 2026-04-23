# 🚗 Mugi Lancar Transport - Car Rental Website

Website rental mobil sederhana berbasis **PHP & MySQL** yang digunakan untuk menampilkan daftar mobil, status ketersediaan, serta informasi layanan transportasi antar kota.

🌐 **Live Demo:**
http://rentalmobil-php.faqoy.id/

---

## 📌 Features

* ✅ Menampilkan daftar mobil
* ✅ Status mobil (Available / Not Available)
* ✅ Tampilan responsive (Bootstrap)
* ✅ Halaman utama (Landing Page)
* ✅ Navigasi sederhana (Home, Daftar Mobil, Kontak, Login)
* ✅ UI modern dengan desain clean

---

## 🛠️ Tech Stack

**Frontend:**

* HTML5
* CSS3
* Bootstrap
* JavaScript

**Backend:**

* PHP (Native)

**Database:**

* MySQL

---

## 📂 Project Structure

```bash
/project-root
│── index.php
│── daftar-mobil.php
│── kontak.php
│── login.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── config/
│   └── database.php
│
└── database/
    └── rental_mobil.sql
```

---

## ⚙️ Installation & Setup

### 1. Clone Project

```bash
git clone https://github.com/username/rental-mobil-php.git
```

### 2. Pindahkan ke Local Server

Letakkan folder project ke:

* `htdocs` (XAMPP)
* `www` (Laragon)

### 3. Setup Database

* Buka **phpMyAdmin**
* Buat database: `rental_mobil`
* Import file: `/database/rental_mobil.sql`

### 4. Konfigurasi Koneksi

Edit file:

```php
config/database.php
```

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "rental_mobil";
```

### 5. Jalankan Project

Buka di browser:

```
http://localhost/rental-mobil
```

---

## 👨‍💻 Author

**Muhammad Fiqih Alamsyah**
📍 Bekasi, Indonesia
📧 [fiqihalmsyah@gmail.com](mailto:fiqihalmsyah@gmail.com)
🔗 https://www.linkedin.com/in/mfiqihalamsyah

---

## 📖 Background Project

Project ini dibuat sebagai bagian dari tugas akhir:

> "Website Design Mugi Lancar Transport Car Rental using PHP and MySQL"

---

## 🚀 Future Improvements

* 🔐 Sistem login & multi-user
* 📅 Booking system (reservasi)
* 💳 Payment integration
* 📊 Dashboard admin
* 📱 Mobile optimization lebih lanjut
