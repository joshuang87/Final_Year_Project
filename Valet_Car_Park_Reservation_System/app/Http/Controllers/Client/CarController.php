<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClientInterfaces\CarRepositoryInterface;

class CarController extends Controller
{
    
    public $car;

    public function __construct(CarRepositoryInterface $car)
    {
        $this->car = $car;
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        
    }
}
