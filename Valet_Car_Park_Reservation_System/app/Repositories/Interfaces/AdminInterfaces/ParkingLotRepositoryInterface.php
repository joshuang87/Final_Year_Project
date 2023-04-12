<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

interface ParkingLotRepositoryInterface
{
    public function showParkingLots();

    public function showParkingLotDetails($parkingLotId);

    public function storeParkingLot($data);

    public function updateParkingLotInformation($data,$parkingLotId);

    public function deleteParkingLot($parkingLotId);
}

?>