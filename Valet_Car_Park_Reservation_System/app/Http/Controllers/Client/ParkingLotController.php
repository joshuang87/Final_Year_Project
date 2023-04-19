<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;

class ParkingLotController extends Controller
{
    public $parkingLot;
    public $parkingSpace;

    public function __construct(ParkingLotRepositoryInterface $parkingLot, ParkingSpaceRepositoryInterface $parkingSpace)
    {
        $this->parkingLot = $parkingLot;
        $this->parkingSpace = $parkingSpace;
    }
    
    public function showAvailable()
    {
        $allParkingLotId = $this->parkingLot->showParkingLots();

        return view('test.getClientParkingLot')->with('parkingLots',$allParkingLotId);
    }

    public function fetch(){
        $all = $this->parkingLot->showParkingLots();

        return $all;
    }
}
