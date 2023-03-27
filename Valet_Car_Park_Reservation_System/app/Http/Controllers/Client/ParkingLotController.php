<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParkingLot;
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
        $allParkingLotId = $this->parkingLot->allParkingLotId();

        return view('test.getClientParkingLot')->with('parkingLots',$allParkingLotId);
    }

    public function fetch(){
        $all = $this->parkingLot->allParkingLotId();

        return $all;
    }
}
