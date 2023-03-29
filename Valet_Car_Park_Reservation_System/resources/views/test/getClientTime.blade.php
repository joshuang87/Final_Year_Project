<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @routes()
</head>
<body>
    <h1>Client Choice Time</h1>

    <form id="updateForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
        <label for="parking_lot_id">Current Parking Lot Code :</label>  
        <input type="text" name="parking_lot_id" id="parking_lot_id" value="{{$parkingSpace[0]['parking_lot_id']}}" disabled><br><br>

        <label for="parking_space_id">Your Parking Space Code :</label>
        <input type="text" name="parking_space_id" id="parking_space_id" value="{{$parkingSpace[0]['parking_space_id']}}" disabled><br><br>

        <label for="open_time">Start : </label>
        <input type="datetime-local" step="1" name="open_time" id="open_time"><br><br>

        <label for="close_time">End : </label>
        <input type="datetime-local" step="1" name="close_time" id="close_time">

        <button type="submit">Confirm</button>
    </form>
</body>
</html>

<script>
    function getCurrentClientId(){
        var url = window.location.href.toString()
        var arrUrl = url.split("=")
        var currentClientId = arrUrl[1].split("/")
        

        return currentClientId[0]
    }

    window.onload = function(){
        const clientId = getCurrentClientId()
        const parkingLotId = document.getElementById("parking_lot_id").value
        const parkingSpaceId = document.getElementById("parking_space_id").value

        var form = document.getElementById("updateForm")

        form.action = route('test.storeAllData',[clientId,parkingLotId,parkingSpaceId])

        console.log(route().params);
    }
</script>