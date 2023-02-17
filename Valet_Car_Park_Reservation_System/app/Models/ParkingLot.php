<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    use HasFactory;

    protected $fillable = [

        'parking_space_id',
        'open_time',
        'close_time'
        
    ];

}
