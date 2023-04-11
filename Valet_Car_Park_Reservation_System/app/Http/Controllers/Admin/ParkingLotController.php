<?php

namespace App\Http\Controllers\Admin;

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

    public function show()
    {
        return view('test.adminAllParkingLot')->with('parkingLots',$this->parkingLot->showParkingLots());
    }

    public function create()
    {
        return view('test.adminAddParkingLot');
    }

    public function edit($parkingLotId)
    {
        return view('test.adminParkingLotEdit')->with('parkingLot',$this->parkingLot->showParkingLots($parkingLotId));
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

        return redirect(route('test.adminAllParkingLot'));
    }

    public function update(Request $request,$parkingLotId)
    {
        $oldData = ParkingLot::where('parking_lot_id',$parkingLotId)->first();

        if($request->comment === null)
        {
            $errors = "NOT COMMENT";
            return $errors;
        }
        elseif($request->has('comment') && $oldData->parking_lot_id == $request->parking_lot_id && $oldData->status == $request->status && $oldData->open_time == $request->open_time && $oldData->close_time == $request->close_time)
        {
            dd("UNNECESSARY COMMENT");
        }
        else
        {
            $data = $request->validate([
                'comment' => 'required|string',
                'parking_lot_id' => 'required|string',
                'status' => 'required',
                'open_time' => 'required',
                'close_time' => 'required'
    
            ]);

            $this->parkingLot->updateParkingLotInformation($data,$parkingLotId);
        }   
            
        return redirect(route('test.adminAllParkingLot'));
    }

    public function detail($parkingLotId)
    {
        return view('test.adminParkingLotDetail')->with('parkingLot',$this->parkingLot->showParkingLots($parkingLotId));
    }
}
