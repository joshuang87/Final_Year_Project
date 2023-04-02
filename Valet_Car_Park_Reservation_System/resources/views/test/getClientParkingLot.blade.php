<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Parking Lot</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @routes()
</head>
<body>
    <h1>Client Choice Parking Lot</h1>
    @foreach ( $parkingLots as $parkingLot )
    <a id="parkingLot">{{$parkingLot->parking_lot_id}}</a><br>    
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

    $(function(){
        var links = $("a")
        const clientId = getCurrentClientId()
        for (var i = 0; i < links.length; i++) {
            var parkingLotId = links[i].innerText
            links[i].href = route('test.getParkingLotID',[clientId,parkingLotId])
        }
    })

</script>