<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'roomType_id',
        'checkin_date',
        'checkout_date',
        'jumlah_kamar',
        'is_additional_bed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to RoomType
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'roomType_id');
    }
}
