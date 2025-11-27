<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerRegistrationController extends Controller
{
    public function create()
    {
        return view('seller.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_toko'         => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:500',

            'nama_pic'          => 'required|string|max:255',
            'no_hp_pic'         => 'required|string|max:20',

            // WAJIB EMAIL STUDENTS UNDIP
            'email_pic'         => [
                'required',
                'email',
                'regex:/^[A-Za-z0-9._%+-]+@students\.undip\.ac\.id$/',
            ],

            'alamat_pic'        => 'required|string',
            'rt'                => 'required|string|max:5',
            'rw'                => 'required|string|max:5',

            'kelurahan'         => 'required|string|max:255',
            'kecamatan'         => 'required|string|max:255',
            'kota'              => 'required|string|max:255',
            'kode_pos'          => 'required|string|max:10',

            'no_ktp_pic'        => 'required|string|max:30',

            'foto_pic'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'file_ktp_pic'      => 'required|mimes:pdf,jpg,jpeg,png|max:4096',
        ], [
            'email_pic.regex' => 'Email harus menggunakan email @students.undip.ac.id!',
        ]);

        // Pastikan user login
        $user = Auth::user();
        $userId = $user->id;

        $existing = Seller::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Kamu sudah memiliki toko atau pengajuan yang sedang diproses.');
        }

        $fotoPicPath = $request->file('foto_pic')->store('sellers/pic', 'public');
        $fileKtpPath = $request->file('file_ktp_pic')->store('sellers/ktp-file', 'public');

        Seller::create([
            'user_id'           => $userId,

            'nama_toko'         => $validated['nama_toko'],
            'deskripsi_singkat' => $validated['deskripsi_singkat'],

            'nama_pic'          => $validated['nama_pic'],
            'no_hp_pic'         => $validated['no_hp_pic'],
            'no_ktp_pic'        => $validated['no_ktp_pic'],
            'email_pic'         => $validated['email_pic'],

            'alamat_pic'        => $validated['alamat_pic'],
            'rt'                => $validated['rt'],
            'rw'                => $validated['rw'],
            'kelurahan'         => $validated['kelurahan'],
            'kecamatan'         => $validated['kecamatan'],
            'provinsi'          => 'Jawa Tengah',
            'kota'              => $validated['kota'],
            'kode_pos'          => $validated['kode_pos'],

            'foto_pic'          => $fotoPicPath,
            'file_ktp_pic'      => $fileKtpPath,

            'status'            => 'pending',
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Pengajuan buka toko berhasil dikirim. Tunggu verifikasi admin.');
    }
}
