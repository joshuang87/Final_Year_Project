<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- JQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @routes()
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
        var currentClientId = arrUrl[1].split("/")[0]
        
        return currentClientId
    }

    function getCurrentParkingLotId(){
        var url = window.location.href.toString()
        var arrUrl = url.split("=")
        var currentParkingLotId = arrUrl[2].split("/")[0]
        
        return currentParkingLotId
    }

    $(function(){
        var parkingSpaceLinks = $("a")
        const clientId = getCurrentClientId()
        const parkingLotId = getCurrentParkingLotId()
        for (var i = 0; i < parkingSpaceLinks.length; i++) {
            var parkingSpaceId = parkingSpaceLinks[i].innerText
            parkingSpaceLinks[i].href = route('test.getParkingSpaceID',[clientId,parkingLotId,parkingSpaceId])
        }
    })

</script>