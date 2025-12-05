@extends('layouts.seller')

@section('title', $notification->subject . ' - KampuStore')

@push('styles')
<style>
    .notif-detail-container { max-width:900px;margin:0 auto; }
    .back-link { display:inline-flex;align-items:center;gap:8px;color:#3b82f6;font-size:14px;font-weight:600;text-decoration:none;margin-bottom:24px;transition:color .2s; }
    .back-link:hover { color:#2563eb; }
    
    .email-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.1); }
    .email-header { padding:32px;border-bottom:1px solid var(--card-border); }
    .email-header-top { display:flex;gap:20px;margin-bottom:20px; }
    
    .email-icon { width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:32px; }
    .email-icon.approval { background:rgba(34,197,94,0.1);color:#22c55e; }
    .email-icon.rejection { background:rgba(239,68,68,0.1);color:#ef4444; }
    
    .email-title { font-size:28px;font-weight:700;color:var(--text-main);margin-bottom:16px; }
    .email-meta { display:flex;flex-wrap:wrap;gap:20px;font-size:14px;color:var(--text-muted); }
    .email-meta span { display:flex;align-items:center;gap:6px; }
    .email-meta strong { color:var(--text-main); }
    
    .email-body { padding:32px;line-height:1.8;color:var(--text-main); }
    .email-body p { margin-bottom:16px; }
    .email-body strong { font-weight:700;color:var(--text-main); }
    
    .reason-box { background:rgba(239,68,68,0.05);border-left:4px solid #ef4444;padding:20px;border-radius:8px;margin:20px 0; }
    .reason-box strong { color:#ef4444;display:block;margin-bottom:8px; }
    
    .email-footer { padding:24px 32px;border-top:1px solid var(--card-border);background:rgba(249,115,22,0.03); }
    .email-footer p { font-size:13px;color:var(--text-muted);text-align:center; }
    
    .action-buttons { display:flex;gap:12px;margin-top:24px; }
    .btn-delete { padding:10px 20px;background:rgba(239,68,68,0.1);color:#ef4444;font-size:14px;font-weight:600;border-radius:10px;border:none;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:8px; }
    .btn-delete:hover { background:rgba(239,68,68,0.2); }
</style>
@endpush

@section('content')
<div class="notif-detail-container">
    <a href="{{ route('seller.notifications.index') }}" class="back-link">
        <i class="uil uil-arrow-left"></i>
        Kembali ke Kotak Masuk
    </a>

    <div class="email-card">
        <div class="email-header">
            <div class="email-header-top">
                <div class="email-icon {{ $notification->type === 'approval' ? 'approval' : 'rejection' }}">
                    @if($notification->type === 'approval')
                    <i class="uil uil-check-circle"></i>
                    @else
                    <i class="uil uil-times-circle"></i>
                    @endif
                </div>
                <div style="flex:1;">
                    <h1 class="email-title">{{ $notification->subject }}</h1>
                    <div class="email-meta">
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
            <div style="padding:16px 20px;background:rgba(34,197,94,0.1);border-left:4px solid #22c55e;border-radius:8px;color:#22c55e;">
                <i class="uil uil-check-circle"></i>
                <strong>Selamat!</strong> Toko Anda telah disetujui dan dapat mulai berjualan.
            </div>
            @else
            <div style="padding:16px 20px;background:rgba(239,68,68,0.1);border-left:4px solid #ef4444;border-radius:8px;color:#ef4444;">
                <i class="uil uil-times-circle"></i>
                <strong>Maaf,</strong> Toko Anda belum dapat disetujui. Silakan perbaiki dan daftar ulang.
            </div>
            @endif
        </div>

        <div class="email-body">
            {!! nl2br(e($notification->message)) !!}

            @if($notification->rejection_reason)
            <div class="reason-box">
                <strong>Alasan Penolakan:</strong>
                {{ $notification->rejection_reason }}
            </div>
            @endif
        </div>

        <div class="email-footer">
            <p>Email ini dikirim secara otomatis oleh sistem KampuStore. Mohon tidak membalas email ini.</p>
            
            <div class="action-buttons">
                <a href="{{ route('seller.notifications.index') }}" class="btn-add">
                    <i class="uil uil-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
