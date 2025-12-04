<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SellerApproved;
use App\Mail\SellerRejected;
use App\Models\Notification;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SellerVerificationController extends Controller
{
    /**
     * LIST PENGAJUAN TOKO
     */
    public function index()
    {
        // Ambil semua seller + relasi user
        $sellers = Seller::with('user')
            ->latest()
            ->get();

        // Hitung angka-angka buat header (kayak di dashboard)
        $total    = $sellers->count();
        $pending  = $sellers->where('status', 'pending')->count();
        $approved = $sellers->where('status', 'approved')->count();
        $rejected = $sellers->where('status', 'rejected')->count();

        return view('admin.sellers.index', [
            'sellers'  => $sellers,
            'total'    => $total,
            'pending'  => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
        ]);
    }

    /**
     * DETAIL PENGAJUAN TOKO
     */
    public function show(Seller $seller)
    {
        $seller->load('user');

        $fotoKtpUrl = $seller->foto_ktp
            ? Storage::url($seller->foto_ktp)
            : null;

        $fotoPicUrl = $seller->foto_pic
            ? Storage::url($seller->foto_pic)
            : null;

        $fileKtpUrl = $seller->file_ktp_pic
            ? Storage::url($seller->file_ktp_pic)
            : null;

        return view('admin.sellers.show', [
            'seller'      => $seller,
            'fotoKtpUrl'  => $fotoKtpUrl,
            'fotoPicUrl'  => $fotoPicUrl,
            'fileKtpUrl'  => $fileKtpUrl,
        ]);
    }

    /**
     * APPROVE
     */
    public function approve(Seller $seller)
    {
        $seller->update(['status' => 'approved']);

        // Kirim email (akan masuk queue)
        Mail::to($seller->email_pic)->send(new SellerApproved($seller));

        // Simpan notifikasi ke database (internal inbox)
        $htmlContent = view('emails.seller-approved', [
            'seller' => $seller,
            'activationUrl' => route('seller.dashboard')
        ])->render();

        Notification::create([
            'seller_id' => $seller->id,
            'type' => 'approval',
            'subject' => 'Pendaftaran Toko Anda Telah Disetujui - KampuStore',
            'message' => "Selamat! Pendaftaran toko {$seller->nama_toko} Anda telah disetujui oleh admin KampuStore.",
            'html_content' => $htmlContent,
        ]);

        return back()->with('success', 'Seller disetujui dan notifikasi telah dikirim.');
    }

    /**
     * REJECT
     */
    public function reject(Seller $seller, Request $request)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $seller->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Kirim email (akan masuk queue)
        Mail::to($seller->email_pic)->send(new SellerRejected($seller, $validated['rejection_reason']));

        // Simpan notifikasi ke database (internal inbox)
        $htmlContent = view('emails.seller-rejected', [
            'seller' => $seller,
            'rejectionReason' => $validated['rejection_reason']
        ])->render();

        Notification::create([
            'seller_id' => $seller->id,
            'type' => 'rejection',
            'subject' => 'Pendaftaran Toko Anda Ditolak - KampuStore',
            'message' => "Mohon maaf, pendaftaran toko {$seller->nama_toko} Anda belum dapat disetujui. Alasan: {$validated['rejection_reason']}",
            'html_content' => $htmlContent,
        ]);

        return back()->with('success', 'Seller ditolak dan notifikasi telah dikirim.');
    }
}
