@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">Penjual per Lokasi</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Distribusi toko berdasarkan lokasi provinsi</p>
            </div>
            <div class="text-center sm:text-right bg-gradient-to-br from-orange-500 to-orange-600 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $totalSellers }}</div>
                <div class="text-xs sm:text-sm opacity-90">Total Toko Aktif</div>
            </div>
        </div>
    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-200 dark:border-gray-700 mb-6 sm:mb-8">
        <form method="GET" action="{{ route('admin.reports.sellers-location') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Lokasi</label>
                    <select name="location" class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Semua Lokasi</option>
                        @foreach($sellersByLocation as $location)
                            <option value="{{ $location->$groupBy }}" {{ request('location') == $location->$groupBy ? 'selected' : '' }}>
                                {{ $location->$groupBy }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2 flex-wrap">
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.reports.sellers-location') }}" class="px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-redo"></i> Reset
                    </a>
                    <a href="{{ route('admin.reports.sellers-location.export-excel', request()->all()) }}" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-file-download-alt"></i> Excel
                    </a>
                    <a href="{{ route('admin.reports.sellers-location.export-pdf', request()->all()) }}" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-file-pdf-alt"></i> PDF
                    </a>
                </div>
            </div>
        </form> Symfony Exception
 Symfony Docs
Error
HTTP 500 Internal Server Error
Call to a member function render() on null
Error
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Handler.php (line 879)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Handler.php -> renderExceptionContent (line 860)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Handler.php -> convertExceptionToResponse (line 839)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Handler.php -> prepareResponse (line 738)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Handler.php -> renderExceptionResponse (line 626)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php -> render (line 51)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handleException (line 182)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Auth/Middleware/Authorize.php -> {closure:Illuminate\Pipeline\Pipeline::prepareDestination():178} (line 59)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 50)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Auth/Middleware/Authenticate.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 63)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 87)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/View/Middleware/ShareErrorsFromSession.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 48)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 120)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php -> handleStatefulRequest (line 63)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/AddQueuedCookiesToResponse.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 36)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 74)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 137)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Routing/Router.php -> then (line 821)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Routing/Router.php -> runRouteWithinStack (line 800)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Routing/Router.php -> runRoute (line 764)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Routing/Router.php -> dispatchToRoute (line 753)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php -> dispatch (line 200)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> {closure:Illuminate\Foundation\Http\Kernel::dispatchToRouter():197} (line 180)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php -> {closure:Illuminate\Pipeline\Pipeline::prepareDestination():178} (line 21)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php -> handle (line 31)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 21)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php -> handle (line 51)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePostSize.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 27)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 109)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Http/Middleware/HandleCors.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 48)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 58)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/InvokeDeferredCallbacks.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 22)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePathEncoding.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 26)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> handle (line 219)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php -> {closure:{closure:Illuminate\Pipeline\Pipeline::carry():194}:195} (line 137)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php -> then (line 175)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php -> sendRequestThroughRouter (line 144)
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/Application.php -> handle (line 1220)
Application->handleRequest(object(Request))
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/public/index.php (line 20)
// Bootstrap Laravel and handle the request.../** @var Application $app */$app = require_once __DIR__.'/../bootstrap/app.php';$app->handleRequest(Request::capture());
in /Users/adrianobawan/Study/Iyan/Semester 5/Proyek Perangkat Lunak/UAS/KampuStore/vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php require_once (line 23)

    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $totalSellers }}</div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Total Toko</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $sellersByLocation->count() }}</div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Jumlah {{ ucfirst($groupBy) }}</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $sellersByLocation->max('total') }}</div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Toko Terbanyak</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                    {{ $sellersByLocation->count() > 0 ? round($totalSellers / $sellersByLocation->count(), 1) : 0 }}
                </div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Rata-rata/Provinsi</div>
            </div>
        </div>
    </div>

    <!-- Location Distribution -->
    @if(!$selectedLocation)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6 sm:mb-8">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Toko per {{ ucfirst($groupBy) }}</h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah toko berdasarkan lokasi</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ ucfirst($groupBy) }}</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jumlah Toko</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Persentase</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sellersByLocation as $index => $location)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $location->$groupBy }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $location->total }} Toko</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">
                            {{ $totalSellers > 0 ? round(($location->total / $totalSellers) * 100, 1) : 0 }}%
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($location->total >= 20)
                                <span class="badge badge-success">TINGGI</span>
                            @elseif($location->total >= 10)
                                <span class="badge badge-warning">SEDANG</span>
                            @else
                                <span class="badge badge-info">RENDAH</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="?location={{ urlencode($location->$groupBy) }}" class="btn btn-primary text-xs">
                                <i class="uil uil-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-center">
                                <i class="uil uil-map-marker text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Tidak ada data lokasi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Detail Location (if selected) -->
    @if($selectedLocation && $sellersDetail)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Toko di {{ $selectedLocation }}</h2>
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Daftar toko yang terdaftar</p>
            </div>
            <a href="{{ route('admin.reports.sellers-location') }}" class="px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all shadow-md font-medium flex items-center gap-2 text-sm">
                <i class="uil uil-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">PIC</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sellersDetail as $index => $seller)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $seller->nama_toko }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $seller->nama_pic }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $seller->no_hp_pic }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($seller->status == 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">AKTIF</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">PENDING</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-center">
                                <i class="uil uil-store text-4xl sm:text-5xl text-gray-400 dark:text-gray-600 mb-3"></i>
                                <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400">Tidak ada toko di lokasi ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection