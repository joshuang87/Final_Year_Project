<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [

        'car_plate',
        'client_id',
        'phone_number'

    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
