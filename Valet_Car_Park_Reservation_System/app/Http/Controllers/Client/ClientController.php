<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\IClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public $client;

    public function __construct(IClientRepository $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        return view('prototype (backend).index');
    }

    public function create()
    {
        return view('prototype (backend).clientInforGetting');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'car_plate' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255'

        ]);

        $this->client->inforUpload($data);

        return redirect(route('test.inforGetting'));
    }
}
