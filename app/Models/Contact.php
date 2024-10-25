<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $keyType ='integer';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'user_id'
    ];
}
