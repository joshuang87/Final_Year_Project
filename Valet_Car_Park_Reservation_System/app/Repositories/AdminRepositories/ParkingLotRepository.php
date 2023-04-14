<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingLot;
use Illuminate\Http\Request;
use App\Models\ParkingLotComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;

class ParkingLotRepository implements ParkingLotRepositoryInterface
{

    public function showParkingLots()
    {
        $parkingLotsData = DB::table('parking_lots')
                            ->leftJoin('parking_lot_comments', function (JoinClause $join) {
                                $join->on('parking_lots.parking_lot_id', '=', 'parking_lot_comments.parking_lot_id')
                                    // Let The Comment Part Always Display Latest Comment
                                    ->whereRaw('parking_lot_comments.created_at = (SELECT MAX(created_at) FROM parking_lot_comments WHERE parking_lot_id = parking_lots.parking_lot_id)');
                            })
                            ->select('parking_lots.*', 'parking_lot_comments.content')
                            ->orderBy('created_at','asc')
                            ->orderBy('parking_lot_id','asc')
                            ->get();

        return $parkingLotsData;
    }

    public function showParkingLotDetails($parkingLotId)
    {
        $dataWithComments = DB::table('parking_lots')
                                    ->leftJoin('parking_lot_comments','parking_lots.parking_lot_id', '=', 'parking_lot_comments.parking_lot_id')
                                    ->select('parking_lots.*','parking_lot_comments.content','parking_lot_comments.created_at')
                                    ->where('parking_lots.parking_lot_id',$parkingLotId)
                                    ->get();

        $dataWithParkingSpaces = DB::table('parking_lots')
                                        ->leftJoin('parking_spaces','parking_lots.parking_lot_id', '=', 'parking_spaces.parking_lot_id')
                                        ->select('parking_lots.*','parking_spaces.parking_space_id')
                                        ->where('parking_lots.parking_lot_id',$parkingLotId)
                                        ->get();

        $parkingLotDetailsData = [
            $dataWithParkingSpaces,
            $dataWithComments
        ];

        return $parkingLotDetailsData;
    }

    public function storeParkingLot($data)
    {
        $data = $data->validate([
            'parking_lot_id' => 'required|string|max:255'
        ]);

        return ParkingLot::create($data);
    }

    public function updateParkingLotInformation(Request $data,$parkingLotId)
    {
        $oldData = ParkingLot::where('parking_lot_id',$parkingLotId)->first();

        if($data->comment === null)
        {
            $errors = "NOT COMMENT";
            return $errors;
        }
        elseif($data->has('comment') && $oldData->parking_lot_id == $data->parking_lot_id && $oldData->status == $data->status && $oldData->open_time == $data->open_time && $oldData->close_time == $data->close_time)
        {
            dd("UNNECESSARY COMMENT");
        }
        else
        {
            $data = $data->validate([
                'comment' => 'required|string',
                'parking_lot_id' => 'required|string',
                'status' => 'required',
                'open_time' => 'required',
                'close_time' => 'required'
    
            ]);

            $parkingLotData = [
                'parking_lot_id' => $data['parking_lot_id'],
                'status' => $data['status'],
                'open_time' => $data['open_time'],
                'close_time' => $data['close_time']
            ];
    
            ParkingLot::where('parking_lot_id',$parkingLotId)->update($parkingLotData);
    
            $commentData = [
                'content' => $data['comment'],
                'parking_lot_id' => $data['parking_lot_id']
            ];
    
            ParkingLotComment::create($commentData);
        }  
    }

    public function deleteParkingLot($parkingLotId)
    {
        return ParkingLot::where('parking_lot_id',$parkingLotId)->delete();
    }
}

?>