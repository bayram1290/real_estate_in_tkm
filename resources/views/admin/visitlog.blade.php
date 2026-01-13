<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/log/bootstrap.css">
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">IP</th>
        <th scope="col">browser</th>
        <th scope="col">OS</th>
        <th scope="col">Country</th>
        <th scope="col">City</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col">Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visitlogs as $visitlog)
        <tr>
            <th scope="row">{{$visitlog->id}}</th>
            <td>{{$visitlog->ip}}</td>
            <td>{{$visitlog->browser}}</td>
            <td>{{$visitlog->os}}</td>
            <td>{{$visitlog->country_name}}</td>
            <td>{{$visitlog->city}}</td>
            <td>{{$visitlog->latitude}}</td>
            <td>{{$visitlog->longitude}}</td>
            <td>{{\Carbon\Carbon::parse($visitlog->created_at)->diffForHumans()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<script src="/js/jquery.min.js"></script>
<script src="/js/log/bootstrap.min.js"></script>
</body>
</html>