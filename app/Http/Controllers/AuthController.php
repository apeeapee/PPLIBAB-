<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->seller) {
                return redirect()->route('seller.dashboard');
            } else {
                return redirect()->route('products.index')
                    ->with('warning', 'Silakan lengkapi pendaftaran toko Anda.');
            }
        }

        return back()
            ->withErrors(['email' => 'Kredensial tidak valid'])
            ->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register-seller');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // User account
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => ['required', 'confirmed', Password::defaults()],

            // Seller/Toko data
            'nama_toko' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:500',
            'nama_pic' => 'required|string|max:255',
            'no_hp_pic' => [
                'required',
                'string',
                'regex:/^(\+62|62|0)[0-9]{9,12}$/',
            ],
            'email_pic' => [
                'required',
                'email',
            ],
            'alamat_pic' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'no_ktp_pic' => [
                'required',
                'string',
                'regex:/^[0-9]{16}$/',
            ],
            'foto_pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'file_ktp_pic' => 'required|mimes:pdf,jpg,jpeg,png|max:4096',
        ], [
            'no_hp_pic.regex' => 'Nomor HP harus berformat Indonesia yang valid (contoh: 081234567890)',
            'no_ktp_pic.regex' => 'Nomor KTP harus 16 digit angka',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $fotoPicPath = $request->file('foto_pic')->store('sellers/pic', 'public');
        $fileKtpPath = $request->file('file_ktp_pic')->store('sellers/ktp-file', 'public');

        Seller::create([
            'user_id' => $user->id,
            'nama_toko' => $validated['nama_toko'],
            'deskripsi_singkat' => $validated['deskripsi_singkat'],
            'nama_pic' => $validated['nama_pic'],
            'no_hp_pic' => $validated['no_hp_pic'],
            'no_ktp_pic' => $validated['no_ktp_pic'],
            'email_pic' => $validated['email_pic'],
            'alamat_pic' => $validated['alamat_pic'],
            'rt' => $validated['rt'],
            'rw' => $validated['rw'],
            'kelurahan' => $validated['kelurahan'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'foto_pic' => $fotoPicPath,
            'file_ktp_pic' => $fileKtpPath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Pendaftaran toko berhasil! Silakan login dan tunggu verifikasi admin.');
    }

    public function logout(Request $request)
    {
        Auth::logout();     
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'You have been logged out.');
    }
}

