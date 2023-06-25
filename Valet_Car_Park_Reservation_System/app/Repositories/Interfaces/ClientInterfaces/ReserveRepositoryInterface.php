<?php

namespace App\Repositories\Interfaces\ClientInterfaces;

use Illuminate\Http\Request;

interface ReserveRepositoryInterface
{
    public function storeReserveData(array $data);

    public function updateReserveData(array $data,$reserve_id);

}

?>