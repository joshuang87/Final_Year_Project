<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;

class ParkingLotController extends Controller
{

    public $parkingLot;

    public function __construct(ParkingLotRepositoryInterface $parkingLot)
    {
        $this->parkingLot = $parkingLot;
    }

    public function show()
    {
        
    }

    public function create()
    {
        return view('test.adminAddParkingLot');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'parking_lot_id' => 'required|string|max:255'
        ]);

        $this->parkingLot->storeParkingLotData($data);

        return redirect(route('test.adminHome'));
    }
}
