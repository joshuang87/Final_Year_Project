<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;
use Illuminate\Http\Request;

class ParkingSpaceController extends Controller
{
    public $parkingLot;
    public $parkingSpace;

    public function __construct(ParkingLotRepositoryInterface $parkingLot,ParkingSpaceRepositoryInterface $parkingSpace)
    {
        $this->parkingLot = $parkingLot;
        $this->parkingSpace = $parkingSpace;
    }
    public function create()
    {
        return view('test.adminAddParkingSpace',[
            'parkingLots' => $this->parkingLot->showAllParkingLot()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'parking_space_id' => 'required|string|max:255',
            'parking_lot_id' => 'required|string|max:255'
        ]);

        $this->parkingSpace->storeParkingSpaceData($data);

        return redirect(route('test.adminHome'));
    }

    public function show()
    {
        return view('test.adminAllParkingData',[
            'parkingSpaces' => $this->parkingLot->showAllParkingLot()
        ]);
    }
}
