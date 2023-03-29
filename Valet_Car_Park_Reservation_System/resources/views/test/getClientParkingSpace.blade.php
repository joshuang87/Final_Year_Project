<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @routes
</head>
<body>
    <h1>Choose Parking Space</h1>
    <h2>Current Parking Lot : {{$parkingSpaces[0]['parking_lot_id']}}</h2>
    @foreach ($parkingSpaces as $parkingSpace)
        <a>{{ $parkingSpace->parking_space_id }}</a><br>
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

    function getCurrentParkingLotId(){
        var url = window.location.href.toString()
        var arrUrl = url.split("=")
        var currentParkingLotId = arrUrl[2].split("/")
        
        return currentParkingLotId[0]
    }

    window.onload = function(){
        var links = document.getElementsByTagName("a")
        const clientId = getCurrentClientId()
        const parkingLotId = getCurrentParkingLotId()
        for (var i = 0; i < links.length; i++) {
            var parkingSpaceId = links[i].innerText
            links[i].href = route('test.getParkingSpaceID',[clientId,parkingLotId,parkingSpaceId])
            console.log(links[i]);
        }
    }

</script>