<?php

namespace App\Repositories\Interfaces;

interface ReserveRepositoryInterface
{
    public function storeReserveData(array $data);

    public function updateReserveData(array $data,$reserve_id);

}

?>