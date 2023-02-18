<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit</h1>
    <form action="{{route('test.updateClientInfor',$client->client_id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    
        <label for="client_id">Client ID : </label>
        <input type="text" name="client_id" id="client_id" value="{{$client->client_id}}" disabled><br><br>

        <label for="car_plate">Car Plate : </label>
        <input type="text" name="car_plate" id="car_plate" value="{{$client->car_plate}}"><br><br>
        
        <label for="phone_number">Phone Number : </label>
        <input type="text" name="phone_number" id="phone_number" value="{{$client->phone_number}}"><br><br>

        <label for="reserve_id">Reserve ID : </label>
        <input type="text" name="reserve_id" id="reserve_id" value="{{$client->reserve_id}}" disabled><br><br>

        <label for="created_at">Create Time : </label>
        <input type="text" name="created_at" id="created_at" value="{{$client->created_at}}" disabled><br><br>

        <label for="updated_at">Update Time : </label>
        <input type="text" name="updated_at" id="updated_at" value="{{$client->updated_at}}" disabled><br><br>

        <button type="submit">Edit</button>
    </form>
</body>
</html>