<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add Parking Space</h1>

    <form action="{{route('test.adminStoreParkingSpace')}}" method="POST">
    @csrf

        <label for="parking_space_id">Parking Space ID : </label>
        <input type="text" name="parking_space_id" id="parking_space_id"><br><br>

        <label for="parking_lot_id">Parking Lot ID : </label>
        <select name="parking_lot_id" id="parking_lot_id">
            @foreach ($parkingLots as $parkingLot)
            <option value="{{$parkingLot->parking_lot_id}}">{{$parkingLot->parking_lot_id}}</option>    
            @endforeach
        </select><br><br>

        <button type="submit">Add Parking Space</button>
    </form>

</body>
</html>