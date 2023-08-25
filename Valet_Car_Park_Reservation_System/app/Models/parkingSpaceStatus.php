<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parkingSpaceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'start_time',
        'end_time',
        'status',
        'car_plate',
        'parking_space_id',
        'parking_lot_id'
    ];
}
