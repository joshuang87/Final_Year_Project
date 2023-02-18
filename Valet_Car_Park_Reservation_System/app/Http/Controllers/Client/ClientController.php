<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ReserveRepositoryInterface;
use Illuminate\Http\Request;

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
        // store client data to clients database
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

        return redirect(route('test.inforGetting'));
    }

    public function edit(int $client_id)
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
        // update client data
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

}
