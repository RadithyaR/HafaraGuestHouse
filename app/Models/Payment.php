<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';

    protected $fillable = [
        'booking_id',
        'user_id',
        'payment_method',
        'xendit_invoice_id',
        'status',
        'expired_at',
        'external_id'
    ];

    // Relasi ke model Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Cek pembayaran kadaluarsa
    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expired_at);
    }

    // Relasi ke model Payment
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    
}
