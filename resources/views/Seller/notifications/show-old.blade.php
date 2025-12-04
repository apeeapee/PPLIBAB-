@extends('layouts.seller')

@section('title', $notification->subject . ' - KampuStore')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('seller.notifications.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 dark:text-blue-400">
                <i class="uil uil-arrow-left"></i>
                <span>Kembali ke Kotak Masuk</span>
            </a>
        </div>

        <!-- Email View -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <!-- Email Header -->
            <div class="border-b border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-start gap-4 mb-4">
                    @if($notification->type === 'approval')
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-check-circle text-3xl text-green-600 dark:text-green-400"></i>
                    </div>
                    @else
                    <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-times-circle text-3xl text-red-600 dark:text-red-400"></i>
                    </div>
                    @endif

                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $notification->subject }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span>
                                <i class="uil uil-user"></i>
                                <strong>Dari:</strong> Admin KampuStore
                            </span>
                            <span>
                                <i class="uil uil-envelope"></i>
                                <strong>Kepada:</strong> {{ $notification->seller->email_pic }}
                            </span>
                            <span>
                                <i class="uil uil-calendar-alt"></i>
                                {{ $notification->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                @if($notification->type === 'approval')
                <div class="px-4 py-3 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 rounded">
                    <p class="text-sm text-green-700 dark:text-green-300">
                        <i class="uil uil-check-circle"></i>
                        <strong>Status:</strong> Toko Anda telah disetujui! Selamat bergabung di KampuStore.
                    </p>
                </div>
                @else
                <div class="px-4 py-3 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded">
                    <p class="text-sm text-red-700 dark:text-red-300">
                        <i class="uil uil-exclamation-triangle"></i>
                        <strong>Status:</strong> Permohonan pendaftaran toko ditolak. Silakan perbaiki dan daftar kembali.
                    </p>
                </div>
                @endif
            </div>

            <!-- Email Body -->
            <div class="p-6">
                <div class="prose prose-sm max-w-none dark:prose-invert">
                    {!! $notification->html_content !!}
                </div>
            </div>

            <!-- Actions -->
            <div class="border-t border-gray-200 dark:border-gray-700 p-6 bg-gray-50 dark:bg-gray-900/50">
                <div class="flex flex-wrap gap-3">
                    @if($notification->type === 'approval')
                    <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                        <i class="uil uil-shop"></i>
                        Kelola Toko Saya
                    </a>
                    @else
                    <a href="{{ route('seller.register') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="uil uil-redo"></i>
                        Daftar Ulang
                    </a>
                    @endif

                    @if(!$notification->is_read)
                    <form action="{{ route('seller.notifications.mark-read', $notification) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            <i class="uil uil-check"></i>
                            Tandai Dibaca
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('seller.notifications.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        <i class="uil uil-arrow-left"></i>
                        Kembali ke Inbox
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
