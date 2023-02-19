<?php

namespace App\Repositories\ClientRepositories;

use App\Repositories\Interfaces\ClientInterfaces\CarRepositoryInterface;
use App\Models\Car;

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