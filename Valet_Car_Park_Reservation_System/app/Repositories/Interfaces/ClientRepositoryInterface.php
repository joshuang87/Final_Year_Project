<?php

namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface
{

    public function allClientInfor();

    public function storeClientInfor(array $data);

    public function findClient($id);

    public function updateClientData(array $data,$id);

    // public function destroyClient($id);

}

?>