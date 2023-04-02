<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

interface ParkingLotRepositoryInterface
{
    public function showParkingLot($parkingLotId = null);

    public function storeParkingLot($data);

    public function updateParkingLotInformation($data,$parkingLotId);

    public function deleteParkingLot($parkingLotId);
}

?>