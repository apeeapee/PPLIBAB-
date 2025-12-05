<aside class="w-64 bg-white border-r border-gray-200 min-h-screen pt-16">
    <div class="p-6 space-y-8">
        <!-- Admin Profile -->
        <div class="text-center">
            <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="uil uil-user text-orange-600 text-2xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
            <div class="inline-flex items-center space-x-1 px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-medium mt-2">
                <i class="uil uil-shield-check text-xs"></i>
                <span>Administrator</span>
            </div>
            <p class="text-sm text-gray-500 mt-2">{{ auth()->user()->email }}</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-6">
            <!-- Dashboard -->
            <div>
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Dashboard</h4>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 bg-orange-50 text-orange-600 rounded-lg font-medium">
                        <i class="uil uil-dashboard text-lg"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Store Management -->
            <div>
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Manajemen Toko</h4>
                <div class="space-y-1">
                    <a href="{{ route('admin.sellers.index') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="uil uil-folder text-lg"></i>
                        <span>Pengajuan Toko</span>
                    </a>
                    <a href="{{ route('admin.reports.sellers') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="uil uil-file-alt text-lg"></i>
                        <span>Laporan Toko</span>
                    </a>
                    <a href="{{ route('admin.reports.sellers-location') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="uil uil-map-marker text-lg"></i>
                        <span>Toko per Lokasi</span>
                    </a>
                </div>
            </div>

            <!-- Product Reports -->
            <div>
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Laporan Produk</h4>
                <div class="space-y-1">
                    <a href="{{ route('admin.reports.product-ranking') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="uil uil-star text-lg"></i>
                        <span>Rating Produk</span>
                    </a>
                    <a href="{{ route('admin.reports.sellers-location') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="uil uil-map-pin text-lg"></i>
                        <span>Lokasi Toko</span>
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <div>
                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Pengaturan</h4>
                <div class="space-y-1">
                    <a href="{{ route('admin.sellers.index') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="uil uil-users text-lg"></i>
                        <span>Verifikasi Penjual</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</aside>