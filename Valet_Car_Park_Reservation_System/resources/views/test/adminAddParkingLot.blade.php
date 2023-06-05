<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add Parking Lot</h1>

    <form action="{{route('test.adminStoreParkingLot')}}" method="POST">
    @csrf

        <label for="parking_lot_id">Parking Lot ID : </label>
        <input type="text" name="parking_lot_id" id="parking_lot_id"><br><br>

        <button type="submit">Add Parking Lot</button>
    </form>

</body>
</html>