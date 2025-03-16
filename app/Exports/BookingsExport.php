<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    // Konstruktor untuk menerima parameter filter tanggal
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    // Query untuk mendapatkan data berdasarkan rentang tanggal
    public function query()
    {
        return Booking::query()
            ->whereBetween('checkin_date', [$this->startDate, $this->endDate])
            ->with('user', 'payment', 'bookingDetail.room.roomTypes');
    }

    // Definisikan header kolom di file Excel
    public function headings(): array
    {
        return [
            'Booking ID', 'User Name', 'Check-in', 'Check-out','Extra Bed', 'Total Price', 'Fine Price', 'Total', 'Created At'
        ];
    }

    // Map setiap row data ke dalam kolom Excel
    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->user->name,
            $booking->checkin_date,
            $booking->checkout_date,
            $booking->is_additional_bed ? 'Ya' : 'Tidak',
            $booking->total_price,
            $booking->fine_price ?? '-',
            $booking->total_price + $booking->fine_price,
            $booking->created_at->format('d F Y'),
        ];
    }
}
