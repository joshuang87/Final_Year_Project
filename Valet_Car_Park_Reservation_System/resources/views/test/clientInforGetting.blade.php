<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InforGetting</title>
</head>
<body>
    <h1>InforGetting</h1>
    <form action="{{route('test.inforUpload')}}" method="POST">
    @csrf
        <label for="phone_number">Phone Number : </label>
        <input type="text" name="phone_number" id="phone_number"><br><br>

        <label for="car_plate">Car Plate : </label>
        <input type="text" name="car_plate" id="car_plate"><br><br>

        <button type="submit">Submit</button>
        <button>
            <a href="{{route('test.home')}}">
                Back
            </a>
        </button>
        <button>
            <a href="{{route('test.showAll')}}">
                All Client Data
            </a>
        </button>
    </form>
</body>
</html>