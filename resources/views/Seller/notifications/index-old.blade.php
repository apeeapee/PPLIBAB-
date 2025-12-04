@extends('layouts.seller')

@section('title', 'Notifikasi Email - KampuStore')

@push('styles')
<style>
    .notif-container { max-width:900px;margin:0 auto; }
    .notif-header { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:32px;margin-bottom:24px; }
    .notif-header-top { display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:16px; }
    .notif-title { font-size:28px;font-weight:700;color:var(--text-main);margin:0;display:flex;align-items:center;gap:12px; }
    .notif-title i { color:#3b82f6; }
    .notif-subtitle { font-size:14px;color:var(--text-muted);margin:4px 0 0 0; }
    .btn-mark-all { padding:10px 20px;background:rgba(59,130,246,0.1);color:#3b82f6;font-size:14px;font-weight:600;border-radius:10px;border:none;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:8px; }
    .btn-mark-all:hover { background:rgba(59,130,246,0.2); }
    .notif-info { padding:16px 20px;background:rgba(59,130,246,0.1);border-left:4px solid #3b82f6;border-radius:8px;color:#3b82f6;font-size:14px; }
    
    .notif-list { display:flex;flex-direction:column;gap:16px; }
    .notif-item { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden;transition:all .3s;text-decoration:none;display:block; }
    .notif-item:hover { box-shadow:0 8px 24px rgba(0,0,0,0.15);transform:translateY(-2px); }
    .notif-item.unread { border-left:4px solid #3b82f6; }
    .notif-item.read { opacity:0.7; }
    .notif-content { padding:24px;display:flex;gap:16px; }
    
    .notif-icon { width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:28px; }
    .notif-icon.approval { background:rgba(34,197,94,0.1);color:#22c55e; }
    .notif-icon.rejection { background:rgba(239,68,68,0.1);color:#ef4444; }
                            </div>
                            @else
                            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                <i class="uil uil-times-circle text-2xl text-red-600 dark:text-red-400"></i>
                            </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $notification->subject }}
                                </h3>
                                @if(!$notification->is_read)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                    <i class="uil uil-circle text-xs mr-1"></i> Baru
                                </span>
                                @endif
                            </div>

                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                {{ $notification->message }}
                            </p>

                            <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                <span>
                                    <i class="uil uil-calendar-alt"></i>
                                    {{ $notification->created_at->format('d M Y, H:i') }}
                                </span>
                                @if($notification->is_read)
                                <span>
                                    <i class="uil uil-check"></i>
                                    Dibaca {{ $notification->read_at->diffForHumans() }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Arrow -->
                        <div class="flex-shrink-0">
                            <i class="uil uil-angle-right text-2xl text-gray-400"></i>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-12 text-center">
                <i class="uil uil-envelope-open text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Belum Ada Notifikasi
                </h3>
                <p class="text-gray-500 dark:text-gray-400">
                    Notifikasi verifikasi toko akan muncul di sini
                </p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
