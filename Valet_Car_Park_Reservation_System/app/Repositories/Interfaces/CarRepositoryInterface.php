<?php

namespace App\Repositories\Interfaces;

interface CarRepositoryInterface
{

    public function allCarData();

    public function storeCarData(array $data);

    // public function findCar($id);

    // public function updateCartData($data,$id);

    // public function destroyCar($id);

}

?>