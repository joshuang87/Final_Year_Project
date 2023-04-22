<?php

namespace App\Repositories\AdminRepositories;

use App\Models\Reserve;
use App\Repositories\Interfaces\AdminInterfaces\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function getTotalReservation()
    {
        $totalReservation = Reserve::count();

        return $totalReservation;
    }
}

?>