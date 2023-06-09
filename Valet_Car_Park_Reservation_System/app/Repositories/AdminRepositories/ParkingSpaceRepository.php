<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingSpace;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;

class ParkingSpaceRepository implements ParkingSpaceRepositoryInterface
{

    public function showParkingSpaces()
    {
        return ParkingSpace::all();
    }

    public function showParkingSpaceDetails($parkingSpaceId)
    {
        
    }

    public function showAvailableParkingSpace()
    {
        
    }

    public function storeParkingSpaceData($data)
    {
        return ParkingSpace::create($data);
    }

}

?>