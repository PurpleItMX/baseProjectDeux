@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/user/form.js') }}"></script>
  <center>
    <h5>@if($user) Editar Usuario @else Nuevo Usuario @endif</h5>
  </center>
  <div class="container">
    <form id="saveUser" method="POST" action="{{ url('/user/save') }}">
        @csrf
        <input id="id_user" name="id_user" type="hidden" value={{ $user ? $user->id : "" }}>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">{{ __('Nombre') }}</label>
            <input id="name" type="text" class="form-control" name="name" required autofocus value={{ $user ? $user->name : "" }}>
          </div>
          <div class="form-group col-md-6">
            <label for="email">{{ __('Correo') }}</label>
            <input id="email" type="email" class="form-control search" data-id="{{ $user ? $user->id_user : ''}}" data-controller ="user" name="email" required value={{ $user ? $user->email : "" }}>
          </div>

        </div>
        @if(!$user)
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="password">{{ __('Contraseña') }}</label>
            <input id="password" type="password" class="form-control" name="password" required>
          </div> 
          <div class="form-group col-md-6">
            <label for="password_confirmation">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>
        @endif
        
        <!--<div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>-->
    </form>

    <center>
      <div class="footer-page">
          <button id="saveFormUser" type="button" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o"></i> {{ __('Aceptar') }}</button>
          <button type="button" class="btn btn-default btn-sm" onclick="goBack()"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
  </center>

  </div>
@endsection