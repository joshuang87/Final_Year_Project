<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [

        'phone_number',
        'car_plate',
        
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

}
