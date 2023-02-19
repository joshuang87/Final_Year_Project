<?php

namespace App\Repositories\ClientRepositories;

use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;
use App\Models\Reserve;

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