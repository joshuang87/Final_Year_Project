<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [

        'client_id',
        'phone_number',
        'car_plate',
        'reserve_id'
        
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function parkingSpaces()
    {
        return $this->hasMany(ParkingSpace::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

}
