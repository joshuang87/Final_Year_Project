<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Payment Process</h1>

    <h3>Reserve ID : {{ $reserveData[0]['reserve_id'] }}</h3>
    <h3>Client ID : {{ $reserveData[0]['client_id'] }}</h3>
    <h3>Phone Number : {{ $reserveData[0]['phone_number'] }}</h3>
    <h3>Car Plate : {{ $reserveData[0]['car_plate'] }}</h3>

    <form action="{{route('api.makePayment')}}" method="POST">
        <button>Pay</button>
    </form>
</body>
</html>