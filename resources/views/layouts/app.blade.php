<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>
    <!-------------------------- Styles ---------------------------------------------------->
    <!-- Fonts -->
    <link href="{{ URL::asset('css/Nunito-font.css') }}" rel="stylesheet" type="text/css">
    <!--<link href="{{ URL::asset('css/Roboto-Varela-Round.css') }}" rel="stylesheet" type="text/css">-->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet"  type="text/css">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- style app-->
    <link href="{{ URL::asset('css/datatables.css') }}" rel="stylesheet">
    <!--<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ URL::asset('css/welcome.css') }}" rel="stylesheet">
   
    <!------------------------------ Scripts ---------------------------------->
    <!-- jQuery -->    
    <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>       
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="{{ URL::asset('js/holder.min.js') }}"></script>
    <script src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <!-- js app -->
    <!--<script src="{{ URL::asset('js/app.js') }}"></script>-->
    
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
      <!-- Navbar -->
      <nav class="navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
        </ul>

         <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fa fa-comments-o"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fa fa-th-large"></i></a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <main class="py-4">
            @yield('content')
        </main>

  </div>
  <!-- ./wrapper -->
</body>
</html>