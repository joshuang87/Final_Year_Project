<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parkingSpaceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'start_time',
        'end_time',
        'availability',
        'car_plate',
        'parking_space_id'
    ];
}
