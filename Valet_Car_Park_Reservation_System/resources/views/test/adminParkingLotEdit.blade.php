<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parking Lot</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <h1>Edit Specific Parking Lot Data</h1>

    @if ($errors->any())
        <div>
            <h3 style="color: red;">
                @foreach ($errors->all() as $error)
                    ERROR : {{ $error }}
                @endforeach
            </h3>
        </div>
    @endif

    <form action="{{route('api.updateParkingLotInformation',$parkingLot[0][0]->parking_lot_id)}}" method="POST">
        @csrf
        @method("PATCH")
        <label for="parking_lot_id">Parking Lot ID : </label>
        <input type="text" name="parking_lot_id" id="parking_lot_id" value="{{$parkingLot[0][0]->parking_lot_id}}">
        <br>
        <label for="status">Status : </label>
        <select name="status" id="status">
            <option id="option1" value="{{$parkingLot[0][0]->status}}" selected>{{$parkingLot[0][0]->status}}</option>
            <option id="option2" value=""></option>
        </select>
        <br>
        <label for="comment">Comment : </label>
        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Make Some Comment Before Update The ."></textarea>
        <br>
        <label for="open_time">Open Time : </label>
        <input type="time" name="open_time" id="open_time" step="1" value="{{$parkingLot[0][0]->open_time}}">
        <br>
        <label for="close_time">Close Time : </label>
        <input type="time" name="close_time" id="close-time" step="1" value="{{$parkingLot[0][0]->close_time}}">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

<script>
    let option1Val = $('#option1').val()

    $(function(){
        if(option1Val === '1'){
            $('#option1').text("Open")
            $('#option2').text("Closed").val("0")
        }
        else{
            $('#option1').text("Closed")
            $('#option2').text("Open").val("1")
        }
    })
</script>