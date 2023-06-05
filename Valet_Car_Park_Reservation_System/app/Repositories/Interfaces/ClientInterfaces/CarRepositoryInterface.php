<?php

namespace App\Repositories\Interfaces\ClientInterfaces;

interface CarRepositoryInterface
{

    public function allCarData();

    public function storeCarData(array $data);

    // public function findCar($id);

    public function updateCartData(array $data,$car_plate);

    // public function destroyCar($id);

}

?>