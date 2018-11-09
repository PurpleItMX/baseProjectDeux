@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/season/form.js') }}"></script>
  <center>
    <h5>@if($season) Editar temporada @else Nuevo temporada @endif</h5>
  </center>
  <div class="container">
    <form id="saveSeason" method="POST" action="{{ url('/season/save') }}">
        @csrf
        <input id="id_season" name="id_season" type="hidden" value={{ $season ? $season->id_season: "" }}>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="clave">{{ __('Clave') }}</label>
            <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave" required autofocus value={{ $season ? $season->clave : "" }}>
          </div>

          <div class="form-group col-md-6">
            <label for="time_initial">{{ __('Fecha inicial') }}</label>
            <input class="form-control" type="date" id="time_initial" name= "time_initial" value={{ $season ? $season->time_initial: "" }}>
            
          </div>

        </div>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <div class="form-check">
              <label for="variant">{{ __('Fecha final') }}</label>
              <input class="form-control" type="date" id="time_end" name= "time_end" value={{ $season ? $season->time_end: "" }}>
            </div>
          </div> 

          <div class="form-group col-md-6">
            <div class="form-check">
              @if($season)
                <input class="form-check-input" type="checkbox" id="estatus" name= "estatus" @if($season->estatus == 1) checked="checked" @endif >
              @else
                <input class="form-check-input" type="checkbox" id="estatus" name="estatus" >
              @endif
              <label class="form-check-label" for="estatus">activo</label>
            </div>
          </div> 

        </div>
    </form>

    <center>
      <div class="footer-page">
          <button id="saveFormSeason" type="button" class="btn btn-primary btn-sm">Guardar</button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">Cancelar</button>
      </div>
  </center>

  </div>
@endsection