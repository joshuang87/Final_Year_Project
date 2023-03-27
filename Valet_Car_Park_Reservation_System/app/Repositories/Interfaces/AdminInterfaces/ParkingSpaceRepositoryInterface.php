<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

interface ParkingSpaceRepositoryInterface
{

    public function allParkingSpaceData();

    public function showAvailableParkingSpace();

    public function storeParkingSpaceData($data);

}

?>