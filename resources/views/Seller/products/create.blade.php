<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - {{ $seller->nama_toko }} | KampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">

{{-- NAVBAR --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/90 backdrop-blur-xl border-b border-blue-500/30 shadow-lg">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                KampuStore
            </a>
            <div class="flex items-center gap-3 sm:gap-6">
                <a href="{{ route('seller.dashboard') }}" class="text-xs sm:text-sm text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-1">
                    <i class="uil uil-dashboard"></i>
                    <span class="hidden sm:inline">Dashboard</span>
                </a>
                <a href="{{ route('seller.products.index') }}" class="text-xs sm:text-sm text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-1">
                    <i class="uil uil-box"></i>
                    <span class="hidden sm:inline">Produk Saya</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs sm:text-sm text-red-400 hover:text-red-300 transition-colors duration-200 flex items-center gap-1">
                        <i class="uil uil-sign-out-alt"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="pt-24 pb-12 px-4">
    <div class="container mx-auto max-w-4xl">
        
        {{-- HEADER --}}
        <div class="mb-6 fade-in-up">
            <a href="{{ route('seller.products.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 transition-colors duration-200 mb-4">
                <i class="uil uil-arrow-left"></i>
                <span class="text-sm">Kembali ke Daftar Produk</span>
            </a>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2">Tambah Produk Baru</h1>
            <p class="text-gray-400 text-sm sm:text-base">Isi formulir di bawah untuk menambahkan produk ke toko {{ $seller->nama_toko }}</p>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-blue-500/30 p-6 sm:p-8 fade-in-up">
            
            @if($errors->any())
            <div class="bg-gradient-to-r from-red-500/10 to-pink-500/10 border border-red-500/40 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <i class="uil uil-exclamation-triangle text-2xl text-red-400"></i>
                    <div>
                        <h3 class="text-base font-semibold text-red-400 mb-2">Ada beberapa kesalahan:</h3>
                        <ul class="list-disc list-inside text-sm text-gray-300 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Nama Produk <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Contoh: Buku Matematika Dasar"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category_slug" class="block text-sm font-medium text-gray-300 mb-2">
                        Kategori <span class="text-red-400">*</span>
                    </label>
                    <select 
                        id="category_slug" 
                        name="category_slug" 
                        required
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['slug'] }}" {{ old('category_slug') == $category['slug'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_slug')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kondisi dan Size dalam satu baris --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Kondisi --}}
                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-300 mb-2">
                            Kondisi <span class="text-red-400">*</span>
                        </label>
                        <select 
                            id="condition" 
                            name="condition" 
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                            <option value="">Pilih Kondisi</option>
                            <option value="baru" {{ old('condition') == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="bekas" {{ old('condition') == 'bekas' ? 'selected' : '' }}>Bekas</option>
                        </select>
                        @error('condition')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Size (Optional) --}}
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-300 mb-2">
                            Ukuran (Opsional)
                        </label>
                        <input 
                            type="text" 
                            id="size" 
                            name="size" 
                            value="{{ old('size') }}"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Contoh: L, XL, atau 42"
                        >
                        @error('size')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Harga dan Stok dalam satu baris --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Harga --}}
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">
                            Harga (Rp) <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="price" 
                            name="price" 
                            value="{{ old('price') }}"
                            required
                            min="0"
                            step="1000"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="50000"
                        >
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-300 mb-2">
                            Stok <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="stock" 
                            name="stock" 
                            value="{{ old('stock') }}"
                            required
                            min="0"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="10"
                        >
                        @error('stock')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                        Deskripsi Produk <span class="text-red-400">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required
                        rows="5"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                        placeholder="Jelaskan detail produk, kondisi, dan informasi penting lainnya..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Gambar --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                        Foto Produk <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            id="image" 
                            name="image" 
                            required
                            accept=".jpg,.jpeg,.png"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 file:cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Preview Image --}}
                <div id="imagePreview" class="hidden">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Preview</label>
                    <img id="previewImg" src="" alt="Preview" class="w-48 h-48 object-cover rounded-lg border-2 border-slate-700">
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <i class="uil uil-check"></i>
                        <span>Tambah Produk</span>
                    </button>
                    <a 
                        href="{{ route('seller.products.index') }}"
                        class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <i class="uil uil-times"></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>

    </div>
</main>

{{-- FOOTER --}}
<footer class="bg-slate-900/80 border-t border-slate-800 py-6 mt-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-gray-400 text-sm text-center sm:text-left">
                © 2025 <span class="font-semibold text-blue-400">KampuStore</span>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>
