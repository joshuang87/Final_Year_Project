<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpace extends Model
{
    use HasFactory;

    protected $fillable = [

        'parking_space_id',
        'parking_lot_id',
        'open_time',
        'close_time',
        'status',

        'x',
        'y',
        'w',
        'h',
        'i'

    ];

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }
    
}
