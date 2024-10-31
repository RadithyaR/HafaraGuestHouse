<?php

namespace App\Http\Controllers;

use App\Models\BookingDetail;
use App\Models\Cart;
use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;

use App\Models\Room;

use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function room()
    {
        $room = RoomType::all();

        return view('home.room', compact('room'));
    }

    public function room_details($id)
    {
        $room = RoomType::find($id);

        return  view('home.room_details', compact('room'));
    }

    public function contact(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->user_id = Auth::id();
        $contact->save();

        return redirect()->back()->with('message', 'Message Sent Successfully');
    }

    public function contact_us()
    {

        return view('home.contact_us');
    }

    public function about()
    {
        return view('home.about_us');
    }

    public function history()
    {
        $bookings = DB::table('bookings')
            ->join('booking_detail', 'bookings.id', '=', 'booking_detail.booking_id')
            ->join('rooms', 'booking_detail.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.roomType_id', '=', 'room_types.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('payment', 'bookings.id', '=', 'payment.booking_id')
            ->select(
                'bookings.id',
                'users.name as user_name',
                'room_types.name as room_type_name',
                'rooms.status as rstatus',
                'bookings.checkin_date',
                'bookings.checkout_date',
                'bookings.jumlah_kamar',
                'bookings.status',
                'payment.status as pstatus',
                'bookings.total_price'
            )
            ->where('bookings.user_id', Auth::id())
            ->groupBy('bookings.id', 'users.name', 'room_types.name', 'rooms.status', 'bookings.checkin_date', 'bookings.checkout_date', 'bookings.jumlah_kamar', 'bookings.status', 'payment.status', 'bookings.total_price')
            ->get();

        return view('home.history', compact('bookings'));
    }

}
