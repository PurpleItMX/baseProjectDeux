<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name') }}</title>
        
        <!-------------------------- Styles ---------------------------------------------------->
        <!-- Fonts -->
        <link href="{{ URL::asset('css/Nunito-font.css') }}" rel="stylesheet" type="text/css">
        <!--<link href="{{ URL::asset('css/Roboto-Varela-Round.css') }}" rel="stylesheet" type="text/css">-->
        <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet"  type="text/css">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!-- style app-->
        <link href="{{ URL::asset('css/datatables.css') }}" rel="stylesheet">
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
        <script>
            .dropdown-menu .sub-menu {
                left: 100%;
                position: absolute;
                top: 0;
                visibility: hidden;
                margin-top: -1px;
            }

            .dropdown-menu li:hover .sub-menu {
                visibility: visible;
            }

            .dropdown:hover .dropdown-menu {
                display: block;
            }
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        @foreach ($menus as $key => $item)
                            @if ($item['id_parent'] != 0)
                                @break
                            @endif
                            @include('menu-item', ['item' => $item])
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Salir') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="#myModalLogin" class="trigger-btn" data-toggle="modal">Acceder</a>
                        <a href="#myModalRegister" class="trigger-btn" data-toggle="modal">Registro</a>
                        <!--<a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>-->
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}
                </div>
            </div>
        </div>
    
        <!-- Modal Login  -->
        <div id="myModalLogin" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar">
                            <img src="{{ URL::asset('img/avatar.png') }}" alt="Avatar">
                        </div>              
                        <h4 class="modal-title">{{ __('Registre Acceso') }}</h4>   
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Correo" required="required" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif     
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required="required"> 
                                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div> 
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">{{ __('Acceder') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#myModalRecover" data-toggle="modal">¿Olvido Contraseña?</a>
                    </div>
                </div>
            </div>
        </div> 
       <!-- Fin Modal Login --> 

       <!-- Modal Register  -->
        <div id="myModalRegister" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar">
                            <img src="{{ URL::asset('img/avatar.png') }}" alt="Avatar">
                        </div>              
                        <h4 class="modal-title">{{ __('Nuevo Acceso') }}</h4>   
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  placeholder="Nombre" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="email_register" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Correo">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>   
                            <div class="form-group">
                                 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>   
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confime contraseña">
                            </div>   
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">{{ __('Registrar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
       <!-- Fin Modal Register -->

       <!-- Modal Recover  -->
        <div id="myModalRecover" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar">
                            <img src="{{ URL::asset('img/avatar.png') }}" alt="Avatar">
                        </div>              
                        <h4 class="modal-title">{{ __('Recuperar Acceso') }}</h4>   
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input id="email_recover" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required  placeholder="Correo">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif 
                            </div>     
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">{{ __('Enviar link reseo contraseña') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div> 
       <!-- Fin Modal Recover -->
    </body>
</html>