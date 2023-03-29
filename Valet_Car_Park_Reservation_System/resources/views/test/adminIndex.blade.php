<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources\css\app.css'])
</head>
<body>

    <h1>Admin Home</h1>
    <button>
        <a href="{{route('test.adminAddParkingLot')}}">Add Parking Lot</a>
    </button>
    <button>
        <a href="{{route('test.adminAddParkingSpace')}}">Add Parking Space</a>
    </button>
    <button>
        <a href="{{route('test.adminAllParkingLot')}}">All Parking Lot</a>
    </button>
    <?php
    use Carbon\Carbon;
        // get current time where timezone is China
        $current = Carbon::now()->timezone('PRC');

        $time = $current->format('h:i:s A');

        echo "$time";
    ?>
</body>
</html>