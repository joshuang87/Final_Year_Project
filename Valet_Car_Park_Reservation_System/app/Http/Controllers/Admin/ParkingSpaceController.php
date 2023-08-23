<?php

namespace App\Http\Controllers\Admin;

use App\Models\ParkingSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;

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
            'parkingLots' => $this->parkingLot->showParkingLots()
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
            'parkingSpaces' => $this->parkingLot->showParkingLots()
        ]);
    }
 
    public function getLayout($parkingLotId)
    {   
        // return DB::table('parking_spaces')->where('parking_lot_id', $parkingLotId)
        //                                     ->get(['x', 'y', 'w', 'h', 'i'])
        //                                     ->map(function ($parkingSpace) {
        //                                         return (array) $parkingSpace; // Convert to associative array
        //                                     });

        return ParkingSpace::all();
        // dd(ParkingSpace::all());
    
    }

    public function updateLayout(Request $request)
    {
        $data = $request->all();

        $count = 0;
        foreach($data as $parkingSpace)
        {
            $x = $data[$count]['x'];
            $y = $data[$count]['y'];
            $w = $data[$count]['w'];
            $h = $data[$count]['h'];

            $oldLayout = DB::table('parking_spaces')->where('parking_space_id',$parkingSpace['parking_space_id'])->first();

            if($oldLayout->x != $x || $oldLayout->y != $y || $oldLayout->w != $w || $oldLayout->h != $h)
            {
                $newLayout = [
                    'x' => $x,
                    'y' => $y,
                    'w' => $w,
                    'h' => $h
                ];

                ParkingSpace::where('parking_space_id',$parkingSpace['parking_space_id'])->update($newLayout);
            }
            $count++;
        }

        return "GOOD";
    }
}
