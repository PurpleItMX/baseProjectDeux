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
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet"  type="text/css">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/datatables.css') }}" rel="stylesheet">
    <!-- style dasboard-->
    <link rel="stylesheet" href="{{ URL::asset('css/adminlte.min.css') }}">
    <!-- style app-->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <!------------------------------ Scripts ---------------------------------->
    <!-- jQuery -->    
    <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ URL::asset('js/additional-methods.min.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <!-- style de menu -->
    <script src="{{ URL::asset('js/adminlte.js') }}"></script>
    <!--  propios del proyecto-->
    <script src="{{ URL::asset('js/app.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
    <input id="baseUrl" value="{{ url('/') }}" type="hidden" />
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
              </li>
              <!--<li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/home') }}" class="nav-link">Home</a>
              </li>-->
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Salir') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ URL::asset('img/Logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ URL::asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @foreach ($menus as $key => $item)
                            @if ($item['id_parent'] != 0)
                                @break
                            @endif
                            @include('menu-item', ['item' => $item])
                        @endforeach
                    </ul>
                  </nav>
            </div>
        </aside>
        
        <div class="content-wrapper">
            <section class="content">
              <div class="container-fluid">
                <main class="py-4">
                    @yield('content')
                </main>
              </div>
            </section>
        </div>

    </div>
</body>
</html>