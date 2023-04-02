<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Parking Lot</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @routes()
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
            <td class="parking_lot_id">{{ $parkingLot->parking_lot_id }}</td>
            <td>{{ $parkingLot->open_time }}</td>
            <td>{{ $parkingLot->close_time }}</td>
            <td class="status">{{ $parkingLot->status }}</td>
            <td>{{ $parkingLot->content }}</td>
            <td>
                <a class="details" href="{{route('test.adminParkingLotDetail',$parkingLot->parking_lot_id)}}">Details</a>
                <a class="edit" href="{{route('test.adminEditParkingLot',$parkingLot->parking_lot_id)}}">Edit</a>   
                <a class="delete" href="{{route('test.adminDeleteParkingLot',$parkingLot->parking_lot_id)}}">Delete</a>    
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
    $(function(){
        var statusArr = $(".status")
        for(i = 0; i < statusArr.length; i++){
            var status = statusArr[i].innerText
            if(status == 1){
                $(".status")[i].innerText= "Open"
            }
            else{
                $(".status")[i].innerText = "Closed"
            }
        }
    })

    // $(function(){
    //     var parkingLotArr = $(".parking_lot_id")
    //     for(i = 0; i < parkingLotArr.length; i++){
    //         var parkingLotId = parkingLotArr[i].innerText
    //         $(".delete").attr({
    //             method: "POST",
    //             href: route('test.adminDeleteParkingLot',[parkingLotId])
    //         })
    //     }
    // })
</script>