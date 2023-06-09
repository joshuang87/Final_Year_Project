<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReserveController extends Controller
{
    
    public function payment()
    {

        $stripe = new \Stripe\StripeClient(env('sk_test_51MHkNwAAIANGTO9uoqPugwERYm6l3kvVouBqADX5QC4zcKrmQgnN81h1Q7XUYKjxyiZvMgpY8x8wuFiUjY9GnS7j00qYrqwmsU'));

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
}
