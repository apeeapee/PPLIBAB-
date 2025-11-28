@php($title = 'Dashboard Admin | kampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="kampuStore" class="h-10 w-10">
                        <span class="text-2xl font-bold gradient-text">kampuStore</span>
                    </a>
                    
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="border-purple-600 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-estate mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('admin.sellers.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-store mr-2"></i>Pengajuan Toko
                        </a>
                        <div class="relative" x-data="{ openReports: false }">
                            <button @click="openReports = !openReports" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="uil uil-chart-line mr-2"></i>Laporan
                                <i class="uil uil-angle-down ml-1"></i>
                            </button>
                            <div x-show="openReports" @click.away="openReports = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute left-0 mt-2 w-64 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                 style="display: none;">
                                <div class="py-2">
                                    <a href="{{ route('admin.reports.sellers') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">
                                        <i class="uil uil-users-alt mr-2"></i>Daftar Akun Penjual
                                    </a>
                                    <a href="{{ route('admin.reports.sellers-location') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">
                                        <i class="uil uil-map-marker mr-2"></i>Penjual per Lokasi
                                    </a>
                                    <a href="{{ route('admin.reports.product-ranking') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">
                                        <i class="uil uil-trophy mr-2"></i>Peringkat Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                             style="display: none;">
                            <div class="p-4 border-b border-gray-100">
                                <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-gray-500">Admin</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="uil uil-estate mr-2"></i>Dashboard
                                </a>
                                <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="uil uil-shopping-bag mr-2"></i>Market
                                </a>
                            </div>
                            <div class="border-t border-gray-100 p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded">
                                        <i class="uil uil-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-8 fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            Dashboard Admin
                        </h1>
                        <p class="text-gray-600">
                            Kelola pengajuan toko dan pantau aktivitas marketplace
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ now()->format('d F Y') }}</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $total }}</p>
                        <p class="text-xs text-gray-500">Total Pengajuan</p>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 fade-in">
                
                {{-- Pending Card --}}
                <div class="card-hover bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="uil uil-clock text-yellow-600 text-2xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                            {{ $pPct }}%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Pending</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $pending }}</p>
                    <p class="text-xs text-gray-500 mt-2">Menunggu verifikasi</p>
                </div>

                {{-- Approved Card --}}
                <div class="card-hover bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="uil uil-check-circle text-green-600 text-2xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            {{ $aPct }}%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Disetujui</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $approved }}</p>
                    <p class="text-xs text-gray-500 mt-2">Toko aktif</p>
                </div>

                {{-- Rejected Card --}}
                <div class="card-hover bg-white rounded-2xl shadow-md p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="uil uil-times-circle text-red-600 text-2xl"></i>
                        </div>
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                            {{ $rPct }}%
                        </span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Ditolak</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $rejected }}</p>
                    <p class="text-xs text-gray-500 mt-2">Pengajuan ditolak</p>
                </div>

            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 fade-in">
                
                {{-- Chart 1: Bar Chart --}}
                <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Statistik Pengajuan</h3>
                        <p class="text-sm text-gray-500">Distribusi status pengajuan toko</p>
                    </div>
                    
                    <div class="flex items-end justify-around h-64 border-b border-l border-gray-200">
                        {{-- Pending Bar --}}
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg relative" 
                                 style="height: {{ max(20, $pPct) }}%;">
                                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    {{ $pending }}
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2 font-medium">Pending</p>
                        </div>
                        
                        {{-- Approved Bar --}}
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-full bg-gradient-to-t from-green-500 to-green-400 rounded-t-lg relative" 
                                 style="height: {{ max(20, $aPct) }}%;">
                                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    {{ $approved }}
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2 font-medium">Approved</p>
                        </div>
                        
                        {{-- Rejected Bar --}}
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-full bg-gradient-to-t from-red-500 to-red-400 rounded-t-lg relative" 
                                 style="height: {{ max(20, $rPct) }}%;">
                                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    {{ $rejected }}
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-2 font-medium">Rejected</p>
                        </div>
                    </div>
                </div>

                {{-- Chart 2: Summary --}}
                <div class="bg-white rounded-2xl shadow-md p-6 card-hover">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Ringkasan Status</h3>
                        <p class="text-sm text-gray-500">Detail persentase setiap status</p>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- Pending --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                    <span class="text-sm font-medium text-gray-700">Pending</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ $pending }} ({{ $pPct }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-2 rounded-full" style="width: {{ $pPct }}%"></div>
                            </div>
                        </div>
                        
                        {{-- Approved --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm font-medium text-gray-700">Disetujui</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ $approved }} ({{ $aPct }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-400 to-green-500 h-2 rounded-full" style="width: {{ $aPct }}%"></div>
                            </div>
                        </div>
                        
                        {{-- Rejected --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                                    <span class="text-sm font-medium text-gray-700">Ditolak</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ $rejected }} ({{ $rPct }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-red-400 to-red-500 h-2 rounded-full" style="width: {{ $rPct }}%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Total Pengajuan</span>
                            <span class="text-2xl font-bold text-purple-600">{{ $total }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Quick Actions --}}
            <div class="mt-8 bg-white rounded-2xl shadow-md p-6 fade-in">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.sellers.index') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition-all">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="uil uil-folder-open text-purple-600 text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Lihat Semua Pengajuan</p>
                            <p class="text-xs text-gray-500">Kelola pengajuan toko</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-indigo-500 hover:bg-indigo-50 transition-all">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="uil uil-shopping-cart text-indigo-600 text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Ke Market</p>
                            <p class="text-xs text-gray-500">Lihat produk marketplace</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('home') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-orange-500 hover:bg-orange-50 transition-all">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="uil uil-home text-orange-600 text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Beranda</p>
                            <p class="text-xs text-gray-500">Kembali ke homepage</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </main>

    {{-- Alpine.js for dropdown --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success') || session('error'))
        <script>
            @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#7c3aed',
                confirmButtonText: 'OK'
            });
            @endif

            @if(session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK'
            });
            @endif
        </script>
    @endif

</body>
</html>
