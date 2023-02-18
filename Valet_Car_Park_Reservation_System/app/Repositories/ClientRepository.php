<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{

    public function allClientInfor()
    {
        return Client::all();
    }
    
    public function storeClientInfor(array $data)
    {
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