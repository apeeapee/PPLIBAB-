@extends('layouts.seller')

@section('title', 'Notifikasi Email - KampuStore')

@push('styles')
@include('partials.seller-styles')
<style>
    .notif-container { max-width:900px;margin:0 auto; }
    .notif-header { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:32px;margin-bottom:24px; }
    .notif-header-top { display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:16px; }
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
    .notif-icon.info { background:rgba(59,130,246,0.1);color:#3b82f6; }
    
    .notif-body { flex:1; }
    .notif-subject { font-size:18px;font-weight:700;color:var(--text-main);margin-bottom:8px; }
    .notif-badge { display:inline-block;padding:4px 12px;border-radius:6px;font-size:12px;font-weight:600;margin-bottom:8px; }
    .notif-badge.approval { background:rgba(34,197,94,0.1);color:#22c55e; }
    .notif-badge.rejection { background:rgba(239,68,68,0.1);color:#ef4444; }
    .notif-badge.info { background:rgba(59,130,246,0.1);color:#3b82f6; }
    .notif-message { font-size:14px;color:var(--text-muted);margin-bottom:12px; }
    .notif-meta { display:flex;gap:16px;font-size:12px;color:var(--text-muted); }
    .notif-meta span { display:flex;align-items:center;gap:4px; }
    
    .notif-arrow { font-size:24px;color:var(--text-muted);display:flex;align-items:center; }
    
    .empty-state { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:60px 24px;text-align:center; }
    .empty-state i { font-size:64px;color:var(--text-muted);margin-bottom:16px; }
    .empty-state h3 { font-size:20px;font-weight:700;color:var(--text-main);margin-bottom:8px; }
    .empty-state p { color:var(--text-muted); }
</style>
@endpush

@section('content')
<div class="content-wrapper">
<div class="notif-container">
    <div class="notif-header">
        <div class="notif-header-top">
            <div>
                <h1 class="page-title">
                    <i class="uil uil-envelope" style="color:#3b82f6;margin-right:12px;"></i>
                    Kotak Masuk Email
                </h1>
                <p class="page-subtitle">Notifikasi verifikasi toko dari admin</p>
            </div>
            @if($unreadCount > 0)
            <form action="{{ route('seller.notifications.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="btn-mark-all">
                    <i class="uil uil-check"></i> Tandai Semua Dibaca
                </button>
            </form>
            @endif
        </div>

        @if($unreadCount > 0)
        <div class="notif-info">
            <i class="uil uil-info-circle"></i>
            Anda memiliki <strong>{{ $unreadCount }}</strong> notifikasi yang belum dibaca
        </div>
        @endif
    </div>

    <div class="notif-list">
        @forelse($notifications as $notification)
        <a href="{{ route('seller.notifications.show', $notification) }}" class="notif-item {{ $notification->is_read ? 'read' : 'unread' }}">
            <div class="notif-content">
                <div class="notif-icon {{ $notification->type === 'approval' ? 'approval' : ($notification->type === 'rejection' ? 'rejection' : 'info') }}">
                    @if($notification->type === 'approval')
                    <i class="uil uil-check-circle"></i>
                    @elseif($notification->type === 'rejection')
                    <i class="uil uil-times-circle"></i>
                    @else
                    <i class="uil uil-info-circle"></i>
                    @endif
                </div>
                
                <div class="notif-body">
                    <div class="notif-badge {{ $notification->type === 'approval' ? 'approval' : ($notification->type === 'rejection' ? 'rejection' : 'info') }}">
                        @if($notification->type === 'approval')
                        ✓ Toko Disetujui
                        @elseif($notification->type === 'rejection')
                        ✗ Toko Ditolak
                        @else
                        ℹ Informasi
                        @endif
                    </div>
                    <div class="notif-subject">{{ $notification->subject }}</div>
                    <div class="notif-message">
                        {{ Str::limit(strip_tags($notification->message), 120) }}
                    </div>
                    <div class="notif-meta">
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
                
                <div class="notif-arrow">
                    <i class="uil uil-angle-right"></i>
                </div>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <i class="uil uil-envelope-open"></i>
            <h3>Belum Ada Notifikasi</h3>
            <p>Notifikasi verifikasi toko akan muncul di sini</p>
        </div>
        @endforelse
    </div>
</div>
</div>
@endsection
