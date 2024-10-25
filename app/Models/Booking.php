<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';

    protected $fillable = [
        'user_id',
        'checkin_date',
        'checkout_date',
        'status',
        'total_price',
        'remarks',
        'fine_price'
    ];

    // Model DetailBooking
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'booking_detail')
            ->withPivot('jumlah_kamar')
            ->withTimestamps();
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function bookingDetail(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
