<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParkingLot;
use App\Models\ParkingSpace;
use App\Repositories\Interfaces\ClientInterfaces\CarRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;
use DateTime;

class ClientController extends Controller
{
    
    public $client;
    public $car;
    public $reserve;

    public function __construct(ClientRepositoryInterface $client,CarRepositoryInterface $car,ReserveRepositoryInterface $reserve)
    {
        $this->client = $client;
        $this->car = $car;
        $this->reserve = $reserve;
    }

    public function index()
    {
        return view('test.index');
    }

    public function showAll()
    {
        return view('test.allClientInfor',[

            'clients' => $this->client->allClientInfor()
            
        ]);
    }

    public function create()
    {
        return view('test.clientInforGetting');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'car_plate' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255'

        ]);
        // pass client segment data
        $this->client->storeClientInfor($data);
        // get current client id who is making reserve
        $currentClientId = Client::where('car_plate',$data['car_plate'])->first()['client_id'];
        $currentClientReserveId = Client::where('car_plate',$data['car_plate'])->first()['reserve_id'];
        // store client"s car data to cars database
        $this->car->storeCarData([

            'car_plate' => $data['car_plate'],
            'phone_number' => $data['phone_number'],
            'client_id' => $currentClientId,
            'reserve_id' => $currentClientReserveId

        ]);
        // store reserve data to reserves database
        $this->reserve->storeReserveData([

            'reserve_id' => $currentClientReserveId,
            'phone_number' => $data['phone_number'],
            'car_plate' => $data['car_plate'],
            'client_id' => $currentClientId

        ]);

        return redirect(route('test.showAvailableParkingLot',$currentClientId));
    }

    public function edit(string $client_id)
    {
        return view('test.editClientInfor',[

            'client' => $this->client->findClient($client_id)

        ]);
    }

    public function update(Request $request,int $client_id)
    {
        $currentClientCarPlate = Client::where('client_id',$client_id)->first()['car_plate'];
        $clientReserveId = Client::where('client_id',$client_id)->first()['reserve_id'];
        $data = $request->validate([

            'car_plate' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255'

        ]);
        // update client data to clients table
        $this->client->updateClientData($data,$client_id);

        $this->car->updateCartData($data,$currentClientCarPlate);

        $this->reserve->updateReserveData($data,$clientReserveId);

        return redirect(route('test.showAll'));
    }

    public function destroy($client_id)
    {
        $this->client->destroyClient($client_id);

        return redirect(route('test.showAll'));
    }

    public function getParkLID($clientId,$parkingLotId)
    {

        $parkingSpaces = ParkingSpace::where('parking_lot_id',$parkingLotId)->get();

        return view('test.getClientParkingSpace')->with('parkingSpaces',$parkingSpaces);

        // return dd($parkingSpaces);
    }

    public function getParkSID($clientId,$parkingLotId,$parkingSpaceId)
    {

        $parkingSpace = ParkingSpace::where('parking_space_id',$parkingSpaceId)->get();

        return view('test.getClientTime')->with('parkingSpace',$parkingSpace);
    }

    public function storeAllData(Request $request,$clientId,$parkingLotId,$parkingSpaceId)
    {
        $data = $request->validate([

            'open_time' => 'required|string|max:255',
            'close_time' => 'required|string|max:255'

        ]);

        $carPlate = Client::where('client_id',$clientId)->first()['car_plate'];

        $newData = [
            'open_time' => $data['open_time'],
            'close_time' => $data['close_time'],
            'car_plate' => $carPlate,
            'client_id' => $clientId
        ];

        ParkingSpace::where('parking_space_id',$parkingSpaceId)->update($newData);
        
    }
}
