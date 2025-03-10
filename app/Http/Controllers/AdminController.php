<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Role;
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
            $role = strtolower(Auth::user()->role->name);

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
        $totalRooms = Room::where('status', 'ready')->count();
        $totalBookings = Booking::where('status', 'booked')->count();
        $totalContacts = Contact::count();

        $bookings = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')->get();

        return view('admin.index', compact('totalUsers', 'totalRooms', 'totalBookings', 'totalContacts', 'bookings'));
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
        $user = User::where('role_id', 5)->get();

        return view('admin.customer', compact('user'));
    }

    public function role()
    {
        $user = User::all();
        $role = Role::all();

        return view('admin.role_management', compact('user', 'role'));
    }

    public function update_role(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            $user = User::findOrFail($request->id);
            $user->role_id = $request->role_id;
            $user->save();

            return redirect()->back()->with('success', 'User role updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update user role. Please try again.']);
        }
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        try {
            $user = User::findOrFail($request->id);
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete user. Please try again.']);
        }
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

        $user = User::where('role', 5)->get();

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
        $isAdmin = strtolower(Auth::user()->role->name) === 'admin';
        $isAllowed = Booking::where('id', $id)->where('user_id', Auth::id())->exists();
        if (!$isAdmin && !$isAllowed) {
            abort(403);
        }
        $invoice = Booking::with('user', 'bookingDetail.room.roomTypes', 'payment')
            ->where('id', $id)
            ->first();

        $pdf = PDF::loadView('report.invoices.invoices', compact('invoice'));

        return $pdf->download('invoice.pdf');
    }
}
