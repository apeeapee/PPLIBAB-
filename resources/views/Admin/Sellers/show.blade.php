@extends('layouts.admin')

@section('content')
    <!-- Back Link -->
    <div class="mb-6">
        <a href="{{ route('admin.sellers.index') }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 flex items-center gap-2 text-sm font-medium transition-colors">
            <i class="uil uil-arrow-left"></i> Kembali ke Daftar Pengajuan
        </a>
    </div>

    <!-- Header Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $seller->nama_toko }}</h1>
                <p class="text-gray-600 dark:text-gray-400">{{ $seller->deskripsi_singkat ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="text-right">
                @if($seller->status === 'pending')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-800">
                        <i class="uil uil-clock"></i> Pending
                    </span>
                @elseif($seller->status === 'approved')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-800">
                        <i class="uil uil-check-circle"></i> Disetujui
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-800">
                        <i class="uil uil-times-circle"></i> Ditolak
                    </span>
                @endif
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Dibuat: {{ $seller->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- PIC Information -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center gap-2 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <i class="uil uil-user text-orange-600 dark:text-orange-400"></i> Informasi PIC
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->nama_pic }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white break-all">{{ $seller->email_pic }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">No. Handphone</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->no_hp_pic }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">No. KTP</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->no_ktp_pic }}</p>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center gap-2 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <i class="uil uil-map-marker text-orange-600 dark:text-orange-400"></i> Alamat Lengkap
                </h2>
                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Jalan</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->alamat_pic ?? '-' }}</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">RT</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->rt ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">RW</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->rw ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kelurahan</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->kelurahan ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kecamatan</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->kecamatan ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kota/Kabupaten</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->kota ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Provinsi</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $seller->provinsi ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Photo PIC -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <i class="uil uil-camera text-orange-600 dark:text-orange-400"></i> Foto PIC
                </h2>
                <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    @if($fotoPicUrl)
                        <img src="{{ $fotoPicUrl }}" alt="Foto PIC" class="w-full h-full object-cover"
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik04MCAxMDBMMTIwIDYwTDE2MCAxMDBMMTQwIDE0MEg4MFoiIHN0cm9rZT0iIzlDQTNBIiBzdHJva2Utd2lkdGg9IjIiLz4KPGNpcmNsZSBjeD0iMTQwIiBjeT0iMTAwIiByPSIxMCIgZmlsbD0iIzlDQTNBIi8+Cjx0ZXh0IHg9IjEwMCIgeT0iMTQwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjNkI3MjgwIiBmb250LXNpemU9IjE0Ij5Gb3RvIFRpZGFrIFRlcnNlZGlhPC90ZXh0Pjwvc3ZnPg=='">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <i class="uil uil-image text-5xl mb-2"></i>
                            <p class="text-sm font-medium">Tidak ada foto</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- File KTP -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <i class="uil uil-file text-orange-600 dark:text-orange-400"></i> File KTP
                </h2>
                @if($fileKtpUrl)
                    <a href="{{ $fileKtpUrl }}" target="_blank" class="inline-flex items-center justify-center gap-2 w-full px-4 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md mb-2">
                        <i class="uil uil-download-alt text-lg"></i> Unduh File KTP
                    </a>
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">Klik untuk membuka/download</p>
                @else
                    <div class="text-center py-4">
                        <i class="uil uil-file-slash text-4xl text-gray-300 dark:text-gray-600 mb-2"></i>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada file KTP</p>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            @if($seller->status === 'pending')
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">Aksi Verifikasi</h3>
                    <form action="{{ route('admin.sellers.approve', $seller) }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center gap-2 w-full px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                                onclick="return confirm('Setujui pengajuan toko ini?')">
                            <i class="uil uil-check text-lg"></i> Setujui Toko
                        </button>
                    </form>
                    <button type="button" onclick="openRejectModal()" class="inline-flex items-center justify-center gap-2 w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        <i class="uil uil-times text-lg"></i> Tolak Toko
                    </button>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">Status Verifikasi</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">Pengajuan ini sudah diverifikasi.</p>
                    @if($seller->rejection_reason)
                        <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-600 p-4 rounded-r-lg">
                            <p class="text-sm font-semibold text-red-800 dark:text-red-300 mb-2">Alasan Penolakan:</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $seller->rejection_reason }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Penolakan -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6 transform transition-all">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tolak Pengajuan Toko</h3>
                <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i class="uil uil-times text-2xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.sellers.reject', $seller) }}" method="POST" id="rejectForm">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="rejection_reason" 
                        id="rejection_reason" 
                        rows="4" 
                        required
                        maxlength="1000"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none"
                        placeholder="Jelaskan alasan penolakan pengajuan toko ini..."
                    ></textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 1000 karakter</p>
                </div>

                <div class="flex gap-3">
                    <button 
                        type="button" 
                        onclick="closeRejectModal()"
                        class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md"
                    >
                        Tolak Toko
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejection_reason').focus();
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejection_reason').value = '';
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRejectModal();
            }
        });
    </script>
@endsection