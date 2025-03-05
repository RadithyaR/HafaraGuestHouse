<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $fillable = [
        'room_number',
        'roomType_id',
        'status'
    ];

    public function roomTypes(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'roomType_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_detail');
    //     ->withPivot('jumlah_kamar')
    //     ->withTimestamps();
    }

}
