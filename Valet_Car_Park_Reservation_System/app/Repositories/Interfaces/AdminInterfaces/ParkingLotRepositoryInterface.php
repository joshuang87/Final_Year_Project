<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

interface ParkingLotRepositoryInterface
{

    public function allParkingLotId();

    public function showAvailableParkingLot();

    public function storeParkingLotData($data);

}

?>