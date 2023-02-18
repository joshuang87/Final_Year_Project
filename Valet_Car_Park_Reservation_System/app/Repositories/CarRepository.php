<?php

namespace App\Repositories;

use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;

class CarRepository implements CarRepositoryInterface
{

    public function allCarData()
    {
        return Car::all();
    }

    public function storeCarData($data)
    {
        return Car::create($data);
    }
}

?>