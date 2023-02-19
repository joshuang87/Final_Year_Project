<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingLot;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;

class ParkingLotRepository implements ParkingLotRepositoryInterface
{

    public function allParkingLotId()
    {
        return ParkingLot::all();    
    }

    public function storeParkingLotData($data)
    {
        return ParkingLot::create($data);
    }
}

?>