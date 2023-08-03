<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [

        'reserve_id',
        'status',
        'price',
        'car_plate',
        'phone_number',
        'email',
        'parking_space_id',
        'parking_lot_id',
        'date',
        'time',
        'duration',
        'client_id'    
              
    ];

}
