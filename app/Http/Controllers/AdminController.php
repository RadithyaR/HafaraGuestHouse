<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;
use Xendit\Customer\Customer;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function home()
    {
        $room = RoomType::all();

        return view('home.index', compact('room'));
    }

    public function dashboard()
    {
        if (Auth::id()) {
            $role = Auth::user()->role;

            if ($role == 'user') {
                $room = RoomType::all();

                return view('home.index', compact('room'));
            } else if ($role == 'admin' || $role == 'owner') {
                $totalUsers = Booking::where('status', 'confirmed')->distinct('user_id')->count('user_id');
                $totalRooms = Room::count();
                $totalBookings = Booking::count();
                $totalContacts = Contact::count();

                return view('admin.index', compact('totalUsers', 'totalRooms', 'totalBookings', 'totalContacts'));
            } else {
                return redirect()->route('home');
            }
        }

        $room = RoomType::all();
        return view('home.index', compact('room'));
    }



    public function bookings()
    {
        $bookings = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')->get();

        return view('admin.booking', compact('bookings'));
    }

    public function message()
    {
        $message = Contact::all();

        return view('admin.message', compact('message'));
    }

    public function customer()
    {
        $user = User::where('role', 'user')->get();

        return view('admin.customer', compact('user'));
    }

    public function owner()
    {
        $bookings = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')->get();
        return view('admin.owner', compact('bookings'));
    }

    public function update_user(Request $request)
    {
        $users = User::find($request->id);

        if ($request->hasFile('customer_file')) {
            $file = $request->file('customer_file');

            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('blob', $filename, 'public');

            $users->blob_path = Storage::url($path);
            $users->save();
        }

        $user = User::where('role', 'user')->get();

        return view('admin.customer', compact('user'));
    }

    public function report()
    {
        $bookings = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')
        ->where('status', 'done')
        ->get();

        return view('report.report', compact('bookings'));
    }
}
