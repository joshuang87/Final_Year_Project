<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpaceComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'content',
        'parking_Space_id'
    ];

    public function parkingSpaces()
    {
        return $this->hasMany(ParkingSpace::class);
    }

}
