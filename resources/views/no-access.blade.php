<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name') }}</title>
        <style type="text/css" media="screen">
            body {
  				background:rgb(0,0,0);  
    			background: transparent\9;  
    			background:rgba(0,0,0,0.4);
  				background-image: url("{{ URL::asset('img/lagavia.png') }}");
                background-repeat:no-repeat;
                background-size: cover;
                /*background-position: center center;>*/
                color: snow;
                width: 300px;
  				height: 250px;
  				margin: auto;
            }
        </style>
	</head>
    <body>
    	<br><br>
    	<center><h2>Favor de acceder desde una computadora para poder ingresar al sistema.</h2></center>
    </body>
</html>