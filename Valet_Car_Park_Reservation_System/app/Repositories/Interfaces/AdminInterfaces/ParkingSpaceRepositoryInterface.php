<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

interface ParkingSpaceRepositoryInterface
{

    public function showParkingSpaces();

    public function showParkingSpaceDetails($parkingSpaceId);

    public function showAvailableParkingSpace();

    public function storeParkingSpaceData($data);

}

?>