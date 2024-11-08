<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Cart;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        if ($request->additionalBed == '1') {
            $additionalBed = true;
        } else {
            $additionalBed = false;
        }
        // Cek apakah ada kamar dengan status 'ready' sesuai dengan roomType_id yang di-request
        $cekroom = Room::where('status', 'ready')
            ->where('roomType_id', $request->roomType_id)
            ->get();

        // Jika tidak ada kamar yang tersedia, redirect kembali dengan pesan error
        if ($cekroom->isEmpty()) {
            return redirect()->back()->with('error', 'No rooms available for the selected room type!');
        }

        // Validasi data request
        $request->validate([
            'roomType_id' => 'required',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'jumlah_kamar' => 'required|integer|min:1'
        ]);

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menambahkan data ke cart
        Cart::create([
            'user_id' => $user->id,
            'roomType_id' => $request->roomType_id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'jumlah_kamar' => $request->jumlah_kamar,
            'is_additional_bed' => $additionalBed
        ]);

        // Redirect ke halaman cart dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Room added to cart');
    }

    public function destroy($id)
    {
        // Find the cart item by ID
        $cartItem = Cart::findOrFail($id);

        // Delete the cart item
        $cartItem->delete();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Item removed from cart successfully!');
    }
}