<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    use HasFactory;

    protected $fillable = [

        'parking_lot_id',
        'open_time',
        'close_time',
        'status'
        
    ];

    public function parkingSpaces()
    {
        return $this->hasMany(ParkingSpace::class);
    }

}
