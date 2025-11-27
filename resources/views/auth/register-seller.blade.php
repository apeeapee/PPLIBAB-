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
                <p class="text-gray-600 mb-5 text-lg">Lengkapi data toko dan informasi PIC untuk verifikasi</p>
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-2xl p-5 text-sm text-gray-700 max-w-2xl mx-auto">
                    <div class="flex items-start gap-3">
                        <i class="uil uil-info-circle text-2xl text-purple-600 mt-0.5"></i>
                        <div class="text-left">
                            <strong class="text-purple-700 block mb-1">Info untuk Pembeli:</strong>
                            <span>Kamu tidak perlu mendaftar atau login untuk berbelanja. 
                            Langsung kunjungi <a href="{{ route('products.index') }}" class="text-purple-600 underline hover:text-purple-700 font-semibold">halaman market</a> untuk mulai belanja!</span>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- SECTION 1: AKUN LOGIN --}}
                <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 border-2 border-purple-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-purple-600 text-white rounded-full font-bold">1</div>
                        <h2 class="text-xl font-bold text-gray-900">Data Akun Login</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="Masukkan nama lengkap">
                            @error('name')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="nama@example.com">
                            @error('email')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Password</label>
                            <input type="password" name="password" required class="input-field" placeholder="Min. 8 karakter">
                            @error('password')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required class="input-field" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: DATA TOKO --}}
                <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-6 border-2 border-indigo-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-indigo-600 text-white rounded-full font-bold">2</div>
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

                {{-- SECTION 3: DATA PIC --}}
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border-2 border-blue-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-bold">3</div>
                        <h2 class="text-xl font-bold text-gray-900">Data Penanggung Jawab (PIC)</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Nama PIC *</label>
                            <input type="text" name="nama_pic" value="{{ old('nama_pic') }}" required class="input-field" placeholder="Nama penanggung jawab">
                            @error('nama_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">No. Handphone PIC * <span class="text-xs text-gray-500">(format: 08xxx)</span></label>
                            <input type="text" name="no_hp_pic" value="{{ old('no_hp_pic') }}" required pattern="(\\+62|62|0)[0-9]{9,12}" class="input-field" placeholder="081234567890">
                            <p class="text-xs text-gray-500 mt-1">Contoh: 081234567890 atau +6281234567890</p>
                            @error('no_hp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Email PIC *</label>
                            <input type="email" name="email_pic" value="{{ old('email_pic') }}" required class="input-field" placeholder="pic@example.com">
                            @error('email_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">No. KTP PIC * <span class="text-xs text-gray-500">(16 digit)</span></label>
                            <input type="text" name="no_ktp_pic" value="{{ old('no_ktp_pic') }}" required maxlength="16" pattern="[0-9]{16}" class="input-field" placeholder="3374010101010001">
                            <p class="text-xs text-gray-500 mt-1">Harus 16 digit angka</p>
                            @error('no_ktp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: ALAMAT PIC --}}
                <div class="bg-gradient-to-br from-teal-50 to-white rounded-2xl p-6 border-2 border-teal-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-teal-600 text-white rounded-full font-bold">4</div>
                        <h2 class="text-xl font-bold text-gray-900">Alamat PIC</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="label">Alamat (Nama Jalan) *</label>
                            <input type="text" name="alamat_pic" value="{{ old('alamat_pic') }}" required class="input-field" placeholder="Jl. Contoh No. 123">
                            @error('alamat_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
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
                                <label class="label">Kelurahan/Desa *</label>
                                <select name="kelurahan" id="kelurahan" required class="input-field">
                                    <option value="">Pilih kelurahan/desa</option>
                                </select>
                                @error('kelurahan')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label">Kota/Kabupaten *</label>
                                <select name="kota" id="kota" required class="input-field">
                                    <option value="">Pilih kota/kabupaten</option>
                                </select>
                                @error('kota')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
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
                        </div>
                    </div>
                </div>

                {{-- SECTION 5: DOKUMEN --}}
                <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-6 border-2 border-orange-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-orange-600 text-white rounded-full font-bold">5</div>
                        <h2 class="text-xl font-bold text-gray-900">Dokumen Verifikasi</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Foto PIC *</label>
                            <input type="file" name="foto_pic" required accept="image/jpeg,image/jpg,image/png" 
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-900 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, JPEG, PNG (Max. 2MB)</p>
                            @error('foto_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">File KTP PIC *</label>
                            <input type="file" name="file_ktp_pic" required accept="application/pdf,image/jpeg,image/jpg,image/png"
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-900 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-500 mt-2">Format: PDF, JPG, JPEG, PNG (Max. 4MB)</p>
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
// Data Wilayah Indonesia (Cascading)
const wilayahData = {
    "DKI Jakarta": {
        "Jakarta Pusat": ["Menteng", "Tanah Abang", "Gambir", "Kemayoran", "Sawah Besar", "Cempaka Putih", "Johar Baru", "Senen"],
        "Jakarta Utara": ["Koja", "Kelapa Gading", "Tanjung Priok", "Pademangan", "Penjaringan", "Cilincing"],
        "Jakarta Barat": ["Kebon Jeruk", "Tambora", "Taman Sari", "Grogol Petamburan", "Cengkareng", "Kalideres", "Palmerah", "Kembangan"],
        "Jakarta Selatan": ["Kebayoran Baru", "Kebayoran Lama", "Cilandak", "Jagakarsa", "Mampang Prapatan", "Pancoran", "Pasar Minggu", "Pesanggrahan", "Setiabudi", "Tebet"],
        "Jakarta Timur": ["Matraman", "Pulo Gadung", "Jatinegara", "Kramat Jati", "Pasar Rebo", "Cakung", "Cipayung", "Ciracas", "Duren Sawit", "Makasar"],
        "Kepulauan Seribu": ["Pulau Tidung", "Pulau Pramuka", "Pulau Harapan", "Pulau Untung Jawa"]
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
        "Kota Semarang": ["Semarang Tengah", "Semarang Utara", "Semarang Timur", "Semarang Selatan", "Semarang Barat", "Gayamsari", "Candisari", "Gajahmungkur", "Tembalang", "Banyumanik", "Gunungpati", "Pedurungan", "Genuk", "Tugu", "Ngaliyan", "Mijen"],
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
        "Kota Jambi": ["Telanaipura", "Jambi Selatan", "Kotabaru", "Jelutung", "Pasar Jambi", "Pelayangan", "Danau Teluk", "Jambi Timur"],
        "Kota Sungai Penuh": ["Sungai Penuh", "Pesisir Bukit", "Kumun Debai", "Tanah Kampung"],
        "Kabupaten Batang Hari": ["Muara Bulian", "Maro Sebo", "Mersam", "Bajubang"],
        "Kabupaten Muaro Jambi": ["Sengeti", "Mestong", "Jambi Luar Kota", "Sekernan"],
        "Kabupaten Bungo": ["Muara Bungo", "Pelepat", "Jujuhan", "Tanah Sepenggal"]
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
const kelurahanSelect = document.getElementById('kelurahan');

// Simpan nilai old() jika ada error validasi
const oldProvinsi = "{{ old('provinsi') }}";
const oldKota = "{{ old('kota') }}";
const oldKelurahan = "{{ old('kelurahan') }}";

// Event listener untuk Provinsi
provinsiSelect.addEventListener('change', function() {
    const selectedProvinsi = this.value;
    
    // Reset dropdown kota dan kelurahan
    kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>';
    kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
    
    // Jika provinsi dipilih, populate kota
    if (selectedProvinsi && wilayahData[selectedProvinsi]) {
        const kotaList = Object.keys(wilayahData[selectedProvinsi]);
        kotaList.forEach(kota => {
            const option = document.createElement('option');
            option.value = kota;
            option.textContent = kota;
            kotaSelect.appendChild(option);
        });
    }
});

// Event listener untuk Kota
kotaSelect.addEventListener('change', function() {
    const selectedProvinsi = provinsiSelect.value;
    const selectedKota = this.value;
    
    // Reset dropdown kelurahan
    kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan/desa</option>';
    
    // Jika kota dipilih, populate kelurahan
    if (selectedProvinsi && selectedKota && wilayahData[selectedProvinsi][selectedKota]) {
        const kelurahanList = wilayahData[selectedProvinsi][selectedKota];
        kelurahanList.forEach(kelurahan => {
            const option = document.createElement('option');
            option.value = kelurahan;
            option.textContent = kelurahan;
            kelurahanSelect.appendChild(option);
        });
    }
});

// Restore nilai old() setelah page load (jika ada error validasi)
window.addEventListener('DOMContentLoaded', function() {
    if (oldProvinsi) {
        provinsiSelect.value = oldProvinsi;
        provinsiSelect.dispatchEvent(new Event('change'));
        
        // Tunggu sebentar agar kota ter-populate
        setTimeout(() => {
            if (oldKota) {
                kotaSelect.value = oldKota;
                kotaSelect.dispatchEvent(new Event('change'));
                
                // Tunggu sebentar agar kelurahan ter-populate
                setTimeout(() => {
                    if (oldKelurahan) {
                        kelurahanSelect.value = oldKelurahan;
                    }
                }, 100);
            }
        }, 100);
    }
});
</script>

</body>
</html>
