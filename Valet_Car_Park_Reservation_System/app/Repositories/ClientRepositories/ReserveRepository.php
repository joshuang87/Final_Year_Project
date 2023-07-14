<?php

namespace App\Repositories\ClientRepositories;

use App\Models\Reserve;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;


class ReserveRepository implements ReserveRepositoryInterface
{

    public function storeReserveData($data)
    {
        // $data = [
        //     'reserve_id' => Str::uuid()->toString(),
        //     'car_plate' => $request->car_plate,
        //     'phone_number' => $request->phone_number,
        //     'email' => $request->email,
        //     'parking_space_id' => $request->parking_space_id,
        //     'parking_lot_id' => $request->parking_lot_id,
        //     'date' => $request->date,
        //     'time' => $request->time,
        //     'duration' => $request->duration
        // ];
        
        return Reserve::create($data);
    }

    public function updateReserveData(array $data,$reserve_id)
    {
        return Reserve::where('reserve_id',$reserve_id)->update($data);
    }
}

?>