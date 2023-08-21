<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingSpace;
use App\Models\ParkingSpaceComment;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;

class ParkingSpaceRepository implements ParkingSpaceRepositoryInterface
{

    public function showParkingSpaces()
    {
        return ParkingSpace::all();
    }

    public function showParkingSpaceDetails($parkingSpaceId)
    {
        return ParkingSpace::where('parking_space_id',$parkingSpaceId)->first();
    }

    public function showAvailableParkingSpace()
    {
        
    }

    public function storeParkingSpaceData($data)
    {
        return ParkingSpace::create($data);
    }

    // public function updateParkingSpaceData($parkingSpaceId,Request $data)
    // {
    //     $oldData = ParkingLot::where('parking_lot_id',$parkingLotId)->first();

    //     if($data->content === null)
    //     {
    //         return response("NOT COMMENT",406);
    //     }
    //     elseif($data->has('comment') && $oldData->parking_lot_id == $data->parking_lot_id && $oldData->status == $data->status && $oldData->open_time == $data->open_time && $oldData->close_time == $data->close_time)
    //     {
    //         return response("UNNECESSARY COMMENT",406);
    //     }
    //     else
    //     {
    //         $data = $data->validate([
    //             'content' => 'required|string',
    //             'parking_lot_id' => 'required|string',
    //             'status' => 'required',
    //             'open_time' => 'required',
    //             'close_time' => 'required'
    
    //         ]);

    //         $parkingLotData = [
    //             'parking_lot_id' => $data['parking_lot_id'],
    //             'status' => $data['status'],
    //             'open_time' => $data['open_time'],
    //             'close_time' => $data['close_time']
    //         ];
    
    //         ParkingLot::where('parking_lot_id',$parkingLotId)->update($parkingLotData);
    
    //         $commentData = [
    //             'content' => $data['content'],
    //             'parking_lot_id' => $data['parking_lot_id']
    //         ];
    
    //         ParkingSpaceComment::create($commentData);

    //         return response('DATA UPDATED',200);
    //     }  
    // }

}

?>