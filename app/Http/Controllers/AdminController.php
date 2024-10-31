<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\RoomType;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Xendit\Customer\Customer;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin' || $role === 'owner') {
                return redirect()->route('dashboard');
            }
        }

        $room = RoomType::all();
        return view('home.index', compact('room'));
    }

    public function dashboard()
    {
        $totalUsers = Booking::where('status', 'checked_in')->distinct('user_id')->count('user_id');
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $totalContacts = Contact::count();

        return view('admin.index', compact('totalUsers', 'totalRooms', 'totalBookings', 'totalContacts'));
    }

    public function bookings()
    {
        $bookings = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')
            ->where('status', '!=', 'checked_out')
            ->get();

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
            ->where('status', 'checked_out')
            ->get();

        return view('report.report', compact('bookings'));
    }

    public function print_invoice($id)
    {
        $invoice = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')
            ->where('id', $id)
            ->first();
        
        $pdf = PDF::loadView('report.invoices.invoices', compact('invoice'));

        return $pdf->download('invoice.pdf'); 
    }
}
