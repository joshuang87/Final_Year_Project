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

    public function findClient($id)
    {
        return Client::where('client_id',$id)->first();
    }
}

?>