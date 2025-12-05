@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">Peringkat Produk</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Produk dengan rating tertinggi</p>
            </div>
            <div class="text-center sm:text-right bg-gradient-to-br from-orange-500 to-orange-600 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $products->count() }}</div>
                <div class="text-xs sm:text-sm opacity-90">Produk Teratas</div>
            </div>
        </div>
    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-200 dark:border-gray-700 mb-6 sm:mb-8">
        <form method="GET" action="{{ route('admin.reports.product-ranking') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Produk</label>
                    <div class="relative">
                        <i class="uil uil-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full px-4 py-2 pl-10 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Cari nama produk atau toko...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('-', ' ', $cat)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Limit</label>
                    <select name="limit" class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="10" {{ request('limit', 50) == 10 ? 'selected' : '' }}>Top 10</option>
                        <option value="25" {{ request('limit', 50) == 25 ? 'selected' : '' }}>Top 25</option>
                        <option value="50" {{ request('limit', 50) == 50 ? 'selected' : '' }}>Top 50</option>
                        <option value="100" {{ request('limit', 50) == 100 ? 'selected' : '' }}>Top 100</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Urutan</label>
                    <select name="sort" class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="rating_desc" {{ request('sort', 'rating_desc') == 'rating_desc' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating Terendah</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2 flex-wrap mt-4">
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-md font-medium flex items-center gap-2">
                    <i class="uil uil-filter"></i> Filter
                </button>
                <a href="{{ route('admin.reports.product-ranking') }}" class="px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all shadow-md font-medium flex items-center gap-2">
                    <i class="uil uil-redo"></i> Reset
                </a>
                <a href="{{ route('admin.reports.product-ranking.export-excel', request()->all()) }}" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-md font-medium flex items-center gap-2">
                    <i class="uil uil-file-download-alt"></i> Excel
                </a>
                <a href="{{ route('admin.reports.product-ranking.export-pdf', request()->all()) }}" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-md font-medium flex items-center gap-2">
                    <i class="uil uil-file-pdf-alt"></i> PDF
                </a>
            </div>
        </form>
    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Products Table - SRS-11: Format: No | Produk | Kategori | Harga | Rating | Nama Toko | Propinsi -->
    <!-- Propinsi diisi propinsi pemberi rating -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Laporan Daftar Produk Berdasarkan Rating</h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Tanggal dibuat: {{ now()->format('d-m-Y') }} oleh {{ auth()->user()->name ?? 'Admin' }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Propinsi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($products as $index => $product)
                    @php
                        // SRS-11: Propinsi diisi propinsi pemberi rating (reviewer)
                        $reviewerProvince = \App\Models\Review::where('product_id', $product->id)
                            ->whereNotNull('guest_province')
                            ->orderBy('created_at', 'desc')
                            ->value('guest_province') ?? '-';
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                        <td class="px-6 py-4 text-right text-sm text-gray-900 dark:text-gray-200">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($product->avg_rating > 0)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                    <i class="uil uil-star text-yellow-500"></i>
                                    {{ number_format($product->avg_rating, 1) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $product->nama_toko ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $reviewerProvince }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-center">
                                <i class="uil uil-box text-4xl sm:text-5xl text-gray-400 dark:text-gray-600 mb-3"></i>
                                <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400">Tidak ada data produk</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Keterangan -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-700">
        <p class="text-sm text-blue-700 dark:text-blue-300"><strong>Keterangan:</strong></p>
        <p class="text-sm text-blue-700 dark:text-blue-300">***) Propinsi diisikan propinsi pemberi rating</p>
        <p class="text-sm text-blue-700 dark:text-blue-300">***) Diurutkan berdasarkan rating secara menurun (descending)</p>
    </div>
@endsection