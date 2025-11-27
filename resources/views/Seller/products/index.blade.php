<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Saya - {{ $seller->nama_toko }} | KampuStore</title>
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
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.3), 0 8px 10px -6px rgb(0 0 0 / 0.3);
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
                <a href="{{ route('products.index') }}" class="text-xs sm:text-sm text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-1">
                    <i class="uil uil-store"></i>
                    <span class="hidden sm:inline">Lihat Market</span>
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
    <div class="container mx-auto max-w-7xl">
        
        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 fade-in-up">
            <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2">Kelola Produk</h1>
                <p class="text-gray-400 text-sm sm:text-base">Semua produk dari toko {{ $seller->nama_toko }}</p>
            </div>
            <a href="{{ route('seller.products.create') }}" class="px-4 sm:px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm sm:text-base">
                <i class="uil uil-plus text-lg"></i>
                <span>Tambah Produk</span>
            </a>
        </div>

        @if(session('success'))
        <div class="bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-500/40 rounded-xl p-4 mb-6 shadow-xl fade-in-up">
            <div class="flex items-center gap-3">
                <i class="uil uil-check-circle text-2xl text-green-400"></i>
                <p class="text-green-300 text-sm">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-gradient-to-r from-red-500/10 to-pink-500/10 border border-red-500/40 rounded-xl p-4 mb-6 shadow-xl fade-in-up">
            <div class="flex items-center gap-3">
                <i class="uil uil-times-circle text-2xl text-red-400"></i>
                <p class="text-red-300 text-sm">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        {{-- PRODUK GRID --}}
        @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($products as $product)
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl overflow-hidden border border-slate-700/50 card-hover fade-in-up">
                {{-- Product Image --}}
                <div class="relative h-48 overflow-hidden bg-slate-900">
                    @if($product->image_url)
                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="uil uil-image text-6xl text-gray-600"></i>
                    </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        @if($product->stock < 10)
                        <span class="px-2.5 py-1 bg-orange-500/90 text-white text-xs font-semibold rounded-full backdrop-blur-sm">
                            Stok Rendah
                        </span>
                        @else
                        <span class="px-2.5 py-1 bg-green-500/90 text-white text-xs font-semibold rounded-full backdrop-blur-sm">
                            Stok Aman
                        </span>
                        @endif
                    </div>
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 bg-blue-500/90 text-white text-xs font-semibold rounded-full backdrop-blur-sm">
                            {{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}
                        </span>
                    </div>
                </div>

                {{-- Product Info --}}
                <div class="p-5">
                    <h3 class="text-lg font-bold text-white mb-2 truncate">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Harga</p>
                            <p class="text-xl font-bold text-blue-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 mb-1">Stok</p>
                            <p class="text-xl font-bold {{ $product->stock < 10 ? 'text-orange-400' : 'text-green-400' }}">
                                {{ $product->stock }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', $product) }}" class="flex-1 px-3 py-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 font-medium rounded-lg transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                            <i class="uil uil-eye"></i>
                            <span>Lihat</span>
                        </a>
                        <a href="{{ route('seller.products.edit', $product) }}" class="flex-1 px-3 py-2 bg-yellow-500/20 hover:bg-yellow-500/30 text-yellow-400 font-medium rounded-lg transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                            <i class="uil uil-edit"></i>
                            <span>Edit</span>
                        </a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 font-medium rounded-lg transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                                <i class="uil uil-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
        <div class="flex justify-center">
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl border border-slate-700/50 p-4">
                {{ $products->links() }}
            </div>
        </div>
        @endif

        @else
        {{-- EMPTY STATE --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-slate-700/50 p-12 text-center fade-in-up">
            <div class="mb-6">
                <i class="uil uil-box text-6xl text-gray-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-3">Belum Ada Produk</h3>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">
                Mulai berjualan dengan menambahkan produk pertama Anda ke toko {{ $seller->nama_toko }}.
            </p>
            <a href="{{ route('seller.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="uil uil-plus text-lg"></i>
                <span>Tambah Produk Pertama</span>
            </a>
        </div>
        @endif

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
