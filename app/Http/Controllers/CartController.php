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
        $cartItems = Booking::with(['bookingDetail.room.roomTypes'])
                            ->where('user_id', Auth::id())
                            ->where('status', 'pending')
                            ->get();
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
            ->take($request->jumlah_kamar) // Ambil jumlah kamar sesuai permintaan
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
        $booking = Booking::create([
            'user_id' => $user->id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'jumlah_kamar' => $request->jumlah_kamar,
            'status' => 'pending',
            'booking_time' => now(),
            'is_cart' => true,
            'is_additional_bed' => $additionalBed
        ]);
        // Menambahkan data ke tabel booking_detail untuk setiap kamar yang dipesan
        foreach ($cekroom as $room) {
        BookingDetail::create([
            'booking_id' => $booking->id, // ID booking yang baru dibuat
            'room_id' => $room->id, // ID kamar yang tersedia
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

        // Redirect ke halaman cart dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Room added to cart');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}