<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

    public function checkAvailableRooms(Request $request)
    {
        // Validate the input dates
        $request->validate([
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $checkin_date = $request->input('checkin_date');
        $checkout_date = $request->input('checkout_date');

        // Fetch room types with available rooms within the specified date range
        $availableRoomTypes = RoomType::withCount([
            'rooms' => function ($query) use ($checkin_date, $checkout_date) {
                $query->whereDoesntHave('bookings', function ($q) use ($checkin_date, $checkout_date) {
                    // Exclude rooms that have bookings overlapping with the selected dates
                    $q->whereIn('status', ['booked', 'checked_in'])
                        ->where(function ($q2) use ($checkin_date, $checkout_date) {
                        $q2->whereBetween('checkin_date', [$checkin_date, $checkout_date])
                            ->orWhereBetween('checkout_date', [$checkin_date, $checkout_date])
                            ->orWhere(function ($q3) use ($checkin_date, $checkout_date) {
                                $q3->where('checkin_date', '<=', $checkin_date)
                                    ->where('checkout_date', '>=', $checkout_date);
                            });
                    });
                });
            }
        ])->get();

        return view('home.available_rooms', compact('availableRoomTypes', 'checkin_date', 'checkout_date'));
    }

    public function book($id, $checkin_date, $checkout_date)
    {
        $roomType = RoomType::withCount('rooms')->findOrFail($id);

        $user = Auth::user();

        return view('home.book_room', compact('roomType', 'checkin_date', 'checkout_date', 'user'));
    }

    public function bookRoom(Request $request)
    {
        // Get the current logged-in user
        $user = Auth::user()->id;
        $email = Auth::user()->email;
        //$external_id = $this->generateCustomExternalId();
        // $external_id = (string) Str::uuid();
        $amountOfPrice = 0;
        $booking_ids = [];
        $payments = [];
        $external_ids = [];

        // Get all cart items for the user
        $cartItems = Booking::with(['bookingDetail.room.roomTypes'])
                            ->where('user_id', $user)
                            ->where('status', 'pending')
                            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        foreach ($cartItems as $cart) {
            // Get the check-in and check-out dates from the cart
            $checkinDate = $cart->checkin_date;
            $checkoutDate = $cart->checkout_date;

            // Calculate the total stay duration
            $stayDuration = (int) \Carbon\Carbon::parse($checkinDate)->diffInDays(\Carbon\Carbon::parse($checkoutDate));

            // Get the first booking detail to find the room and room type
            $bookingDetail = $cart->bookingDetail->first();
            if (!$bookingDetail) {
                return redirect()->back()->with('error', 'Booking detail not found!');
            }

            // Get the room and room type
            $room = $bookingDetail->room;
            if (!$room) {
                return redirect()->back()->with('error', 'Room not found!');
            }
            
            $roomType = $bookingDetail->room->roomTypes;
            if (!$roomType) {
                return redirect()->back()->with('error', 'Room type not found!');
            }
            
            // Get the total price for the booking (room price * jumlah kamar * stay duration)
            $roomPrice = $roomType->price;
            $totalPrice = $roomPrice * $cart->jumlah_kamar * $stayDuration;
            
            if ($cart->is_additional_bed) {
                $totalPrice += 50000;
            }

            // Get the rooms that are available for the current room type
            $rooms = Room::where('roomType_id', $roomType->id)
                ->where('status', 'ready')
                ->take($cart->jumlah_kamar)
                ->get();

            // Check if there are enough rooms available
            if ($rooms->count() < $cart->jumlah_kamar) {
                return redirect()->back()->with('error', 'Not enough rooms available for ' . $roomType->name);
            }

            $external_id = 'pym-' . $cart->id;
            $external_ids[] = $external_id;
            
            $payment = Payment::create([
                'booking_id' => $cart->id,
                'user_id' => $user,
                'checkout_link' => 'https://example.com/checkout',
                'external_id' => $external_id,
                'status' => 'pending',
                'expired_at' => now()->addHour(1),
            ]);;

            // foreach ($rooms as $room) {
            //     $cart->rooms()->attach($room->id); // Assuming 1 room at a time
            // }
            $amountOfPrice += $totalPrice;
            $booking_ids[] = $cart->id;
            $payments[] = $payment;

            // Update booking 
            $cart->update([
                'is_cart'=>false,
                'status'=>'booked',
                'total_price' => $totalPrice,
                'booking_time' => now()
            ]);
        }

        $external_ids = implode(',', $external_ids);
        
        $createInvoice = new CreateInvoiceRequest([
            'external_id' => $external_ids,
            'amount' => $amountOfPrice,
            'payer_email' => $email,
            'description' => 'Payment for booking ' . implode(', ', $booking_ids),
            'invoice_duration' => 7200,
            'success_redirect_url' => route('payment.success', ['id' => $external_ids]),
            'failure_redirect_url' => route('payment.failure', ['id' => $external_ids]),
        ]);

        $apiInstance = new InvoiceApi();
        $generateInvoice = $apiInstance->createInvoice($createInvoice);
        foreach ($payments as $payment) {
            $payment->checkout_link = $generateInvoice['invoice_url'];
            $payment->save();
        }
    

        // Show success message and redirect to cart page
        return redirect()->away($generateInvoice['invoice_url']);
    }

    public function delete($id)
    {
        // Hapus booking berdasarkan ID
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }
        $bookingDetails = BookingDetail::where('booking_id', $booking->id)->first();
        $rooms = Room::find($bookingDetails->room_id);
        $rooms->status = 'ready';
        $rooms->save();
        // Hapus booking detail terkait
        BookingDetail::where('booking_id', $booking->id)->delete();

        // Hapus data booking
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    public function checkout($id, Request $request)
    {
        $remarks = $request->remarks;
        $fine_price = $request->fine_price;
        $booking = Booking::find($id);
        $booking->remarks = $remarks;
        $booking->fine_price = $fine_price;
        $booking->status = 'checked_out';
        $booking->save();
        $bookingDetails = BookingDetail::where('booking_id', $booking->id)->get(); 

        // Loop through each booking detail and update the room status to 'ready'
        foreach ($bookingDetails as $bookingDetail) {
            $room = Room::find($bookingDetail->room_id);
            if ($room && $room->status !== 'ready') {
                $room->status = 'ready';
                $room->save();
            }
        }
        return redirect(route('admin.booking'))->with('success', 'Rooms successfully checked out.');
    }

    public function confirm(Request $request)
    {
        // Mendapatkan booking berdasarkan ID
        $booking = Booking::find($request->booking_id);

        // Update status booking menjadi confirmed
        $booking->status = 'checked_in';
        $booking->save();

        // Looping untuk setiap kamar yang dipilih
        foreach ($request->selected_room as $roomId) {
            // Cari kamar berdasarkan ID yang dipilih
            $room = Room::find($roomId);

            // Jika kamar ditemukan, ubah statusnya
            if ($room) {
                $room->status = 'not_ready';
                $room->save();
            }
        }

        // Redirect ke halaman booking dengan pesan sukses
        return redirect(route('admin.booking'))->with('success', 'Rooms successfully confirmed.');
    }


    public function detailconfirm($id)
    {
        $bookings = DB::table('bookings')
            ->join('booking_detail', 'bookings.id', '=', 'booking_detail.booking_id')
            ->join('rooms', 'booking_detail.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.roomType_id', '=', 'room_types.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'bookings.id',
                'users.name as user_name',
                'room_types.id as room_type_ids',
                'room_types.name as room_type_name',
                'rooms.status as rstatus',
                'bookings.checkin_date',
                'bookings.checkout_date',
                'bookings.jumlah_kamar',
                'bookings.status'
            )
            ->where('bookings.id', $id)
            ->first();
        $rooms = Room::where('roomType_id', $bookings->room_type_ids)->where('status', 'ready')->get();

        $roomscount = Room::where('roomType_id', $bookings->room_type_ids)->where('status', 'ready')->get()->count();
        return view('admin.bookingdetail', compact('bookings', 'rooms', 'roomscount'));
    }

    public function detailcheckout($id)
    {
        $bookings = DB::table('bookings')
            ->join('booking_detail', 'bookings.id', '=', 'booking_detail.booking_id')
            ->join('rooms', 'booking_detail.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.roomType_id', '=', 'room_types.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'bookings.id',
                'users.name as user_name',
                'room_types.id as room_type_ids',
                'room_types.name as room_type_name',
                'rooms.status as rstatus',
                'bookings.checkin_date',
                'bookings.checkout_date',
                'bookings.jumlah_kamar',
                'bookings.status'
            )
            ->where('bookings.id', $id)
            ->first();
        $rooms = Room::where('roomType_id', $bookings->room_type_ids)->where('status', 'ready')->get();

        $roomscount = Room::where('roomType_id', $bookings->room_type_ids)->where('status', 'ready')->get()->count();
        return view('admin.checkoutdetail', compact('bookings', 'rooms', 'roomscount'));
    }

    public function cancel($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'cancelled';
        $booking->save();
        $bookingDetails = BookingDetail::where('booking_id', $booking->id)->first();
        $rooms = Room::find($bookingDetails->room_id);
        $rooms->status = 'ready';
        $rooms->save();

        return redirect()->back()->with('success', 'Rooms successfully cancelled');
    }

    public function export(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ekspor data dengan parameter tanggal
        return Excel::download(new BookingsExport($request->start_date, $request->end_date), 'bookings.xlsx');
    }
}
