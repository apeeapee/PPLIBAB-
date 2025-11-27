<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan: {{ $seller->nama_toko }} | kampuStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .gradient-text { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.6s ease-out; }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="kampuStore" class="h-10 w-10">
                        <span class="text-2xl font-bold gradient-text">kampuStore</span>
                    </a>
                    
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-estate mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('admin.sellers.index') }}" class="border-purple-600 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-store mr-2"></i>Pengajuan Toko
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700">
                        <i class="uil uil-shopping-cart text-xl"></i>
                    </a>
                    
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
                                <a href="{{ route('admin.sellers.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="uil uil-folder-open mr-2"></i>Pengajuan Toko
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
            
            {{-- Back Button --}}
            <div class="mb-6 fade-in">
                <a href="{{ route('admin.sellers.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
                    <i class="uil uil-arrow-left mr-2"></i>Kembali ke Daftar Pengajuan
                </a>
            </div>

            {{-- Header & Status --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6 fade-in">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $seller->nama_toko }}</h1>
                        <p class="text-gray-600">{{ $seller->deskripsi_singkat }}</p>
                    </div>
                    <div class="text-right">
                        @if($seller->status === 'pending')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="uil uil-clock mr-2"></i>Pending
                            </span>
                        @elseif($seller->status === 'approved')
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="uil uil-check-circle mr-2"></i>Disetujui
                            </span>
                        @else
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="uil uil-times-circle mr-2"></i>Ditolak
                            </span>
                        @endif
                        <p class="text-xs text-gray-500 mt-2">Dibuat: {{ $seller->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Left Column --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Informasi PIC --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 fade-in">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="uil uil-user text-purple-600 mr-2"></i>Informasi PIC (Penanggung Jawab)
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                                <p class="text-gray-900 font-semibold">{{ $seller->nama_pic }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Email</label>
                                <p class="text-gray-900">{{ $seller->email_pic }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">No. Handphone</label>
                                <p class="text-gray-900">{{ $seller->no_hp_pic }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">No. KTP</label>
                                <p class="text-gray-900">{{ $seller->no_ktp_pic }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 fade-in">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="uil uil-map-marker text-purple-600 mr-2"></i>Alamat Lengkap
                        </h2>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Jalan</label>
                                <p class="text-gray-900">{{ $seller->alamat_pic }}</p>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">RT</label>
                                    <p class="text-gray-900">{{ $seller->rt }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">RW</label>
                                    <p class="text-gray-900">{{ $seller->rw }}</p>
                                </div>
                                <div class="col-span-2">
                                    <label class="text-sm font-medium text-gray-500">Kelurahan</label>
                                    <p class="text-gray-900">{{ $seller->kelurahan }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Kota/Kabupaten</label>
                                    <p class="text-gray-900">{{ $seller->kota }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Provinsi</label>
                                    <p class="text-gray-900">{{ $seller->provinsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Right Column --}}
                <div class="space-y-6">
                    
                    {{-- Foto PIC --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 fade-in">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="uil uil-camera text-purple-600 mr-2"></i>Foto PIC
                        </h3>
                        <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden border-2 border-gray-200">
                            <img src="{{ asset('storage/' . $seller->foto_pic) }}" 
                                 alt="Foto PIC" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    {{-- File KTP --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 fade-in">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="uil uil-file text-purple-600 mr-2"></i>File KTP
                        </h3>
                        <a href="{{ asset('storage/' . $seller->file_ktp_pic) }}" 
                           target="_blank"
                           class="block w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-center py-3 rounded-lg font-semibold transition-all">
                            <i class="uil uil-download-alt mr-2"></i>Unduh File KTP
                        </a>
                        <p class="text-xs text-gray-500 text-center mt-2">Klik untuk membuka/download</p>
                    </div>

                    {{-- Action Buttons --}}
                    @if($seller->status === 'pending')
                    <div class="bg-white rounded-2xl shadow-md p-6 fade-in">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Verifikasi</h3>
                        
                        <form action="{{ route('admin.sellers.approve', $seller) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" 
                                    onclick="return confirm('Setujui pengajuan toko ini?')"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition-colors flex items-center justify-center">
                                <i class="uil uil-check mr-2"></i>Setujui Toko
                            </button>
                        </form>

                        <form action="{{ route('admin.sellers.reject', $seller) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    onclick="return confirm('Tolak pengajuan toko ini?')"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition-colors flex items-center justify-center">
                                <i class="uil uil-times mr-2"></i>Tolak Toko
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="bg-white rounded-2xl shadow-md p-6 fade-in">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Status Verifikasi</h3>
                        <p class="text-gray-600 text-sm">
                            Pengajuan ini sudah diverifikasi.
                        </p>
                        @if($seller->rejection_reason)
                        <div class="mt-4 p-4 bg-red-50 border-l-4 border-red-400 rounded">
                            <p class="text-sm font-semibold text-red-800 mb-1">Alasan Penolakan:</p>
                            <p class="text-sm text-red-700">{{ $seller->rejection_reason }}</p>
                        </div>
                        @endif
                    </div>
                    @endif

                </div>

            </div>

        </div>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
