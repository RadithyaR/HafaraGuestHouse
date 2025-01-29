<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class CheckBookingStatus extends Command
{
    protected $signature = 'check:booking-status';
    protected $description = 'Check bookings that have not been paid within 12 hours and cancel them';

    public function handle()
    {
        $bookings = Booking::where('status', 'booked')
            ->where('booking_time', '<', Carbon::now()->subHours(12))
            ->get();

        foreach ($bookings as $booking) {
            $booking->update(['status' => 'cancelled']);
            $this->info("Booking ID {$booking->id} telah dibatalkan.");
        }

        if ($bookings->isEmpty()) {
            $this->info("Tidak ada booking yang perlu dibatalkan.");
        }

        $this->info("Proses pengecekan selesai.");
    }
}
