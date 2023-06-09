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
    <h1>Client Choice Time</h1>

    <form id="updateForm" enctype="multipart/form-data">
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
        var currentClientId = arrUrl[1].split("/")[0]

        return currentClientId
    }

    $(function(){
        const clientId = getCurrentClientId()
        const parkingLotId = $("#parking_lot_id").val()
        const parkingSpaceId = $("#parking_space_id").val()

        $("#updateForm").attr({
            method: "POST",
            action: route('test.storeAllData',[clientId,parkingLotId,parkingSpaceId])
        })
    })
</script>