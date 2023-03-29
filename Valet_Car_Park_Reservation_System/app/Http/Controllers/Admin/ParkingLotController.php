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
        return view('test.adminAllParkingLot')->with('parkingLots',$this->parkingLot->showAllParkingLot());
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

        $this->parkingLot->storeParkingLot($data);

        return redirect(route('test.adminHome'));
    }

    public function destroy($parkingLotId)
    {
        $this->parkingLot->deleteParkingLot($parkingLotId);

        return redirect(route('test.adminAllParkingData'));
    }
}
