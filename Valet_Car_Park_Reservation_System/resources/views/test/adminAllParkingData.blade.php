<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>All Parking Data</h1>
    <table>
        <tr>
            <th>Parking Space ID</th>
            <th>Parking Lot ID</th>
            <th>Open Time</th>
            <th>Close Time</th>
            <th>Car Plate</th>
            <th>Client ID</th>
        </tr>
        @foreach ($parkingSpaces as $parkingSpace)
        <tr>
            <td>{{ $parkingSpace->parking_space_id }}</td>
            <td>{{ $parkingSpace->parking_lot_id }}</td>
            <td>{{ $parkingSpace->open_time }}</td>
            <td>{{ $parkingSpace->close_time }}</td>
            <td>{{ $parkingSpace->car_plate }}</td>
            <td>{{ $parkingSpace->client_id }}</td>
            <td>{{ $parkingSpace->status}}</td>
        @endforeach
    </table><br>
    <button>
        <a href="{{route('test.inforGetting')}}">Reserve</a>
    </button>
    <button>
        <a href="{{route('test.adminHome')}}">Back To Admin Home</a>
    </button>
</body>
</html>