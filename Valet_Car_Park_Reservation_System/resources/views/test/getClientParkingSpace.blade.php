<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Choose Parking Space</h1>
    <h2>Current Parking Lot : {{$parkingSpaces[0]['parking_lot_id']}}</h2>
    @foreach ($parkingSpaces as $parkingSpace)
        <a href="{{route('test.getParkingSpaceID',[$parkingSpace->parking_lot_id,$parkingSpace->parking_space_id])}}">{{ $parkingSpace->parking_space_id }}</a><br>
    @endforeach
</body>
</html>