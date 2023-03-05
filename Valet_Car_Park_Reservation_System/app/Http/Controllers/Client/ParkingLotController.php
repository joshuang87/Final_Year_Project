<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParkingLot;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;

class ParkingLotController extends Controller
{
    public $parkingLot;

    public function __construct(ParkingLotRepositoryInterface $parkingLot)
    {
        $this->parkingLot = $parkingLot;
    }
    
    public function showAvailable()
    {
        $all = $this->parkingLot->allParkingLotId();

        return view('test.getClientParkingSpace')->with('parkingLots',$all);
    }
}
