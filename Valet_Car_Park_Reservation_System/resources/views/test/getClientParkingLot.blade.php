<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Parking Lot</title>
</head>
<body>
    <h1>Client Choice Parking Lot</h1>
    @foreach ( $parkingLots as $parkingLot )
    <a id="parkingLot" href="{{route('test.getParkingLotID',$parkingLot->parking_lot_id)}}">{{$parkingLot->parking_lot_id}}</a><br>    
    @endforeach
</body>
</html>

<script>
    
    function getCurrentClientId(){
        var url = window.location.href.toString()
        var arrUrl = url.split("=")
        var currentClientId = arrUrl[1].split("/")

        return currentClientId[0]
    }

    const clientId = getCurrentClientId()
    

    var parkingLotLink = "{{route('test.getParkingLotID',$parkingLot->parking_lot_id)}}"
    console.log(parkingLotLink);
    
</script>