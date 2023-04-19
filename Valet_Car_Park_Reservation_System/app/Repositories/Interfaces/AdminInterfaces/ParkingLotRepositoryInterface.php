<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

use Illuminate\Http\Request;

interface ParkingLotRepositoryInterface
{
    public function showParkingLots();

    public function showParkingLotDetails($parkingLotId);

    public function storeParkingLot($data);

    public function updateParkingLotInformation($parkingLotId,Request $request);

    public function deleteParkingLot($parkingLotId);
}

?>