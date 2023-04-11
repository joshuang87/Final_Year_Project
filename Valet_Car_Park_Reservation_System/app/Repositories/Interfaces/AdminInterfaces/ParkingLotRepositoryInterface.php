<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

interface ParkingLotRepositoryInterface
{
    public function showParkingLots($parkingLotId = null);

    public function storeParkingLot($data);

    public function updateParkingLotInformation($data,$parkingLotId);

    public function deleteParkingLot($parkingLotId);
}

?>