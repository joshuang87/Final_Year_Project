<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements IClientRepository
{

    public function getClientInfor()
    {

    }
    
    public function inforUpload($data)
    {
        return Client::create($data);
    }
}

?>