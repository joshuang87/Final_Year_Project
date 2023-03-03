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
            @foreach ( as )
            <option value=""></option>    
            @endforeach
        </select>
        <button>Confirm</button>
    </form>
</body>
</html>