<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [

        'reserve_id',
        'price',
        'phone_number',
        'car_plate',
        'client_id',
        'parking_lot_id',
        'parking_space_id',
        'time',
        'date',
        'duration',
        'email'

    ];

}
