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
        return view('test.adminAllParkingLot')->with('parkingLots',$this->parkingLot->showParkingLots());
    }

    public function create()
    {
        return view('test.adminAddParkingLot');
    }

    public function edit(string $parkingLotId)
    {
        return view('test.adminParkingLotEdit')->with('parkingLot',$this->parkingLot->showParkingLotDetails($parkingLotId));
    }

    public function store(Request $request)
    {
        $this->parkingLot->storeParkingLot($request);

        // return redirect(route('test.adminHome'));
        return response('Parking Lot Added',200);
    }

    public function destroy($parkingLotId)
    {
        $this->parkingLot->deleteParkingLot($parkingLotId);

        return redirect(route('test.adminAllParkingLot'));
    }

    public function update(Request $request,$parkingLotId)
    {
        $this->parkingLot->updateParkingLotInformation($request,$parkingLotId);
            
        return redirect(route('test.adminAllParkingLot'));
    }

    public function detail($parkingLotId)
    {
        return view('test.adminParkingLotDetail')->with('parkingLot',$this->parkingLot->showParkingLots($parkingLotId));
    }
}
