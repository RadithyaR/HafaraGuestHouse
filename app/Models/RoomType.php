<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types';
    protected $fillable = [
        'name',
        'price',
        'facility',
        'capacity',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'roomType_id');
    }
}
