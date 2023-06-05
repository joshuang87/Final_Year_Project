<?php

namespace App\Repositories\ClientRepositories;

use App\Models\Client;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\ClientInterfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{

    public function allClientInfor()
    {
        return Client::all();
    }
    
    public function storeClientInfor($data)
    {
        $data = [
            'client_id' => Str::uuid()->toString(),
            'car_plate' => $data['car_plate'],
            'phone_number' => $data['phone_number'],
            'reserve_id' => Str::uuid()->toString()
        ];
        
        return Client::create($data);
    }

    public function findClient($client_id)
    {
        return Client::where('client_id',$client_id)->first();
    }

    public function updateClientData(array $data,$client_id)
    {
        return Client::where('client_id',$client_id)->update($data);
    }

    public function destroyClient($client_id)
    {
        return Client::where('client_id',$client_id)->delete();
    }
}

?>