<?php

namespace App\Http\Controllers\Client;

use Stripe\Stripe;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    
    public function payment(Request $request)
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

        Stripe::setApiKey('sk_test_51MHkNwAAIANGTO9uoqPugwERYm6l3kvVouBqADX5QC4zcKrmQgnN81h1Q7XUYKjxyiZvMgpY8x8wuFiUjY9GnS7j00qYrqwmsU');

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'T-shirt',
                        ],
                        'unit_amount' => 2000,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/client#/',
            'cancel_url' => 'http://127.0.0.1:8000/client#/booking',
        ]);

        return response()->json([
            'sessionId' => $session->id
        ]);
    }

    public function store(Request $request)
    {
        Payment::create([
            'payment_id' => Str::uuid()->toString(),
            'reserve_id' => $request->reserve_id,
            'price' => $request->price
        ]);
    }
}
