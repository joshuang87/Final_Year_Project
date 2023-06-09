<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLotComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'content',
        'parking_lot_id'
    ];

    public function parkingLots()
    {
        return $this->hasMany(ParkingLot::class);
    }
}
