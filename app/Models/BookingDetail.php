<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table = 'booking_detail';

    protected $fillable = [
        'id',
        'room_id',
        'booking_id'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
