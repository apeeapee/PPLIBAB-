<div align="center">

# 🛒 **KampuStore**

### *Marketplace Mahasiswa UNDIP - Katalog, Ulasan & Manajemen Toko*

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**Platform e-commerce khusus mahasiswa untuk berjualan dan berbelanja tanpa biaya transaksi**

[Fitur](#-fitur-lengkap) • [Instalasi](#-instalasi) • [Demo](#-demo-akun) • [Tech Stack](#-tech-stack) • [API](#-api-integration)

---

</div>

## 📖 **Tentang KampuStore**

**KampuStore** adalah platform marketplace yang dirancang khusus untuk mahasiswa Universitas Diponegoro (UNDIP). Platform ini memungkinkan mahasiswa untuk:

- 🛍️ **Berbelanja** produk dari sesama mahasiswa tanpa perlu registrasi
- 🏪 **Membuka toko** dan menjual produk dengan proses verifikasi admin
- ⭐ **Memberikan ulasan** dan rating untuk produk yang dibeli
- 📊 **Mengelola bisnis** dengan dashboard lengkap dan laporan terperinci
- 📍 **Integrasi wilayah** Indonesia lengkap (83.000+ kelurahan) via API

> **Catatan:** Platform ini fokus pada katalog, review, dan manajemen toko. Transaksi pembayaran dilakukan di luar sistem (COD/transfer langsung).

---

## ✨ **Fitur Lengkap**

### 🛒 **Untuk Pembeli (Guest/User)**
- ✅ Browsing produk tanpa perlu login
- ✅ Filter produk berdasarkan kategori, rating, dan harga
- ✅ Detail produk lengkap dengan foto, deskripsi, dan ulasan
- ✅ Sistem rating dan review (1-5 bintang)
- ✅ Contact seller via WhatsApp
- ✅ Responsive design untuk mobile dan desktop

### 🏪 **Untuk Penjual (Seller)**
- ✅ **Registrasi toko** dengan verifikasi KTP dan foto selfie
- ✅ **Dashboard penjual** dengan statistik produk dan rating
- ✅ **CRUD Produk** (Create, Read, Update, Delete)
- ✅ **Upload foto produk** multiple dengan preview
- ✅ **Manajemen stok** otomatis
- ✅ **3 Laporan Bisnis:**
  - 📦 Laporan Stok Produk
  - ⭐ Laporan Rating Produk
  - 🔔 Restock Alert (notifikasi stok menipis)
- ✅ **Export laporan** ke Excel (.xlsx)

### 🔐 **Untuk Admin (Platform Manager)**
- ✅ **Verifikasi toko** (approve/reject seller)
- ✅ **Dashboard admin** dengan overview platform
- ✅ **Manajemen seller** dengan status tracking
- ✅ **3 Laporan Platform:**
  - 👥 Daftar Akun Penjual
  - 📍 Distribusi Penjual per Lokasi (Chart.js)
  - 🏆 Peringkat Produk Terbaik
- ✅ **Export laporan** ke Excel dengan formatting

### 🌏 **Fitur Teknis**
- ✅ **API Wilayah Indonesia** (38 provinsi, 83.000+ kelurahan)
- ✅ **Smart caching** untuk performa optimal
- ✅ **Alpine.js** untuk interactive dropdown
- ✅ **Chart.js** untuk visualisasi data
- ✅ **Laravel Excel** untuk export data
- ✅ **Email notifications** untuk verifikasi
- ✅ **Middleware protection** untuk security

---


## 💻 **Tech Stack**

### **Backend**
- **Framework:** Laravel 11.x
- **Language:** PHP 8.2+
- **Database:** MySQL 8.0+
- **ORM:** Eloquent
- **Authentication:** Laravel Breeze (custom)
- **Export:** Maatwebsite Laravel Excel

### **Frontend**
- **CSS Framework:** TailwindCSS 3.x
- **Icons:** Unicons
- **JavaScript:** Alpine.js 3.x
- **Charts:** Chart.js 4.x
- **Fonts:** Google Fonts (Inter)

### **External APIs**
- **Wilayah Indonesia API:** [emsifa/api-wilayah-indonesia](https://github.com/emsifa/api-wilayah-indonesia)
  - 38 Provinsi
  - 514 Kota/Kabupaten
  - 7,200+ Kecamatan
  - **83,000+ Kelurahan/Desa**

### **Development Tools**
- **Composer** 2.x - PHP dependency manager
- **NPM** - Node package manager
- **Vite** - Frontend build tool
- **Git** - Version control

---

## 📋 **System Requirements**

| Component | Minimum | Recommended |
|-----------|---------|-------------|
| **PHP** | 8.2.0 | 8.3+ |
| **MySQL** | 8.0 | 8.0+ |
| **Composer** | 2.5 | Latest |
| **Node.js** | 18.x | 20.x+ |
| **NPM** | 9.x | Latest |
| **Memory** | 512 MB | 1 GB+ |
| **Disk Space** | 500 MB | 1 GB+ |

### **PHP Extensions Required:**
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo
- GD (untuk image upload)
- Zip (untuk Excel export)

---

## 🚀 **Instalasi**

### **1. Clone Repository**
```bash
git clone https://github.com/yourusername/kampustore.git
cd kampustore
```

### **2. Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### **3. Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### **4. Configure Database**

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kampustore
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create database:
```bash
mysql -u root -p
CREATE DATABASE kampustore;
exit;
```

### **5. Run Migrations**
```bash
php artisan migrate
```

### **6. Seed Database (Optional)**
```bash
php artisan db:seed
```

Seeder akan membuat:
- 1 Admin user
- 5 Seller accounts (1 approved, 4 pending)
- 20+ Sample products
- Sample reviews

### **7. Storage Link**
```bash
php artisan storage:link
```

### **8. Build Assets**
```bash
npm run build
# Atau untuk development:
npm run dev
```

### **9. Start Server**
```bash
php artisan serve
```

Akses aplikasi di: **http://127.0.0.1:8000** 🎉

---

## 🔑 **Demo Akun**

Setelah menjalankan `php artisan db:seed`, gunakan akun berikut:

### **👨‍💼 Admin**
```
Email: admin@kampustore.com
Password: admin123
Dashboard: /admin/dashboard
```

### **🏪 Seller (Approved)**
```
Email: seller@kampustore.com
Password: seller123
Dashboard: /seller/dashboard
```

### **🛒 Guest (No Login Required)**
```
Langsung akses: /products
Bisa langsung belanja tanpa registrasi!
```

---

## 🌐 **API Integration**

KampuStore mengintegrasikan **API Wilayah Indonesia** untuk data alamat lengkap:

### **Endpoints Used:**
```javascript
BASE_URL: https://www.emsifa.com/api-wilayah-indonesia/api

GET /provinces.json              // 38 Provinsi
GET /regencies/{prov_id}.json    // Kota/Kabupaten
GET /districts/{city_id}.json    // Kecamatan
GET /villages/{dist_id}.json     // Kelurahan/Desa
```

### **Features:**
- ✅ Dynamic cascading dropdowns
- ✅ Smart client-side caching
- ✅ Offline fallback data
- ✅ Loading states
- ✅ Error handling

### **Coverage:**
- **38** Provinsi di Indonesia
- **514** Kota/Kabupaten
- **7,200+** Kecamatan
- **83,000+** Kelurahan/Desa

Data diambil langsung dari API saat user registrasi toko.

---

## 📁 **Project Structure**

```
kampustore/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── SellerController.php
│   │   │   │   └── ReportController.php
│   │   │   ├── Seller/         # Seller controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── ReportController.php
│   │   │   ├── AuthController.php
│   │   │   ├── ProductController.php
│   │   │   └── ReviewController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Seller.php
│   │   ├── Product.php
│   │   └── Review.php
│   └── Exports/                # Excel export classes
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── Admin/              # Admin views
│       │   ├── Dashboard.blade.php
│       │   ├── Sellers/
│       │   └── reports/
│       ├── Seller/             # Seller views
│       │   ├── dashboard.blade.php
│       │   ├── products/
│       │   └── reports/
│       ├── auth/               # Auth pages
│       ├── products/           # Public product pages
│       └── home.blade.php      # Landing page
├── routes/
│   └── web.php                 # All routes
└── public/
    └── images/                 # Uploaded images
```

---

## 🎨 **Screenshots**

### **Homepage**
Landing page dengan hero section dan featured products.

### **Product Catalog**
Grid layout responsive dengan filter dan search.

### **Seller Dashboard**
Overview produk, rating, dan quick actions.

### **Admin Reports**
Charts dan tabel dengan export to Excel.

### **Registration Form**
Form lengkap dengan API wilayah Indonesia.

---


## 📝 **License**

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 👥 **Contributors**

Developed with ❤️ by Team KampuStore - UNDIP Software Engineering Students

- **Project Manager:** -
- **Lead Developer:** -
- **Backend Developer:** -
- **Frontend Developer:** -
- **QA Tester:** -

---

## 🙏 **Acknowledgments**

- **Laravel** - The PHP Framework for Web Artisans
- **TailwindCSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Maatwebsite Excel** - Laravel Excel package
- **Chart.js** - Simple yet flexible JavaScript charting
- **API Wilayah Indonesia** by [emsifa](https://github.com/emsifa/api-wilayah-indonesia)
- **Unicons** - Open-source icon library

---

## 📧 **Contact & Support**

Untuk pertanyaan, bug reports, atau feature requests:

- **Email:** kampustore@undip.ac.id
- **GitHub Issues:** [Create an issue](https://github.com/yourusername/kampustore/issues)

---

<div align="center">

**Made with ❤️ for UNDIP Students**

⭐ Star this repo if you find it helpful!

</div>
