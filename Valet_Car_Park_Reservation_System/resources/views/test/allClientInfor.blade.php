<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>All Client Information</h1>
    <table>
        <tr>
            <th>Client ID</th>
            <th>Car Plate</th>
            <th>Phone Number</th>
            <th>Reserve ID</th>
        </tr>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->client_id}}</td>
            <td>{{ $client->car_plate}}</td>
            <td>{{ $client->phone_number}}</td>
            <td>{{ $client->reserve_id}}</td>
            <td>
                <form action="{{route('test.deleteClientData',$client->client_id)}}" method="POST">
                    <a href="{{route('test.editClientInfor',$client->client_id)}}" class="btn btn-outline-warning" style="--bs-btn-padding-x: 1.34rem;">Edit</a>&nbsp;
                    @csrf
                    @method('DELETE')
                    <button type="submit" onClick="return confirm('Are you sure to delete?')" class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        @endforeach
    </table><br>
    <button>
        <a href="{{route('test.inforGetting')}}">Reserve</a>
    </button>
    <button>
        <a href="{{route('test.home')}}">Back To Home</a>
    </button>
</body>
</html>