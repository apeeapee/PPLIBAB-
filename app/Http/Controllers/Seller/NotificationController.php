<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Tampilkan semua notifikasi seller
     */
    public function index()
    {
        // Ambil seller berdasarkan user yang login
        $seller = Seller::where('user_id', Auth::id())->first();
        
        if (!$seller) {
            return redirect()->route('home')->with('error', 'Anda belum terdaftar sebagai seller.');
        }

        // Ambil semua notifikasi seller
        $notifications = Notification::where('seller_id', $seller->id)
            ->latest()
            ->get();

        $unreadCount = $notifications->where('is_read', false)->count();

        return view('seller.notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Tampilkan detail notifikasi
     */
    public function show(Notification $notification)
    {
        // Pastikan notifikasi milik seller yang login
        $seller = Seller::where('user_id', Auth::id())->first();
        
        if ($notification->seller_id !== $seller->id) {
            abort(403, 'Unauthorized access');
        }

        // Mark as read
        if (!$notification->is_read) {
            $notification->markAsRead();
        }

        return view('seller.notifications.show', compact('notification'));
    }

    /**
     * Mark notifikasi sebagai sudah dibaca
     */
    public function markAsRead(Notification $notification)
    {
        $seller = Seller::where('user_id', Auth::id())->first();
        
        if ($notification->seller_id !== $seller->id) {
            abort(403);
        }

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sebagai sudah dibaca.');
    }

    /**
     * Mark semua notifikasi sebagai sudah dibaca
     */
    public function markAllAsRead()
    {
        $seller = Seller::where('user_id', Auth::id())->first();

        Notification::where('seller_id', $seller->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return back()->with('success', 'Semua notifikasi ditandai sebagai sudah dibaca.');
    }
}
