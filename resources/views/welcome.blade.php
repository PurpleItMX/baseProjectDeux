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
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="#myModalLogin" class="trigger-btn" data-toggle="modal">Acceder</a>
                        <a href="#myModalRegister" class="trigger-btn" data-toggle="modal">Registro</a>
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
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
                        <h4 class="modal-title">Registre Acceso:</h4>   
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Accerder</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#">¿Olvido Contraseña?</a>
                    </div>
                </div>
            </div>
        </div> 
       <!-- Fin Modal Login --> 

       <!-- Modal Login  -->
        <div id="myModalRegister" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar">
                            <img src="{{ URL::asset('img/avatar.png') }}" alt="Avatar">
                        </div>              
                        <h4 class="modal-title">Registre Acceso:</h4>   
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Accerder</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#">¿Olvido Contraseña?</a>
                    </div>
                </div>
            </div>
        </div> 
       <!-- Fin Modal Login -->



    </body>
</html>