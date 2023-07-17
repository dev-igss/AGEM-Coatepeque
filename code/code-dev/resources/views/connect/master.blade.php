<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{ Config::get('agem.name') }} - @yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/static/css/connect.css?v='.time())}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6f5a4bc953.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ url('/img/Isotipo.ico') }}" type="image/x-icon">


</head>
<body>

    @section('content')
    @show
    
</body>
</html>