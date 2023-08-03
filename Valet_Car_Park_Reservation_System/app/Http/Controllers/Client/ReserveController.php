<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClientInterfaces\CarRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;

class ReserveController extends Controller
{
    public $reserve;
    public $client;
    public $car;

    public function __construct(ReserveRepositoryInterface $reserve,ClientRepositoryInterface $client,CarRepositoryInterface $car)
    {
        $this->reserve = $reserve;
        $this->client = $client;
        $this->car = $car;
    }

    public function booking(Request $request)
    {
        $data = [
            'reserve_id' => $request->reserve_id,
            'car_plate' => $request->car_plate,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'parking_space_id' => $request->parking_space_id,
            'parking_lot_id' => $request->parking_lot_id,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration
        ];

        $this->client->storeClientInfor([
            'car_plate' => $data['car_plate'],
            'phone_number' => $data['phone_number'],
            'reserve_id' => $data['reserve_id']
        ]);

        // get current client id who is making reserve
        $currentClientId = Client::where('car_plate',$data['car_plate'])->first()['client_id'];

        $this->car->storeCarData([
            'car_plate' => $data['car_plate'],
            'phone_number' => $data['phone_number'],
            'reserve_id' => $data['reserve_id'],
            'client_id' => $currentClientId
        ]);

        $reserveData = [
            'reserve_id' => $data['reserve_id'],
            'car_plate' => $request->car_plate,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'parking_space_id' => $request->parking_space_id,
            'parking_lot_id' => $request->parking_lot_id,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration,
            'client_id' => $currentClientId
        ];

        $this->reserve->storeReserveData($reserveData);

        // return response()->json([
        //     'reserve_id' => $data['reserve_id']
        // ]);

        return redirect('http://127.0.0.1:8000/client#/');
    }
}
