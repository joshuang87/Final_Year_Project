<?php

namespace App\Http\Controllers\Client;

use Error;
use App\Models\Client;
use App\Models\Reserve;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\parkingSpaceStatus;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\Interfaces\ClientInterfaces\CarRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;

class ReserveController extends Controller
{
    public $reserve;
    public $client;
    public $car;

    public function __construct(ReserveRepositoryInterface $reserve,ClientRepositoryInterface $client,CarRepositoryInterface $car)
    {
        $this->reserve = $reserve;
        $this->client = $client;
        $this->car = $car;
    }

    // public function booking(Request $request)
    // {
    //     $data = [
    //         'reserve_id' => $request->reserve_id,
    //         'car_plate' => $request->car_plate,
    //         'phone_number' => $request->phone_number,
    //         'email' => $request->email,
    //         'parking_space_id' => $request->parking_space_id,
    //         'parking_lot_id' => $request->parking_lot_id,
    //         'date' => $request->date,
    //         'time' => $request->time,
    //         'duration' => $request->duration
    //     ];

    //     $this->client->storeClientInfor([
    //         'car_plate' => $data['car_plate'],
    //         'phone_number' => $data['phone_number'],
    //         'reserve_id' => $data['reserve_id']
    //     ]);

    //     // get current client id who is making reserve
    //     $currentClientId = Client::where('car_plate',$data['car_plate'])->first()['client_id'];

    //     $this->car->storeCarData([
    //         'car_plate' => $data['car_plate'],
    //         'phone_number' => $data['phone_number'],
    //         'reserve_id' => $data['reserve_id'],
    //         'client_id' => $currentClientId
    //     ]);

    //     $reserveData = [
    //         'reserve_id' => $data['reserve_id'],
    //         'car_plate' => $request->car_plate,
    //         'phone_number' => $request->phone_number,
    //         'email' => $request->email,
    //         'parking_space_id' => $request->parking_space_id,
    //         'parking_lot_id' => $request->parking_lot_id,
    //         'date' => $request->date,
    //         'time' => $request->time,
    //         'duration' => $request->duration,
    //         'client_id' => $currentClientId
    //     ];

    //     $this->reserve->storeReserveData($reserveData);

    //     // return response()->json([
    //     //     'reserve_id' => $data['reserve_id']
    //     // ]);

    //     return redirect('http://127.0.0.1:8000/client#/');
    // }

    public function checkout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $lineItems = [
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
        ];
        
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('api.reserve.success',[],true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('api.reserve.cancel',[],true),
        ]);

        $data = [
            'reserve_id' => $checkout_session->id,
            // 'price' =>,
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

        $this->car->storeCarData([
            'car_plate' => $data['car_plate'],
            'phone_number' => $data['phone_number'],
            'reserve_id' => $data['reserve_id'],
            'client_id' => $currentClientId
        ]);

        $reserveData = [
            'reserve_id' => $data['reserve_id'],
            'status' => 'unpaid',
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

        // return redirect($checkout_session->url);
        return response()->json([
            'sessionId' => $checkout_session->id
        ]);
    }

    public  function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        
        $checkout_session_id = $request->get('session_id');

        // dd($checkout_session_id);

        try
        {
            $session = $stripe->checkout->sessions->retrieve($checkout_session_id);
            // dd($session);
            $customer = $session->customer_details;
            // $customerName = $customer['name'];
            echo "<h1>Thanks for your order, $customer->name!</h1>";
            http_response_code(200);

            $reserve = Reserve::where('reserve_id',$session->id)->first();
            if(!$reserve)
            {
                throw new NotFoundHttpException();
            }

            if($reserve && $reserve->status === 'unpaid')
                {
                    Reserve::where('reserve_id',$session->id)->update([
                        'status' => 'paid'
                    ]);
                    //  send email
                }
            
            return redirect('http://127.0.0.1:8000/client#/');
        }
        catch(Error $e)
        {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

    }

    public function cancel()
    {

    }

    public function webhook()
    {
        // The library needs to be configured with your account's secret key.
        // Ensure the key is kept out of any version control system you might be using.
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try
        {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        }
        catch(\UnexpectedValueException $e)
        {
            // Invalid payload
            // http_response_code(400);
            // exit();
            return response($e,400);
        }
        catch(\Stripe\Exception\SignatureVerificationException $e)
        {
            // Invalid signature
            // http_response_code(400);
            // exit();
            return response($e,400);
        }

        // Handle the event
        switch ($event->type)
        {
            case 'checkout.session.completed':
                $session = $event->data->object;
                // $sessionId = $session->id;

                $reserve = Reserve::where('reserve_id',$session->id)->first();
                if($reserve && $reserve->status === 'unpaid')
                {
                    $reserve->status = 'paid';
                    $reserve->save();
                    //  send email
                }
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        // http_response_code(200);
        return response('',200);
    }

    public function booking(Request $request)
    {
        $data = $request->all();

        parkingSpaceStatus::create($data);

        return response("GOOD",200);
    }
}
