<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Client Choice Parking Space</h1>
    <form action="">
        <select name="parking_lot_id" id="parking_lot_id">
            @foreach ( $parkingLots as $parkingLot )
            <option value="{{$parkingLot->parking_lot_id}}">{{$parkingLot->parking_lot_id}}</option>    
            @endforeach
        </select><br>
        
        <button>Confirm</button>
    </form>
    <?php

        foreach ($parkingLots as $parkingLot) {
            echo $parkingLot->parking_lot_id; // Output the client's name
            echo $parkingLot->parking_space_id;
        }

    ?>
</body>
</html>