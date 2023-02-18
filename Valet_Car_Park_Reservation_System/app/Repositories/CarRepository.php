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

    public function storeCarData(array $data)
    {
        return Car::create($data);
    }

    public function updateCartData(array $data,$car_plate)
    {
        return Car::where('car_plate',$car_plate)->update($data);
    }
}

?>