<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Lot Detail</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <h1>Detail</h1>

    <h4>Parking Lot ID : {{$parkingLot[0][0]->parking_lot_id}}</h4>
    <hr>
    <h4 class="status">Status : {{$parkingLot[0][0]->status}}</h4>
    <hr>
    <h4>Available Parking Space :
        <div>
            @foreach ($parkingLot[0] as $parkingSpaces)
                <p class="parking_space_id">{{$parkingSpaces->parking_space_id}}</p>
            @endforeach
            
        </div> 
    </h4>
    <hr>
    <h4>Open Time : {{$parkingLot[0][0]->open_time}}</h4>
    <h4>Close Time : {{$parkingLot[0][0]->close_time}}</h4>
    <hr>
    <h4>Create Time : {{$parkingLot[0][0]->created_at}}</h4>
    <h4>Update Time : {{$parkingLot[0][0]->updated_at}}</h4>
    <hr>
    <h4>Comment History :
        <div>
            @foreach ($parkingLot[1] as $comments)
               <p class="commentContent">Comment Time "{{$comments->created_at}}" : {{$comments->content}}</p>
            @endforeach
        </div>
        
    </h4>
</body>
</html>

<script>
    let commentsContentArray = $('.commentContent')
    let status = $('.status').text().charAt(9)
    let parkingSpacesArray = $('.parking_space_id')

    $(function showCommentsHistoryResponse(){
        if(commentsContentArray.text().length < 19){
            commentsContentArray.text("NOT HAD ANY COMMENT HISTORY").css('color','orange')
        }
    })

    $(function showStatus(){
        if(status == 1){
            $('.status').text("Status : Open").css('color','green')
        }
        else{
            $('.status').text("Status : Closed").css('color','grey')
        }
    })

    $(function showParkingSpaceResponse(){
        if(parkingSpacesArray.text().length == 0){
            parkingSpacesArray.text("NOT HAD ANY PARKING SPACE UNDER THIS PARKING LOT").css('color','orange')
        }
    })
</script>