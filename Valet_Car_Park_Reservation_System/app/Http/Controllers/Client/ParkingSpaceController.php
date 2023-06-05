<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;

class ParkingSpaceController extends Controller
{
    public $parkingSpace;

    public function __construct(ParkingSpaceRepositoryInterface $parkingSpace)
    {
        $this->parkingSpace = $parkingSpace;
    }

    public function showAvailable()
    {
        return view('test.getClientParkingSpace',[
            'parkingSpaces' => $this->parkingSpace->allParkingSpaceData()
        ]);
    }

    public function fetch(){
        
        $all = $this->parkingSpace->allParkingSpaceData();

        return $all;
    }
}
