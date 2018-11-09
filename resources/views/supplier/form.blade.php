@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/supply/form.js') }}"></script>


<div class="float-left">Float left on all viewport sizes</div><br>
<div class="float-right">Float right on all viewport sizes</div><br>
<div class="float-none">Don't float on all viewport sizes</div>
  <center>
    <h5>Insumos</h5>
  </center>
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Fluid jumbotron</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>
  <div class="container">
    <form id="saveSupply" method="POST" action="{{ url('/supply/save') }}">
        @csrf
        <input id="id_supply" name="id_supply" type="hidden" value={{ $supply ? $supply->id_supply: "" }}>
        <div class="form-row">
          
        </div>
    </form>

    <center>
      <div class="footer-page">
          <button id="saveFormSupply" type="button" class="btn btn-primary btn-sm">Guardar</button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">Cancelar</button>
      </div>
  </center>

  </div>
@endsection