<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>All Parking Spaces</h1>
    <table border="1">
        <tr>
            <th>Parking Space ID</th>
            <th>Open Time</th>
            <th>Close Time</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
        @foreach ($parkingLots as $parkingLot)
        <tr>
            <td class="parking_lot_id">{{ $parkingLot->parking_lot_id }}</td>
            <td>{{ $parkingLot->open_time }}</td>
            <td>{{ $parkingLot->close_time }}</td>
            <td class="status">{{ $parkingLot->status }}</td>
            <td>{{ $parkingLot->content }}</td>
            <td>
                <form action="{{route('test.adminDeleteParkingLot',$parkingLot->parking_lot_id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="details" href="{{route('test.adminParkingLotDetail',$parkingLot->parking_lot_id)}}">Details</a>
                    <a class="edit" href="{{route('test.adminEditParkingLot',$parkingLot->parking_lot_id)}}">Edit</a> 
                    <button type="submit">Delete</button>
                </form>  
            </td>
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