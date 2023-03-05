<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingLot;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;

class ParkingLotRepository implements ParkingLotRepositoryInterface
{

    public function allParkingLotId()
    {
        $all = DB::table('parking_lots')->leftjoin('parking_spaces','parking_spaces.parking_lot_id','=','parking_lots.parking_lot_id')
                                        ->get();
        
        return $all;
    }

    public function storeParkingLotData($data)
    {
        return ParkingLot::create($data);
    }
}

?>