<?php

namespace App\Http\Controllers;

use App\Mail\ReviewThankYou;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        if (Auth::check()) {
            // Cek apakah user adalah penjual dari produk ini
            $user = Auth::user();
            if ($user->seller && $product->seller_id === $user->seller->id) {
                return redirect()->route('products.show', $product)
                    ->with('error', 'Anda tidak dapat memberikan ulasan pada produk Anda sendiri.');
            }

            $data = $request->validate([
                'rating' => ['required', 'integer', 'min:1', 'max:5'],
                'body' => ['required', 'string', 'max:2000'],
            ]);

            $review = Review::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                ],
                [
                    'rating' => $data['rating'],
                    'body' => $data['body'],
                ]
            );

            // Send email to logged-in user
            Mail::to($user->email)->send(new ReviewThankYou($review, $product, $user->name));

            return redirect()->route('products.show', $product)->with('status', 'Ulasan tersimpan dan email konfirmasi terkirim.');
        } else {
            $data = $request->validate([
                'guest_name' => ['required', 'string', 'max:255'],
                'guest_phone' => ['required', 'string', 'max:20'],
                'guest_email' => ['required', 'email', 'max:255'],
                'guest_province' => ['required', 'string', 'max:255'],
                'guest_city' => ['nullable', 'string', 'max:255'],
                'rating' => ['required', 'integer', 'min:1', 'max:5'],
                'body' => ['required', 'string', 'max:2000'],
            ]);

            $review = Review::create([
                'product_id' => $product->id,
                'guest_name' => $data['guest_name'],
                'guest_phone' => $data['guest_phone'],
                'guest_email' => $data['guest_email'],
                'guest_province' => $data['guest_province'] ?? null,
                'guest_city' => $data['guest_city'] ?? null,
                'rating' => $data['rating'],
                'body' => $data['body'],
            ]);

            Mail::to($data['guest_email'])->send(new ReviewThankYou($review, $product, $data['guest_name']));

            return redirect()->route('products.show', $product)
                ->with('status', 'Terima kasih atas ulasan Anda! Kami telah mengirimkan email konfirmasi.');
        }
    }
}

