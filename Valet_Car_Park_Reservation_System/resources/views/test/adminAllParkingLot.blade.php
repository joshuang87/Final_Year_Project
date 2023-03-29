<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Parking Lot</title>
</head>
<body>
    <h1>All Parking Lot</h1>
    <table border="1">
        <tr>
            <th>Parking Lot ID</th>
            <th>Open Time</th>
            <th>Close Time</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
        @foreach ($parkingLots as $parkingLot)
        <tr>
            <td>{{ $parkingLot->parking_lot_id }}</td>
            <td>{{ $parkingLot->open_time }}</td>
            <td>{{ $parkingLot->close_time }}</td>
            <td class="status">{{ $parkingLot->status }}</td>
            <td>{{ $parkingLot->comment }}</td>
            <td>
                <a href="">Details</a>
                <a href="">Edit</a>   
                <a href="">Delete</a>    
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

<script>
    window.onload = function(){
        var statusArr = document.getElementsByClassName("status")
        for(i = 0; i < statusArr.length; i++){
            var status = statusArr[i].innerText
            if(status == 1){
                document.getElementsByClassName("status")[i].innerText= "Open"
            }
            else{
                document.getElementsByClassName("status")[i].innerText = "Closed"
            }
        }
    }
</script>