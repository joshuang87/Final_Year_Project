<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingLot;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;

class ParkingLotRepository implements ParkingLotRepositoryInterface
{

    public function showAllParkingLot()
    {
        $allParkingLot = ParkingLot::all();

        return $allParkingLot;
    }

    public function storeParkingLot($data)
    {
        return ParkingLot::create($data);
    }

    public function updateParkingLotInformation($data,$parkingLotId)
    {
        return ParkingLot::where('parking_lot_id',$parkingLotId)->update($data);
    }

    public function deleteParkingLot($parkingLotId)
    {
        return ParkingLot::where('parking_lot_id',$parkingLotId)->delete();
    }
}

?>