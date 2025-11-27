@php($title = 'Daftar Sebagai Penjual | KampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .input-field {
            width: 100%;
            padding: 12px 16px;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            color: #111827;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        
        .label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .error-msg {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
    </style>
</head>
<body class="min-h-screen">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-lg border-b border-purple-200 shadow-lg">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent flex items-center gap-2">
                <i class="uil uil-shop"></i>
                KampuStore
            </a>
            <a href="{{ route('login') }}" class="text-sm text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-2 transition">
                <i class="uil uil-signin"></i>
                Sudah punya akun penjual? Login
            </a>
        </div>
    </div>
</nav>

<main class="pt-28 pb-12 px-4">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-white backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-10">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full mb-4">
                    <i class="uil uil-store-alt text-4xl text-purple-600"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Daftar Sebagai Penjual</h1>
                <p class="text-gray-600 mb-3 text-lg">Lengkapi data toko dan informasi pemilik untuk verifikasi</p>
                
                @if(session('error'))
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-200 rounded-2xl p-5 text-sm text-red-700 max-w-2xl mx-auto mb-4">
                    <div class="flex items-start gap-3">
                        <i class="uil uil-exclamation-triangle text-2xl text-red-600 mt-0.5"></i>
                        <div class="text-left">
                            <strong class="text-red-700 block mb-1">{{ session('error') }}</strong>
                        </div>
                    </div>
                </div>
                @endif
                
                @if(session('info'))
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-2xl p-5 text-sm text-blue-700 max-w-2xl mx-auto mb-4">
                    <div class="flex items-start gap-3">
                        <i class="uil uil-info-circle text-2xl text-blue-600 mt-0.5"></i>
                        <div class="text-left">
                            <span>{{ session('info') }}</span>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-2xl p-5 text-sm text-gray-700 max-w-2xl mx-auto">
                    <div class="flex items-start gap-3">
                        <i class="uil uil-shopping-cart text-2xl text-purple-600 mt-0.5"></i>
                        <div class="text-left">
                            <strong class="text-purple-700 block mb-1">📢 Penting untuk Pembeli:</strong>
                            <span class="block mb-2">Jika Anda ingin <strong>berbelanja</strong>, TIDAK perlu registrasi atau login!</span>
                            <span class="block">Langsung kunjungi <a href="{{ route('products.index') }}" class="text-purple-600 underline hover:text-purple-700 font-semibold">halaman market</a> dan belanja sebagai guest. Form ini hanya untuk <strong>penjual yang ingin buka toko</strong>.</span>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- SECTION 1: DATA TOKO --}}
                <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-6 border-2 border-indigo-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-indigo-600 text-white rounded-full font-bold">1</div>
                        <h2 class="text-xl font-bold text-gray-900">Informasi Toko</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="label">Nama Toko *</label>
                            <input type="text" name="nama_toko" value="{{ old('nama_toko') }}" required class="input-field" placeholder="Nama toko Anda">
                            @error('nama_toko')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Deskripsi Singkat *</label>
                            <textarea name="deskripsi_singkat" rows="3" required class="input-field" placeholder="Jelaskan tentang toko Anda">{{ old('deskripsi_singkat') }}</textarea>
                            @error('deskripsi_singkat')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: DATA PEMILIK TOKO (PIC) --}}
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border-2 border-blue-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-bold">2</div>
                        <h2 class="text-xl font-bold text-gray-900">Data Pemilik Toko (Anda)</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Nama Lengkap *</label>
                            <input type="text" name="nama_pic" value="{{ old('nama_pic') }}" required class="input-field" placeholder="Nama lengkap Anda">
                            @error('nama_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">No. Handphone / WhatsApp * <span class="text-xs text-gray-500">(format: 08xxx)</span></label>
                            <input type="text" name="no_hp_pic" value="{{ old('no_hp_pic') }}" required pattern="(\\+62|62|0)[0-9]{9,12}" class="input-field" placeholder="081234567890">
                            <p class="text-xs text-gray-500 mt-1">Contoh: 081234567890 atau +6281234567890</p>
                            @error('no_hp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Email * <span class="text-xs text-gray-500">(gunakan untuk login)</span></label>
                            <input type="email" name="email_pic" value="{{ old('email_pic') }}" required class="input-field" placeholder="email@example.com">
                            @error('email_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">No. KTP (NIK) * <span class="text-xs text-gray-500">(16 digit)</span></label>
                            <input type="text" name="no_ktp_pic" value="{{ old('no_ktp_pic') }}" required maxlength="16" pattern="[0-9]{16}" class="input-field" placeholder="3374010101010001">
                            <p class="text-xs text-gray-500 mt-1">Harus 16 digit angka</p>
                            @error('no_ktp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Password * <span class="text-xs text-gray-500">(min. 8 karakter)</span></label>
                            <input type="password" name="password" required class="input-field" placeholder="Buat password untuk akun">
                            @error('password')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Konfirmasi Password *</label>
                            <input type="password" name="password_confirmation" required class="input-field" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: ALAMAT --}}
                <div class="bg-gradient-to-br from-teal-50 to-white rounded-2xl p-6 border-2 border-teal-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-teal-600 text-white rounded-full font-bold">3</div>
                        <h2 class="text-xl font-bold text-gray-900">Alamat Lengkap</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="label">Alamat (Nama Jalan) *</label>
                            <input type="text" name="alamat_pic" value="{{ old('alamat_pic') }}" required class="input-field" placeholder="Jl. Contoh No. 123">
                            @error('alamat_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label">Provinsi *</label>
                                <select name="provinsi" id="provinsi" required class="input-field">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Aceh" {{ old('provinsi') == 'Aceh' ? 'selected' : '' }}>Aceh</option>
                                    <option value="Sumatera Utara" {{ old('provinsi') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                    <option value="Sumatera Barat" {{ old('provinsi') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                                    <option value="Riau" {{ old('provinsi') == 'Riau' ? 'selected' : '' }}>Riau</option>
                                    <option value="Kepulauan Riau" {{ old('provinsi') == 'Kepulauan Riau' ? 'selected' : '' }}>Kepulauan Riau</option>
                                    <option value="Jambi" {{ old('provinsi') == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                                    <option value="Sumatera Selatan" {{ old('provinsi') == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                                    <option value="Kepulauan Bangka Belitung" {{ old('provinsi') == 'Kepulauan Bangka Belitung' ? 'selected' : '' }}>Kepulauan Bangka Belitung</option>
                                    <option value="Bengkulu" {{ old('provinsi') == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                                    <option value="Lampung" {{ old('provinsi') == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                                    <option value="DKI Jakarta" {{ old('provinsi') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                    <option value="Banten" {{ old('provinsi') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                    <option value="Jawa Barat" {{ old('provinsi') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                    <option value="Jawa Tengah" {{ old('provinsi') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                    <option value="DI Yogyakarta" {{ old('provinsi') == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                                    <option value="Jawa Timur" {{ old('provinsi') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                    <option value="Bali" {{ old('provinsi') == 'Bali' ? 'selected' : '' }}>Bali</option>
                                    <option value="Nusa Tenggara Barat" {{ old('provinsi') == 'Nusa Tenggara Barat' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                                    <option value="Nusa Tenggara Timur" {{ old('provinsi') == 'Nusa Tenggara Timur' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                                    <option value="Kalimantan Barat" {{ old('provinsi') == 'Kalimantan Barat' ? 'selected' : '' }}>Kalimantan Barat</option>
                                    <option value="Kalimantan Tengah" {{ old('provinsi') == 'Kalimantan Tengah' ? 'selected' : '' }}>Kalimantan Tengah</option>
                                    <option value="Kalimantan Selatan" {{ old('provinsi') == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                                    <option value="Kalimantan Timur" {{ old('provinsi') == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                                    <option value="Kalimantan Utara" {{ old('provinsi') == 'Kalimantan Utara' ? 'selected' : '' }}>Kalimantan Utara</option>
                                    <option value="Sulawesi Utara" {{ old('provinsi') == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                                    <option value="Gorontalo" {{ old('provinsi') == 'Gorontalo' ? 'selected' : '' }}>Gorontalo</option>
                                    <option value="Sulawesi Tengah" {{ old('provinsi') == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                                    <option value="Sulawesi Barat" {{ old('provinsi') == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                                    <option value="Sulawesi Selatan" {{ old('provinsi') == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                                    <option value="Sulawesi Tenggara" {{ old('provinsi') == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                                    <option value="Maluku" {{ old('provinsi') == 'Maluku' ? 'selected' : '' }}>Maluku</option>
                                    <option value="Maluku Utara" {{ old('provinsi') == 'Maluku Utara' ? 'selected' : '' }}>Maluku Utara</option>
                                    <option value="Papua" {{ old('provinsi') == 'Papua' ? 'selected' : '' }}>Papua</option>
                                    <option value="Papua Barat" {{ old('provinsi') == 'Papua Barat' ? 'selected' : '' }}>Papua Barat</option>
                                    <option value="Papua Tengah" {{ old('provinsi') == 'Papua Tengah' ? 'selected' : '' }}>Papua Tengah</option>
                                    <option value="Papua Pegunungan" {{ old('provinsi') == 'Papua Pegunungan' ? 'selected' : '' }}>Papua Pegunungan</option>
                                    <option value="Papua Selatan" {{ old('provinsi') == 'Papua Selatan' ? 'selected' : '' }}>Papua Selatan</option>
                                    <option value="Papua Barat Daya" {{ old('provinsi') == 'Papua Barat Daya' ? 'selected' : '' }}>Papua Barat Daya</option>
                                </select>
                                @error('provinsi')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="label">Kota/Kabupaten *</label>
                                <select name="kota" id="kota" required class="input-field">
                                    <option value="">Pilih kota/kabupaten</option>
                                </select>
                                @error('kota')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label">Kecamatan *</label>
                                <select name="kecamatan" id="kecamatan" required class="input-field">
                                    <option value="">Pilih kecamatan</option>
                                </select>
                                @error('kecamatan')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="label">Kelurahan/Desa *</label>
                                <select name="kelurahan" id="kelurahan" required class="input-field">
                                    <option value="">Pilih kelurahan/desa</option>
                                </select>
                                @error('kelurahan')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label class="label">RT *</label>
                                <input type="text" name="rt" value="{{ old('rt') }}" required class="input-field" placeholder="001">
                                @error('rt')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="label">RW *</label>
                                <input type="text" name="rw" value="{{ old('rw') }}" required class="input-field" placeholder="002">
                                @error('rw')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2">
                                <label class="label">Kode Pos *</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" required maxlength="5" pattern="[0-9]{5}" class="input-field" placeholder="50275">
                                <p class="text-xs text-gray-500 mt-1">5 digit angka</p>
                                @error('kode_pos')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- SECTION 4: DOKUMEN --}}
                <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-6 border-2 border-orange-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-orange-600 text-white rounded-full font-bold">4</div>
                        <h2 class="text-xl font-bold text-gray-900">Dokumen Verifikasi</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Foto Anda (Selfie) *</label>
                            <input type="file" name="foto_pic" required accept="image/jpeg,image/jpg,image/png" 
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-900 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-500 mt-2">Foto wajah jelas, Format: JPG, JPEG, PNG (Max. 2MB)</p>
                            @error('foto_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">File Scan KTP *</label>
                            <input type="file" name="file_ktp_pic" required accept="application/pdf,image/jpeg,image/jpg,image/png"
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-900 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-500 mt-2">Scan atau foto KTP yang jelas, Format: PDF, JPG, JPEG, PNG (Max. 4MB)</p>
                            @error('file_ktp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-2xl transition duration-300 transform hover:scale-105 flex items-center justify-center gap-3 text-lg">
                    <i class="uil uil-check-circle text-2xl"></i>
                    Daftar Sekarang
                </button>
                
                <p class="text-center text-sm text-gray-600">
                    Dengan mendaftar, Anda menyetujui syarat & ketentuan KampuStore
                </p>
            </form>

        </div>
    </div>
</main>

<footer class="bg-white/95 backdrop-filter backdrop-blur-lg border-t border-purple-200 py-6 mt-12">
    <div class="container mx-auto px-4 text-center">
        <p class="text-gray-600 text-sm">
            &copy; {{ date('Y') }} <strong class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">KampuStore</strong> - Marketplace Mahasiswa UNDIP
        </p>
    </div>
</footer>

<script>
// API Wilayah Indonesia - wilayah.id (Data Lengkap 2025)
const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

// Cache untuk menyimpan data yang sudah di-fetch (agar tidak fetch ulang)
const dataCache = {
    provinces: null,
    regencies: {},
    districts: {},
    villages: {}
};

// Helper function untuk fetch data dari API
async function fetchWilayahData(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) throw new Error('Network response was not ok');
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
        return [];
    }
}

// Fallback data untuk offline mode (data minimal)
const wilayahData = {
    "DKI Jakarta": {
        "Jakarta Pusat": {
            "Menteng": ["Menteng", "Pegangsaan", "Cikini", "Kebon Sirih", "Gondangdia"],
            "Tanah Abang": ["Tanah Abang", "Bendungan Hilir", "Karet Tengsin", "Petamburan", "Kebon Melati"],
            "Gambir": ["Gambir", "Cideng", "Petojo Utara", "Petojo Selatan", "Duri Pulo"],
            "Kemayoran": ["Kemayoran", "Gunung Sahari Selatan", "Serdang", "Cempaka Putih Timur"],
            "Sawah Besar": ["Pasar Baru", "Karang Anyar", "Kartini", "Gunung Sahari"],
            "Cempaka Putih": ["Cempaka Putih Barat", "Cempaka Putih Timur", "Rawasari"],
            "Johar Baru": ["Johar Baru", "Kampung Rawa", "Galur", "Tanah Tinggi"],
            "Senen": ["Senen", "Kramat", "Bungur", "Paseban", "Kwitang"]
        },
        "Jakarta Utara": {
            "Koja": ["Koja", "Tugu Utara", "Tugu Selatan", "Lagoa", "Rawa Badak"],
            "Kelapa Gading": ["Kelapa Gading Barat", "Kelapa Gading Timur", "Pegangsaan Dua"],
            "Tanjung Priok": ["Tanjung Priok", "Sunter Agung", "Sunter Jaya", "Papanggo"],
            "Pademangan": ["Pademangan Barat", "Pademangan Timur", "Ancol"],
            "Penjaringan": ["Penjaringan", "Pluit", "Pejagalan", "Kamal Muara"],
            "Cilincing": ["Cilincing", "Kalibaru", "Semper", "Sukapura", "Marunda"]
        },
        "Jakarta Barat": {
            "Kebon Jeruk": ["Kebon Jeruk", "Sukabumi Utara", "Kelapa Dua", "Duri Kepa"],
            "Tambora": ["Tambora", "Roa Malaka", "Pekojan", "Jembatan Lima"],
            "Taman Sari": ["Taman Sari", "Krukut", "Maphar", "Tangki"],
            "Grogol Petamburan": ["Grogol", "Tomang", "Wijaya Kusuma", "Jelambar"],
            "Cengkareng": ["Cengkareng Barat", "Cengkareng Timur", "Kapuk", "Kedaung Kaliangke"],
            "Kalideres": ["Kalideres", "Semanan", "Tegal Alur", "Pegadungan", "Kamal"],
            "Palmerah": ["Palmerah", "Slipi", "Kota Bambu", "Jatipulo"],
            "Kembangan": ["Kembangan Utara", "Kembangan Selatan", "Meruya Utara", "Meruya Selatan"]
        },
        "Jakarta Selatan": {
            "Kebayoran Baru": ["Selong", "Gunung", "Kramat Pela", "Gandaria Utara", "Cipete Utara"],
            "Kebayoran Lama": ["Kebayoran Lama Utara", "Kebayoran Lama Selatan", "Pondok Pinang", "Cipulir"],
            "Cilandak": ["Cilandak", "Lebak Bulus", "Pondok Labu", "Cipete Selatan"],
            "Jagakarsa": ["Jagakarsa", "Lenteng Agung", "Tanjung Barat", "Ciganjur"],
            "Mampang Prapatan": ["Mampang Prapatan", "Bangka", "Pela Mampang", "Kuningan Barat"],
            "Pancoran": ["Pancoran", "Kalibata", "Rawa Jati", "Duren Tiga", "Cikoko"],
            "Pasar Minggu": ["Pasar Minggu", "Jati Padang", "Ragunan", "Cilandak Timur"],
            "Pesanggrahan": ["Pesanggrahan", "Bintaro", "Petukangan Utara", "Ulujami"],
            "Setiabudi": ["Setiabudi", "Kuningan Timur", "Karet", "Karet Semanggi"],
            "Tebet": ["Tebet Barat", "Tebet Timur", "Kebon Baru", "Bukit Duri", "Manggarai"]
        },
        "Jakarta Timur": {
            "Matraman": ["Matraman", "Palmeriam", "Kebon Manggis", "Utan Kayu"],
            "Pulo Gadung": ["Pulo Gadung", "Pisangan Timur", "Rawamangun", "Jati"],
            "Jatinegara": ["Jatinegara", "Kampung Melayu", "Bidaracina", "Cipinang"],
            "Kramat Jati": ["Kramat Jati", "Batu Ampar", "Balekambang", "Cawang"],
            "Pasar Rebo": ["Pasar Rebo", "Cijantung", "Gedong", "Baru"],
            "Cakung": ["Cakung Barat", "Cakung Timur", "Pulo Gebang", "Ujung Menteng"],
            "Cipayung": ["Cipayung", "Bambu Apus", "Cilangkap", "Pondok Ranggon"],
            "Ciracas": ["Ciracas", "Susukan", "Cibubur", "Kelapa Dua Wetan"],
            "Duren Sawit": ["Duren Sawit", "Pondok Bambu", "Pondok Kelapa", "Malaka Jaya"],
            "Makasar": ["Makasar", "Pinang Ranti", "Kebon Pala", "Halim Perdana Kusuma"]
        },
        "Kepulauan Seribu": {
            "Pulau Tidung": ["Tidung Besar", "Tidung Kecil"],
            "Pulau Pramuka": ["Pramuka", "Panggang"],
            "Pulau Harapan": ["Harapan", "Kelapa"],
            "Pulau Untung Jawa": ["Untung Jawa"]
        }
    },
    "Jawa Barat": {
        "Kota Bandung": ["Cibeunying Kidul", "Cibeunying Kaler", "Coblong", "Sukasari", "Sukajadi", "Cicendo", "Andir", "Bandung Kulon", "Bandung Wetan", "Sumur Bandung", "Regol", "Batununggal", "Lengkong", "Buah Batu", "Cidadap", "Antapani", "Arcamanik", "Cibiru"],
        "Kota Bogor": ["Bogor Selatan", "Bogor Timur", "Bogor Utara", "Bogor Tengah", "Bogor Barat", "Tanah Sareal"],
        "Kota Depok": ["Beji", "Cimanggis", "Limo", "Pancoran Mas", "Sawangan", "Sukmajaya", "Cinere", "Cilodong", "Cipayung", "Tapos"],
        "Kota Bekasi": ["Bekasi Timur", "Bekasi Barat", "Bekasi Selatan", "Bekasi Utara", "Medan Satria", "Pondok Gede", "Jatiasih", "Jatisampurna", "Bantargebang", "Mustika Jaya", "Rawalumbu"],
        "Kota Cirebon": ["Kejaksan", "Lemahwungkuk", "Harjamukti", "Pekalipan", "Kesambi"],
        "Kota Sukabumi": ["Baros", "Cikole", "Citamiang", "Gunung Puyuh", "Lembursitu", "Warudoyong"],
        "Kabupaten Bandung": ["Soreang", "Baleendah", "Majalaya", "Ciparay", "Cicalengka", "Rancaekek", "Banjaran"],
        "Kabupaten Bogor": ["Cibinong", "Cileungsi", "Gunung Putri", "Ciawi", "Cariu", "Jonggol", "Parung"],
        "Kabupaten Bekasi": ["Cikarang Pusat", "Cikarang Utara", "Cikarang Selatan", "Tambun Selatan", "Tambun Utara", "Cibitung"],
        "Kabupaten Karawang": ["Karawang Barat", "Karawang Timur", "Klari", "Telukjambe", "Cikampek"],
        "Kabupaten Garut": ["Garut Kota", "Tarogong Kidul", "Tarogong Kaler", "Leles", "Karangpawitan"],
        "Kabupaten Cianjur": ["Cianjur", "Warungkondang", "Mande", "Cibeber", "Cipanas"]
    },
    "Jawa Tengah": {
        "Kota Semarang": {
            "Semarang Tengah": ["Purwodinatan", "Kauman", "Pekunden", "Miroto", "Brumbungan", "Pandansari", "Pindrikan Kidul", "Pindrikan Lor", "Kranggan", "Gabahan", "Jagalan", "Karangkidul", "Kembangsari", "Bangunharjo"],
            "Semarang Utara": ["Kuningan", "Bandarharjo", "Tanjung Mas", "Panggung Lor", "Plombokan", "Purwosari", "Dadapsari", "Bulu Lor"],
            "Semarang Timur": ["Mlatibaru", "Mlatiharjo", "Karangtempel", "Kemijen", "Bugangan", "Rejomulyo", "Rejosari", "Sarirejo", "Kebonagung", "Karangturi"],
            "Semarang Selatan": ["Lamper Lor", "Lamper Kidul", "Lamper Tengah", "Randusari", "Barusari", "Bulustalan", "Pleburan", "Wonodri", "Peterongan", "Mugassari"],
            "Semarang Barat": ["Ngemplak Simongan", "Tambakharjo", "Karangayu", "Bongsari", "Gisikdrono", "Manyaran", "Cabean", "Salaman Mloyo", "Krapyak", "Krobokan", "Bojong Salaman"],
            "Gayamsari": ["Kaligawe", "Sambirejo", "Sawah Besar", "Gayamsari", "Siwalan", "Pandean Lamper", "Tambakrejo"],
            "Candisari": ["Candi", "Jomblang", "Jatingaleh", "Wonotingal", "Karanganyar Gunung", "Kaliwiru", "Tegalsari"],
            "Gajahmungkur": ["Gajahmungkur", "Bendungan", "Lempongsari", "Sampangan", "Petompon", "Karangkidul", "Sari Rejo"],
            "Tembalang": ["Tembalang", "Bulusan", "Mangunharjo", "Meteseh", "Sendangmulyo", "Kramas", "Tandang", "Rowosari", "Sendangguwo", "Sambiroto", "Jangli"],
            "Banyumanik": ["Banyumanik", "Srondol Kulon", "Srondol Wetan", "Tinjomoyo", "Ngesrep", "Sumurboto", "Padangsari", "Pedalangan", "Pudakpayung", "Gedawang"],
            "Gunungpati": ["Gunungpati", "Sadeng", "Pongangan", "Pakintelan", "Nongkosawit", "Sukorejo", "Kandri", "Ngijo", "Sekaran", "Mangunsari", "Plalangan", "Patemon"],
            "Pedurungan": ["Pedurungan Tengah", "Pedurungan Lor", "Pedurungan Kidul", "Kalicari", "Tlogomulyo", "Palebon", "Penggaron Lor", "Plamongan Sari", "Muktiharjo Lor", "Gemah"],
            "Genuk": ["Genuksari", "Banjardowo", "Trimulyo", "Bangetayu Kulon", "Bangetayu Wetan", "Gebangsari", "Muktiharjo Kidul", "Kudu", "Terboyo Kulon", "Terboyo Wetan"],
            "Tugu": ["Randugarut", "Tugurejo", "Jrakah", "Karanganyar", "Mangkang Kulon", "Mangkang Wetan"],
            "Ngaliyan": ["Ngaliyan", "Podorejo", "Purwoyoso", "Kalipancur", "Gondoriyo", "Tambakaji", "Wonosari", "Beringin", "Bambankerep"],
            "Mijen": ["Mijen", "Jatibarang", "Ngadirgo", "Bubakan", "Kedungpane", "Cangkiran", "Wonoplumbon", "Wonolopo", "Jatisari", "Polaman"]
        },
        "Kota Surakarta": ["Laweyan", "Serengan", "Pasar Kliwon", "Jebres", "Banjarsari"],
        "Kota Magelang": ["Magelang Utara", "Magelang Tengah", "Magelang Selatan"],
        "Kota Salatiga": ["Sidorejo", "Argomulyo", "Tingkir", "Sidomukti"],
        "Kota Pekalongan": ["Pekalongan Barat", "Pekalongan Timur", "Pekalongan Utara", "Pekalongan Selatan"],
        "Kota Tegal": ["Tegal Barat", "Tegal Timur", "Tegal Selatan", "Margadana"],
        "Kabupaten Semarang": ["Ungaran", "Bergas", "Bawen", "Ambarawa", "Bandungan", "Sumowono"],
        "Kabupaten Kendal": ["Kendal", "Kaliwungu", "Cepiring", "Pegandon", "Weleri"],
        "Kabupaten Demak": ["Demak", "Mranggen", "Sayung", "Karangtengah", "Bonang"],
        "Kabupaten Kudus": ["Kudus", "Jati", "Bae", "Gebog", "Dawe"],
        "Kabupaten Jepara": ["Jepara", "Tahunan", "Pecangaan", "Kalinyamatan", "Mayong"],
        "Kabupaten Pati": ["Pati", "Juwana", "Tayu", "Batangan", "Margoyoso"],
        "Kabupaten Rembang": ["Rembang", "Lasem", "Pamotan", "Kragan", "Sluke"],
        "Kabupaten Blora": ["Blora", "Cepu", "Jiken", "Randublatung", "Kunduran"],
        "Kabupaten Grobogan": ["Purwodadi", "Godong", "Wirosari", "Gubug", "Karangrayung"],
        "Kabupaten Boyolali": ["Boyolali", "Mojosongo", "Ampel", "Banyudono", "Sawit"],
        "Kabupaten Klaten": ["Klaten Utara", "Klaten Tengah", "Klaten Selatan", "Ceper", "Pedan", "Trucuk"],
        "Kabupaten Sukoharjo": ["Sukoharjo", "Kartasura", "Grogol", "Bendosari", "Weru"],
        "Kabupaten Wonogiri": ["Wonogiri", "Pracimantoro", "Girimarto", "Purwantoro", "Selogiri"],
        "Kabupaten Karanganyar": ["Karanganyar", "Jaten", "Colomadu", "Kebakkramat", "Tasikmadu"],
        "Kabupaten Sragen": ["Sragen", "Masaran", "Gemolong", "Tanon", "Sidoharjo"]
    },
    "DI Yogyakarta": {
        "Kota Yogyakarta": ["Mantrijeron", "Kraton", "Mergangsan", "Umbulharjo", "Kotagede", "Gondokusuman", "Danurejan", "Pakualaman", "Gondomanan", "Ngampilan", "Wirobrajan", "Gedongtengen", "Jetis", "Tegalrejo"],
        "Kabupaten Sleman": ["Sleman", "Depok", "Gamping", "Godean", "Mlati", "Ngaglik", "Ngemplak", "Kalasan", "Prambanan", "Berbah"],
        "Kabupaten Bantul": ["Bantul", "Sewon", "Kasihan", "Pandak", "Piyungan", "Pleret", "Imogiri", "Sedayu"],
        "Kabupaten Gunung Kidul": ["Wonosari", "Playen", "Semanu", "Karangmojo", "Panggang"],
        "Kabupaten Kulon Progo": ["Wates", "Pengasih", "Sentolo", "Lendah", "Galur"]
    },
    "Jawa Timur": {
        "Kota Surabaya": ["Asemrowo", "Benowo", "Bubutan", "Bulak", "Dukuh Pakis", "Gayungan", "Genteng", "Gubeng", "Gunung Anyar", "Jambangan", "Karang Pilang", "Kenjeran", "Krembangan", "Lakarsantri", "Mulyorejo", "Pabean Cantian", "Pakal", "Rungkut", "Sambikerep", "Sawahan", "Semampir", "Simokerto", "Sukolilo", "Sukomanunggal", "Tambaksari", "Tandes", "Tegalsari", "Tenggilis Mejoyo", "Wiyung", "Wonocolo", "Wonokromo"],
        "Kota Malang": ["Blimbing", "Kedungkandang", "Klojen", "Lowokwaru", "Sukun"],
        "Kota Kediri": ["Mojoroto", "Kota Kediri", "Pesantren"],
        "Kota Blitar": ["Kepanjenkidul", "Sananwetan", "Sukorejo"],
        "Kota Madiun": ["Manguharjo", "Taman", "Kartoharjo"],
        "Kota Mojokerto": ["Magersari", "Prajurit Kulon"],
        "Kota Pasuruan": ["Bugulkidul", "Gadingrejo", "Panggungrejo"],
        "Kota Probolinggo": ["Kademangan", "Kanigaran", "Kedopok", "Mayangan", "Wonoasih"],
        "Kota Batu": ["Batu", "Junrejo", "Bumiaji"],
        "Kabupaten Sidoarjo": ["Sidoarjo", "Waru", "Gedangan", "Taman", "Krian", "Buduran"],
        "Kabupaten Gresik": ["Gresik", "Kebomas", "Manyar", "Cerme", "Driyorejo"],
        "Kabupaten Mojokerto": ["Mojokerto", "Sooko", "Trowulan", "Jatirejo", "Jetis"],
        "Kabupaten Jombang": ["Jombang", "Mojoagung", "Ploso", "Tembelang", "Perak"],
        "Kabupaten Pasuruan": ["Pasuruan", "Pandaan", "Prigen", "Bangil", "Grati"],
        "Kabupaten Malang": ["Kepanjen", "Singosari", "Lawang", "Turen", "Batu"]
    },
    "Banten": {
        "Kota Tangerang": ["Ciledug", "Larangan", "Karang Tengah", "Cipondoh", "Pinang", "Tangerang"],
        "Kota Tangerang Selatan": ["Serpong", "Pondok Aren", "Ciputat", "Ciputat Timur", "Pamulang", "Setu", "Serpong Utara"],
        "Kota Serang": ["Serang", "Kasemen", "Cipocok Jaya", "Taktakan", "Curug", "Walantaka"],
        "Kota Cilegon": ["Cilegon", "Cibeber", "Ciwandan", "Jombang", "Pulomerak"],
        "Kabupaten Tangerang": ["Tigaraksa", "Cisauk", "Serpong", "Cikupa", "Pasar Kemis", "Balaraja"],
        "Kabupaten Serang": ["Ciruas", "Kramatwatu", "Waringinkurung", "Pontang", "Tirtayasa"],
        "Kabupaten Lebak": ["Rangkasbitung", "Maja", "Warunggunung", "Cibadak", "Malingping"],
        "Kabupaten Pandeglang": ["Pandeglang", "Labuan", "Carita", "Sumur", "Munjul"]
    },
    "Bali": {
        "Kota Denpasar": ["Denpasar Barat", "Denpasar Selatan", "Denpasar Timur", "Denpasar Utara"],
        "Kabupaten Badung": ["Kuta", "Mengwi", "Abiansemal", "Petang", "Kuta Selatan", "Kuta Utara"],
        "Kabupaten Gianyar": ["Gianyar", "Blahbatuh", "Sukawati", "Ubud", "Tampaksiring", "Tegallalang", "Payangan"],
        "Kabupaten Tabanan": ["Tabanan", "Kediri", "Kerambitan", "Marga", "Penebel", "Selemadeg"],
        "Kabupaten Buleleng": ["Singaraja", "Buleleng", "Sukasada", "Sawan", "Kubutambahan", "Tejakula"],
        "Kabupaten Karangasem": ["Karangasem", "Abang", "Rendang", "Sidemen", "Selat", "Bebandem"],
        "Kabupaten Klungkung": ["Semarapura", "Banjarangkan", "Dawan", "Nusa Penida"],
        "Kabupaten Jembrana": ["Negara", "Mendoyo", "Pekutatan", "Melaya", "Jembrana"]
    },
    "Sumatera Utara": {
        "Kota Medan": ["Medan Kota", "Medan Barat", "Medan Timur", "Medan Utara", "Medan Selatan", "Medan Area", "Medan Denai", "Medan Tembung", "Medan Helvetia", "Medan Petisah", "Medan Selayang", "Medan Sunggal"],
        "Kota Binjai": ["Binjai Kota", "Binjai Utara", "Binjai Selatan", "Binjai Timur", "Binjai Barat"],
        "Kota Tebing Tinggi": ["Tebing Tinggi Kota", "Padang Hilir", "Rambutan", "Bajenis"],
        "Kota Pematang Siantar": ["Siantar Barat", "Siantar Timur", "Siantar Utara", "Siantar Selatan"],
        "Kabupaten Deli Serdang": ["Lubuk Pakam", "Sunggal", "Patumbak", "Percut Sei Tuan", "Labuhan Deli"],
        "Kabupaten Langkat": ["Stabat", "Binjai", "Kuala", "Sei Lepan", "Bahorok"]
    },
    "Sumatera Barat": {
        "Kota Padang": ["Padang Utara", "Padang Timur", "Padang Barat", "Padang Selatan", "Koto Tangah", "Lubuk Begalung", "Kuranji", "Nanggalo"],
        "Kota Bukittinggi": ["Guguk Panjang", "Mandiangin Koto Selayan", "Aur Birugo Tigo Baleh"],
        "Kota Payakumbuh": ["Payakumbuh Barat", "Payakumbuh Timur", "Payakumbuh Utara", "Payakumbuh Selatan"],
        "Kabupaten Padang Pariaman": ["Parit Malintang", "Lubuk Alung", "Batang Anai", "Nan Sabaris"],
        "Kabupaten Agam": ["Lubuk Basung", "Ampek Angkek", "Candung", "Banuhampu"]
    },
    "Aceh": {
        "Kota Banda Aceh": ["Banda Raya", "Baiturrahman", "Jaya Baru", "Kuta Alam", "Kuta Raja", "Lueng Bata", "Meuraxa", "Syiah Kuala", "Ulee Kareng"],
        "Kota Lhokseumawe": ["Banda Sakti", "Blang Mangat", "Muara Dua", "Muara Satu"],
        "Kabupaten Aceh Besar": ["Jantho", "Indrapuri", "Kuta Baro", "Lembah Seulawah", "Leupung"]
    },
    "Sulawesi Selatan": {
        "Kota Makassar": ["Makassar", "Mariso", "Mamajang", "Tamalate", "Rappocini", "Panakkukang", "Manggala", "Biringkanaya", "Tamalanrea", "Tallo", "Ujung Pandang", "Wajo", "Bontoala", "Ujung Tanah"],
        "Kabupaten Gowa": ["Sungguminasa", "Somba Opu", "Bontomarannu", "Pallangga", "Barombong"]
    },
    "Kalimantan Timur": {
        "Kota Samarinda": ["Samarinda Ulu", "Samarinda Ilir", "Samarinda Utara", "Samarinda Seberang", "Palaran", "Sambutan"],
        "Kota Balikpapan": ["Balikpapan Utara", "Balikpapan Timur", "Balikpapan Barat", "Balikpapan Selatan", "Balikpapan Tengah", "Balikpapan Kota"],
        "Kota Bontang": ["Bontang Utara", "Bontang Selatan", "Bontang Barat"],
        "Kabupaten Kutai Kartanegara": ["Tenggarong", "Loa Janan", "Loa Kulu", "Samboja", "Muara Jawa"],
        "Kabupaten Paser": ["Tanah Grogot", "Kuaro", "Long Ikis", "Muara Samu"]
    },
    "Kalimantan Barat": {
        "Kota Pontianak": ["Pontianak Kota", "Pontianak Timur", "Pontianak Barat", "Pontianak Selatan", "Pontianak Utara", "Pontianak Tenggara"],
        "Kota Singkawang": ["Singkawang Barat", "Singkawang Tengah", "Singkawang Timur", "Singkawang Utara", "Singkawang Selatan"],
        "Kabupaten Kubu Raya": ["Sungai Raya", "Rasau Jaya", "Teluk Pakedai", "Batu Ampar"],
        "Kabupaten Mempawah": ["Mempawah Hilir", "Mempawah Timur", "Sungai Kunyit", "Sungai Pinyuh"],
        "Kabupaten Sanggau": ["Sanggau Kapuas", "Sanggau Ledo", "Tayan Hilir", "Bonti"]
    },
    "Kalimantan Tengah": {
        "Kota Palangka Raya": ["Pahandut", "Sabangau", "Jekan Raya", "Bukit Batu", "Rakumpit"],
        "Kabupaten Kotawaringin Barat": ["Arut Selatan", "Pangkalan Banteng", "Kotawaringin Lama", "Arut Utara"],
        "Kabupaten Kapuas": ["Kuala Kapuas", "Selat", "Basarang", "Mantangai"],
        "Kabupaten Barito Selatan": ["Buntok", "Dusun Selatan", "Dusun Utara", "Jenamas"],
        "Kabupaten Pulang Pisau": ["Kahayan Hilir", "Kahayan Tengah", "Jabiren Raya", "Maliku"]
    },
    "Kalimantan Selatan": {
        "Kota Banjarmasin": ["Banjarmasin Tengah", "Banjarmasin Barat", "Banjarmasin Timur", "Banjarmasin Selatan", "Banjarmasin Utara"],
        "Kota Banjarbaru": ["Banjarbaru Utara", "Banjarbaru Selatan", "Cempaka", "Landasan Ulin", "Liang Anggang"],
        "Kabupaten Banjar": ["Martapura", "Pengaron", "Sungai Tabuk", "Kertak Hanyar", "Gambut"],
        "Kabupaten Tanah Laut": ["Pelaihari", "Jorong", "Panyipatan", "Takisung", "Kintap"],
        "Kabupaten Barito Kuala": ["Marabahan", "Tabukan", "Anjir Muara", "Belawang", "Mandastana"]
    },
    "Kalimantan Utara": {
        "Kota Tarakan": ["Tarakan Barat", "Tarakan Tengah", "Tarakan Timur", "Tarakan Utara"],
        "Kabupaten Bulungan": ["Tanjung Selor", "Tanjung Palas", "Tanjung Palas Barat", "Peso", "Peso Hilir"],
        "Kabupaten Malinau": ["Malinau Kota", "Malinau Barat", "Malinau Selatan", "Malinau Utara"],
        "Kabupaten Nunukan": ["Nunukan", "Sebatik", "Lumbis", "Sembakung", "Krayan"]
    },
    "Riau": {
        "Kota Pekanbaru": ["Sukajadi", "Pekanbaru Kota", "Sail", "Lima Puluh", "Senapelan", "Rumbai", "Bukit Raya", "Marpoyan Damai"],
        "Kota Dumai": ["Dumai Barat", "Dumai Timur", "Dumai Kota", "Bukit Kapur", "Medang Kampai"],
        "Kabupaten Kampar": ["Bangkinang", "Bangkinang Seberang", "Tapung", "Kampar", "Siak Hulu"],
        "Kabupaten Pelalawan": ["Pangkalan Kerinci", "Langgam", "Pangkalan Kuras", "Ukui"],
        "Kabupaten Siak": ["Siak Sri Indrapura", "Minas", "Tualang", "Sungai Apit", "Kerinci Kanan"]
    },
    "Kepulauan Riau": {
        "Kota Batam": ["Batam Kota", "Sekupang", "Sei Beduk", "Lubuk Baja", "Batu Aji", "Nongsa", "Bengkong", "Sagulung"],
        "Kota Tanjung Pinang": ["Tanjungpinang Kota", "Tanjungpinang Timur", "Tanjungpinang Barat", "Bukit Bestari"],
        "Kabupaten Bintan": ["Bintan Timur", "Bintan Utara", "Gunung Kijang", "Tanjung Uban"],
        "Kabupaten Karimun": ["Tanjung Balai Karimun", "Moro", "Kundur", "Karimun"],
        "Kabupaten Natuna": ["Ranai", "Bunguran Timur", "Bunguran Barat", "Serasan"]
    },
    "Jambi": {
        "Kota Jambi": {
            "Telanaipura": ["Telanaipura", "Tambak Sari", "Buluran Kenali", "Sungai Asam", "Eka Jaya"],
            "Jambi Selatan": ["Pasir Putih", "Kenali Besar", "Kenali Asam Bawah", "Payo Lebar"],
            "Kotabaru": ["Ulu Gedong", "Sijinjang", "Kebun Handil", "Sungai Putri"],
            "Jelutung": ["Jelutung", "Handil Jaya", "Cempaka Putih", "Payo Selincah"],
            "Pasar Jambi": ["Pasar Jambi", "Talang Banjar", "Beringin", "Sungai Hitam"],
            "Pelayangan": ["Pelayangan", "Talang Jauh", "Mudung Laut", "Kasang"],
            "Danau Teluk": ["Olak Kemang", "Lanjut", "Danau Teluk", "Penyengat Olak"],
            "Jambi Timur": ["The Hok", "Sulanjana", "Tambak Sari", "Pakuan Baru"]
        },
        "Kota Sungai Penuh": {
            "Sungai Penuh": ["Sungai Penuh", "Pasar Sungai Penuh", "Koto Renah", "Tanah Kampung"],
            "Pesisir Bukit": ["Pesisir Bukit", "Dusun Baru", "Sumur Anyir", "Koto Tinggi"],
            "Kumun Debai": ["Kumun Debai", "Kumun Mudik", "Dusun Tengah", "Koto Beringin"],
            "Tanah Kampung": ["Tanah Kampung", "Pasar Tanah Kampung", "Pelayang Raya", "Dusun Dalam"]
        },
        "Kabupaten Batang Hari": {
            "Muara Bulian": ["Muara Bulian", "Sengeti", "Pulau Pauh", "Teratai"],
            "Maro Sebo": ["Maro Sebo Ilir", "Maro Sebo Ulu", "Sungai Baung", "Bulian Jaya"],
            "Mersam": ["Mersam", "Rantau Gedang", "Sungai Landai", "Terusan"],
            "Bajubang": ["Bajubang", "Simpang", "Olak", "Limbur Tembesi"]
        },
        "Kabupaten Muaro Jambi": {
            "Sengeti": ["Sengeti", "Bukit Baling", "Sungai Baung", "Simpang Sungai Duren"],
            "Mestong": ["Mestong", "Aur Gading", "Kebon IX", "Pematang Gajah"],
            "Jambi Luar Kota": ["Pijoan", "Simpang Sei Duren", "Kasang Pudak", "Muara Kumpeh"],
            "Sekernan": ["Sekernan", "Pudak", "Olak Besar", "Sungai Gelam"]
        },
        "Kabupaten Bungo": {
            "Muara Bungo": ["Bungo Dani", "Jujun", "Pasir Putih", "Bungo Tanjung"],
            "Pelepat": ["Pelepat", "Batu Kerbau", "Pelepat Ilir", "Jangkat"],
            "Jujuhan": ["Jujuhan", "Jujuhan Ilir", "Tanah Tumbuh", "Sako"],
            "Tanah Sepenggal": ["Tanah Sepenggal", "Pelayang", "Tanah Periuk", "Renah Kayu Embun"]
        }
    },
    "Sumatera Selatan": {
        "Kota Palembang": ["Ilir Barat I", "Ilir Timur I", "Seberang Ulu I", "Kertapati", "Plaju", "Sako", "Sukarami", "Alang-Alang Lebar"],
        "Kota Prabumulih": ["Prabumulih Barat", "Prabumulih Timur", "Prabumulih Utara", "Prabumulih Selatan"],
        "Kota Lubuk Linggau": ["Lubuklinggau Barat I", "Lubuklinggau Timur I", "Lubuklinggau Selatan I", "Lubuklinggau Utara I"],
        "Kabupaten Ogan Ilir": ["Indralaya", "Tanjung Batu", "Rantau Alai", "Payaraman"],
        "Kabupaten Muara Enim": ["Muara Enim", "Lawang Kidul", "Gelumbang", "Talang Ubi"]
    },
    "Kepulauan Bangka Belitung": {
        "Kota Pangkal Pinang": ["Pangkalpinang Barat", "Pangkalpinang Timur", "Rangkui", "Bukit Intan", "Taman Sari"],
        "Kabupaten Bangka": ["Sungailiat", "Belinyu", "Merawang", "Bakam", "Pemali"],
        "Kabupaten Bangka Barat": ["Muntok", "Simpang Teritip", "Tempilang", "Kelapa"],
        "Kabupaten Bangka Tengah": ["Koba", "Simpang Katis", "Namang", "Pangkalan Baru"],
        "Kabupaten Belitung": ["Tanjung Pandan", "Badau", "Membalong", "Sijuk"]
    },
    "Bengkulu": {
        "Kota Bengkulu": ["Gading Cempaka", "Muara Bangkahulu", "Ratu Agung", "Ratu Samban", "Teluk Segara"],
        "Kabupaten Bengkulu Tengah": ["Karang Tinggi", "Talang Empat", "Pondok Kelapa", "Pematang Tiga"],
        "Kabupaten Bengkulu Utara": ["Arga Makmur", "Air Besi", "Air Napal", "Hulu Palik"],
        "Kabupaten Rejang Lebong": ["Curup", "Sindang Kelingi", "Bermani Ilir", "Selupu Rejang"],
        "Kabupaten Seluma": ["Tais", "Semidang Alas", "Seluma", "Sukaraja"]
    },
    "Lampung": {
        "Kota Bandar Lampung": ["Telukbetung Barat", "Telukbetung Timur", "Tanjung Karang Barat", "Tanjung Karang Timur", "Kedaton", "Rajabasa"],
        "Kota Metro": ["Metro Pusat", "Metro Barat", "Metro Timur", "Metro Selatan", "Metro Utara"],
        "Kabupaten Lampung Selatan": ["Kalianda", "Sidomulyo", "Katibung", "Candipuro", "Rajabasa"],
        "Kabupaten Lampung Tengah": ["Gunung Sugih", "Trimurjo", "Punggur", "Seputih Banyak"],
        "Kabupaten Lampung Utara": ["Kotabumi", "Abung Selatan", "Tanjung Raja", "Bukit Kemuning"]
    },
    "Nusa Tenggara Barat": {
        "Kota Mataram": ["Ampenan", "Cakranegara", "Mataram", "Sekarbela", "Selaparang", "Sandubaya"],
        "Kota Bima": ["Raba", "Asakota", "Rasanae Barat", "Rasanae Timur", "Mpunda"],
        "Kabupaten Lombok Barat": ["Gerung", "Labuapi", "Narmada", "Kediri", "Kuripan"],
        "Kabupaten Lombok Tengah": ["Praya", "Pujut", "Jonggat", "Batukliang", "Kopang"],
        "Kabupaten Lombok Timur": ["Selong", "Masbagik", "Aikmel", "Suralaga", "Pringgabaya"]
    },
    "Nusa Tenggara Timur": {
        "Kota Kupang": ["Oebobo", "Kelapa Lima", "Maulafa", "Alak", "Kota Lama", "Kota Raja"],
        "Kabupaten Kupang": ["Kupang Tengah", "Kupang Barat", "Kupang Timur", "Sulamu", "Amarasi"],
        "Kabupaten Manggarai": ["Ruteng", "Langke Rembong", "Cibal", "Reok", "Satar Mese"],
        "Kabupaten Ende": ["Ende", "Ende Selatan", "Ende Timur", "Ndona", "Nangapanda"],
        "Kabupaten Flores Timur": ["Larantuka", "Ile Mandiri", "Tanjung Bunga", "Solor Timur"]
    },
    "Sulawesi Utara": {
        "Kota Manado": ["Malalayang", "Sario", "Wenang", "Tikala", "Paal Dua", "Singkil", "Tuminting", "Bunaken"],
        "Kota Bitung": ["Matuari", "Maesa", "Ranowulu", "Girian", "Lembeh Selatan"],
        "Kota Tomohon": ["Tomohon Barat", "Tomohon Tengah", "Tomohon Timur", "Tomohon Utara", "Tomohon Selatan"],
        "Kabupaten Minahasa": ["Tondano", "Eris", "Kombi", "Tompaso", "Remboken"],
        "Kabupaten Minahasa Utara": ["Airmadidi", "Kauditan", "Kalawat", "Wori", "Dimembe"]
    },
    "Gorontalo": {
        "Kota Gorontalo": ["Kota Barat", "Kota Selatan", "Kota Timur", "Kota Tengah", "Kota Utara", "Dungingi", "Hulonthalangi"],
        "Kabupaten Gorontalo": ["Limboto", "Telaga", "Tibawa", "Boliyohuto", "Batudaa"],
        "Kabupaten Gorontalo Utara": ["Kwandang", "Anggrek", "Sumalata", "Tolinggula"],
        "Kabupaten Bone Bolango": ["Suwawa", "Bone", "Bone Raya", "Kabila", "Tapa"],
        "Kabupaten Pohuwato": ["Marisa", "Paguat", "Randangan", "Dengilo"]
    },
    "Sulawesi Tengah": {
        "Kota Palu": ["Palu Barat", "Palu Timur", "Palu Selatan", "Palu Utara", "Tatanga", "Ulujadi", "Mantikulore", "Tawaeli"],
        "Kabupaten Donggala": ["Banawa", "Tanantovea", "Rio Pakava", "Sindue", "Labuan"],
        "Kabupaten Poso": ["Poso Kota", "Poso Pesisir", "Lage", "Pamona Selatan", "Tentena"],
        "Kabupaten Parigi Moutong": ["Parigi", "Tinombo", "Sausu", "Ampibabo", "Balinggi"],
        "Kabupaten Tojo Una-Una": ["Ampana", "Ulubongka", "Tojo", "Tojo Barat"]
    },
    "Sulawesi Barat": {
        "Kabupaten Mamuju": ["Mamuju", "Simboro", "Tapalang", "Kalukku", "Papalang"],
        "Kabupaten Mamuju Utara": ["Pasangkayu", "Bambalamotu", "Duripoku", "Tikke Raya"],
        "Kabupaten Majene": ["Banggae", "Pamboang", "Sendana", "Malunda", "Ulumanda"],
        "Kabupaten Polewali Mandar": ["Polewali", "Binuang", "Campalagian", "Wonomulyo", "Mapilli"],
        "Kabupaten Mamasa": ["Mamasa", "Pana", "Tabulahan", "Messawa"]
    },
    "Sulawesi Tenggara": {
        "Kota Kendari": ["Kendari", "Kendari Barat", "Kadia", "Wua-Wua", "Poasia", "Baruga", "Puuwatu", "Kambu"],
        "Kota Bau-Bau": ["Murhum", "Batupoaro", "Kokalukuna", "Wolio", "Sorawolio"],
        "Kabupaten Konawe": ["Unaaha", "Pondidaha", "Wawotobi", "Sampara", "Uepai"],
        "Kabupaten Kolaka": ["Kolaka", "Wundulako", "Pomalaa", "Watubangga", "Toari"],
        "Kabupaten Muna": ["Raha", "Katobu", "Lawa", "Parigi", "Kontunaga"]
    },
    "Maluku": {
        "Kota Ambon": ["Nusaniwe", "Sirimau", "Baguala", "Teluk Ambon", "Leitimur Selatan"],
        "Kota Tual": ["Dullah Selatan", "Dullah Utara", "Tayando Tam", "Pulau Dullah"],
        "Kabupaten Maluku Tengah": ["Masohi", "Amahai", "Tehoru", "Teluk Elpaputih", "Saparua"],
        "Kabupaten Buru": ["Namlea", "Air Buaya", "Waplau", "Batabual", "Lolong Guba"],
        "Kabupaten Seram Bagian Barat": ["Piru", "Kairatu", "Taniwel", "Huamual"]
    },
    "Maluku Utara": {
        "Kota Ternate": ["Ternate Selatan", "Ternate Tengah", "Ternate Utara", "Ternate Barat", "Pulau Ternate"],
        "Kota Tidore Kepulauan": ["Tidore", "Tidore Selatan", "Tidore Utara", "Tidore Timur", "Oba"],
        "Kabupaten Halmahera Barat": ["Jailolo", "Sahu", "Jailolo Selatan", "Ibu", "Sahu Timur"],
        "Kabupaten Halmahera Tengah": ["Weda", "Patani", "Pulau Gebe", "Gane Barat"],
        "Kabupaten Halmahera Timur": ["Maba", "Wasile", "Maba Selatan", "Wasile Timur"]
    },
    "Papua": {
        "Kota Jayapura": ["Jayapura Selatan", "Jayapura Utara", "Abepura", "Muara Tami", "Heram"],
        "Kabupaten Jayapura": ["Sentani", "Sentani Timur", "Sentani Barat", "Depapre", "Kaureh"],
        "Kabupaten Jayawijaya": ["Wamena", "Asologaima", "Hubikosi", "Walelagama", "Wouma"],
        "Kabupaten Merauke": ["Merauke", "Semangga", "Tanah Miring", "Jagebob", "Kurik"],
        "Kabupaten Biak Numfor": ["Biak Kota", "Biak Utara", "Numfor Barat", "Samofa", "Yendidori"]
    },
    "Papua Barat": {
        "Kota Sorong": ["Sorong", "Sorong Timur", "Sorong Barat", "Sorong Kepulauan", "Sorong Utara"],
        "Kabupaten Sorong": ["Aimas", "Klasaman", "Makbon", "Beraur", "Salawati Utara"],
        "Kabupaten Manokwari": ["Manokwari Barat", "Manokwari Timur", "Manokwari Utara", "Warmare", "Prafi"],
        "Kabupaten Fakfak": ["Fakfak", "Karas", "Bomberay", "Fakfak Tengah", "Kokas"],
        "Kabupaten Raja Ampat": ["Waigeo Selatan", "Waigeo Barat", "Waigeo Utara", "Misool", "Salawati"]
    },
    "Papua Tengah": {
        "Kabupaten Nabire": ["Nabire", "Napan", "Yaur", "Uwapa", "Makimi"],
        "Kabupaten Paniai": ["Enarotali", "Aradide", "Bogabaida", "Dumadama", "Muye"],
        "Kabupaten Dogiyai": ["Kigamani", "Sukikai Selatan", "Mapia", "Piyaiye"],
        "Kabupaten Deiyai": ["Tigi", "Bowobado", "Kapiraya", "Tigi Timur"]
    },
    "Papua Pegunungan": {
        "Kabupaten Jayawijaya": ["Wamena", "Asologaima", "Hubikosi", "Walelagama", "Wouma"],
        "Kabupaten Lanny Jaya": ["Tiom", "Balingga", "Makki", "Pisugi", "Niname"],
        "Kabupaten Tolikara": ["Karubaga", "Tagineri", "Numba", "Wunim", "Air Garam"],
        "Kabupaten Yalimo": ["Elelim", "Apalapsili", "Abenaho", "Benawa", "Welarek"]
    },
    "Papua Selatan": {
        "Kabupaten Merauke": ["Merauke", "Semangga", "Tanah Miring", "Jagebob", "Kurik"],
        "Kabupaten Asmat": ["Agats", "Atsj", "Fayit", "Sawa Erma", "Unir Sirau"],
        "Kabupaten Mappi": ["Kepi", "Obaa", "Edera", "Passue", "Haju"],
        "Kabupaten Boven Digoel": ["Tanah Merah", "Mindiptana", "Waropko", "Jair", "Kouh"]
    },
    "Papua Barat Daya": {
        "Kabupaten Sorong Selatan": ["Teminabuan", "Inanwatan", "Kokoda", "Kais", "Moraid"],
        "Kabupaten Maybrat": ["Kumurkek", "Ayamaru", "Aitinyo", "Aifat", "Mare"],
        "Kabupaten Tambrauw": ["Fef", "Miyah", "Senopi", "Sausapor", "Abun"],
        "Kabupaten Raja Ampat": ["Waigeo Selatan", "Waigeo Barat", "Waigeo Utara", "Misool", "Salawati"]
    }
};

// Inisialisasi Dropdown
const provinsiSelect = document.getElementById('provinsi');
const kotaSelect = document.getElementById('kota');
const kecamatanSelect = document.getElementById('kecamatan');
const kelurahanSelect = document.getElementById('kelurahan');

// Simpan nilai old() jika ada error validasi
const oldProvinsi = "{{ old('provinsi') }}";
const oldKota = "{{ old('kota') }}";
const oldKecamatan = "{{ old('kecamatan') }}";
const oldKelurahan = "{{ old('kelurahan') }}";

// Loading state
function setLoading(selectElement, isLoading) {
    if (isLoading) {
        selectElement.innerHTML = '<option value="">Loading...</option>';
        selectElement.disabled = true;
    } else {
        selectElement.disabled = false;
    }
}

// Load Provinsi dari API saat halaman load
async function loadProvinsi() {
    if (dataCache.provinces) {
        populateProvinsiDropdown(dataCache.provinces);
        return;
    }
    
    try {
        const provinces = await fetchWilayahData(`${API_BASE}/provinces.json`);
        dataCache.provinces = provinces;
        populateProvinsiDropdown(provinces);
    } catch (error) {
        console.error('Gagal load provinsi, menggunakan fallback data');
        // Fallback ke data hardcoded
        const provinsiList = Object.keys(wilayahData);
        provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
        provinsiList.forEach(prov => {
            const option = document.createElement('option');
            option.value = prov;
            option.textContent = prov;
            provinsiSelect.appendChild(option);
        });
    }
}

function populateProvinsiDropdown(provinces) {
    provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
    provinces.forEach(prov => {
        const option = document.createElement('option');
        option.value = prov.name; // Simpan nama untuk submit form
        option.textContent = prov.name;
        option.dataset.id = prov.id; // Simpan ID untuk fetch data berikutnya
        provinsiSelect.appendChild(option);
    });
}

// Event listener untuk Provinsi
provinsiSelect.addEventListener('change', async function() {
    const selectedProvinsiId = this.options[this.selectedIndex]?.dataset?.id;
    const selectedProvinsiName = this.value;
    
    // Reset dropdown
    kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
    kecamatanSelect.innerHTML = '<option value="">Pilih kecamatan</option>';
    kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
    
    if (!selectedProvinsiId) return;
    
    // Cek cache
    if (dataCache.regencies[selectedProvinsiId]) {
        populateKotaDropdown(dataCache.regencies[selectedProvinsiId]);
        return;
    }
    
    // Load dari API
    setLoading(kotaSelect, true);
    try {
        const regencies = await fetchWilayahData(`${API_BASE}/regencies/${selectedProvinsiId}.json`);
        dataCache.regencies[selectedProvinsiId] = regencies;
        populateKotaDropdown(regencies);
    } catch (error) {
        console.error('Gagal load kota, menggunakan fallback');
        // Fallback ke hardcoded data
        if (wilayahData[selectedProvinsiName]) {
            const kotaList = Object.keys(wilayahData[selectedProvinsiName]);
            kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
            kotaList.forEach(kota => {
                const option = document.createElement('option');
                option.value = kota;
                option.textContent = kota;
                kotaSelect.appendChild(option);
            });
        }
    } finally {
        setLoading(kotaSelect, false);
    }
});

function populateKotaDropdown(regencies) {
    kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
    regencies.forEach(reg => {
        const option = document.createElement('option');
        option.value = reg.name; // Simpan nama untuk submit form
        option.textContent = reg.name;
        option.dataset.id = reg.id; // Simpan ID untuk fetch data berikutnya
        kotaSelect.appendChild(option);
    });
}

// Event listener untuk Kota
kotaSelect.addEventListener('change', async function() {
    const selectedKotaId = this.options[this.selectedIndex]?.dataset?.id;
    
    // Reset dropdown
    kecamatanSelect.innerHTML = '<option value="">Pilih kecamatan</option>';
    kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
    
    if (!selectedKotaId) return;
    
    // Cek cache
    if (dataCache.districts[selectedKotaId]) {
        populateKecamatanDropdown(dataCache.districts[selectedKotaId]);
        return;
    }
    
    // Load dari API
    setLoading(kecamatanSelect, true);
    try {
        const districts = await fetchWilayahData(`${API_BASE}/districts/${selectedKotaId}.json`);
        dataCache.districts[selectedKotaId] = districts;
        populateKecamatanDropdown(districts);
    } catch (error) {
        console.error('Gagal load kecamatan:', error);
        kecamatanSelect.innerHTML = '<option value="">Data tidak tersedia</option>';
    } finally {
        setLoading(kecamatanSelect, false);
    }
});

function populateKecamatanDropdown(districts) {
    kecamatanSelect.innerHTML = '<option value="">Pilih kecamatan</option>';
    districts.forEach(dist => {
        const option = document.createElement('option');
        option.value = dist.name; // Simpan nama untuk submit form
        option.textContent = dist.name;
        option.dataset.id = dist.id;
        kecamatanSelect.appendChild(option);
    });
}

// Event listener untuk Kecamatan
kecamatanSelect.addEventListener('change', async function() {
    const selectedKecamatanId = this.options[this.selectedIndex]?.dataset?.id;
    
    // Reset dropdown kelurahan
    kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
    
    if (!selectedKecamatanId) return;
    
    // Cek cache
    if (dataCache.villages[selectedKecamatanId]) {
        populateKelurahanDropdown(dataCache.villages[selectedKecamatanId]);
        return;
    }
    
    // Load dari API
    setLoading(kelurahanSelect, true);
    try {
        const villages = await fetchWilayahData(`${API_BASE}/villages/${selectedKecamatanId}.json`);
        dataCache.villages[selectedKecamatanId] = villages;
        populateKelurahanDropdown(villages);
    } catch (error) {
        console.error('Gagal load kelurahan:', error);
        kelurahanSelect.innerHTML = '<option value="">Data tidak tersedia</option>';
    } finally {
        setLoading(kelurahanSelect, false);
    }
});

function populateKelurahanDropdown(villages) {
    kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
    villages.forEach(vill => {
        const option = document.createElement('option');
        option.value = vill.name; // Simpan nama asli untuk submit form
        option.textContent = vill.name;
        kelurahanSelect.appendChild(option);
    });
}

// Load provinsi saat halaman dimuat
window.addEventListener('DOMContentLoaded', async function() {
    await loadProvinsi();
    
    // Restore nilai old() setelah provinsi ter-load (jika ada error validasi)
    if (oldProvinsi) {
        provinsiSelect.value = oldProvinsi;
        await provinsiSelect.dispatchEvent(new Event('change'));
        
        // Tunggu sebentar agar kota ter-populate
        setTimeout(async () => {
            if (oldKota) {
                kotaSelect.value = oldKota;
                await kotaSelect.dispatchEvent(new Event('change'));
                
                // Tunggu sebentar agar kecamatan ter-populate
                setTimeout(async () => {
                    if (oldKecamatan) {
                        kecamatanSelect.value = oldKecamatan;
                        await kecamatanSelect.dispatchEvent(new Event('change'));
                        
                        // Tunggu sebentar agar kelurahan ter-populate
                        setTimeout(() => {
                            if (oldKelurahan) {
                                kelurahanSelect.value = oldKelurahan;
                            }
                        }, 500);
                    }
                }, 500);
            }
        }, 500);
    }
});
</script>

</body>
</html>
