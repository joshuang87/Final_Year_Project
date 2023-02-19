<?php

namespace App\Repositories\Interfaces\ClientInterfaces;

interface ClientRepositoryInterface
{

    public function allClientInfor();

    public function storeClientInfor(array $data);

    public function findClient($client_id);

    public function updateClientData(array $data,$client_id);

    public function destroyClient($client_id);

}

?>