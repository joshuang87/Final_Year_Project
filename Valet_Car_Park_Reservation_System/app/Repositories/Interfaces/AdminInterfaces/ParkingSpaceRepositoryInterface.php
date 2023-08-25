<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

use Illuminate\Http\Request;

interface ParkingSpaceRepositoryInterface
{

    public function showParkingSpaces();

    public function showParkingSpaceDetails($parkingSpaceId);

    public function showAvailableParkingSpace();

    public function storeParkingSpaceData($data);

    // public function updateParkingSpaceData(string $parkingSpaceId,Request $data);

}

?>