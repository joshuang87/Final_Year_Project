<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClientInterfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;

class ReserveController extends Controller
{
    public $reserve;
    public $client;

    public function __construct(ReserveRepositoryInterface $reserve,ClientRepositoryInterface $client)
    {
        $this->reserve = $reserve;
        $this->client = $client;
    }

    public function payment()
    { 

        $stripe = new \Stripe\StripeClient(env('pk_test_51NGxNDGmA7QKNFMQAHGPm8IVsFAp2dqD7P5tvURFQCz3iDIAu0kWnOJgZ2mpVGSatoJxAKQRguqFqWC9FxYWOno800PHJXypYc'));

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('api.paymentSuccess',[],true),
            'cancel_url' => 'http://localhost:4242/cancel',
          ]);

          return redirect($checkout_session->url);
    }

    public function success()
    {
        return view('test.paymentSuccess');
    }

    public function booking(Request $request)
    {
        $data = [
            'reserve_id' => Str::uuid()->toString(),
            'car_plate' => $request->car_plate,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'parking_space_id' => $request->parking_space_id,
            'parking_lot_id' => $request->parking_lot_id,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration
        ];

        $this->client->storeClientInfor([
            'car_plate' => $data['car_plate'],
            'phone_number' => $data['phone_number'],
            'reserve_id' => $data['reserve_id']
        ]);

        // get current client id who is making reserve
        $currentClientId = Client::where('car_plate',$data['car_plate'])->first()['client_id'];

        $reserveData = [

            'reserve_id' => $data['reserve_id'],
            'car_plate' => $request->car_plate,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'parking_space_id' => $request->parking_space_id,
            'parking_lot_id' => $request->parking_lot_id,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration,
            'client_id' => $currentClientId

        ];

        $this->reserve->storeReserveData($reserveData);
    }
}
