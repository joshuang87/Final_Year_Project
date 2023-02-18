<?php

namespace App\Repositories;

use App\Models\Reserve;
use App\Repositories\Interfaces\ReserveRepositoryInterface;

class ReserveRepository implements ReserveRepositoryInterface
{

    public function storeReserveData(array $data)
    {
        return Reserve::create($data);
    }

    public function updateReserveData(array $data,$reserve_id)
    {
        return Reserve::where('reserve_id',$reserve_id)->update($data);
    }
}

?>