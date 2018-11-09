@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/warehouse/form.js') }}"></script>
  <center>
    <h5>@if($warehouse) Editar Almacen @else Nuevo Almcen @endif</h5>
  </center>
  <div class="container">
    <form id="saveWarehouse" method="POST" action="{{ url('/warehouse/save') }}">
        @csrf
        <input id="id_warehouse" name="id_warehouse" type="hidden" value={{ $warehouse ? $warehouse->id_warehouse: "" }}>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <label for="clave">{{ __('Clave') }}</label>
            <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave" required autofocus value={{ $warehouse ? $warehouse->clave : "" }}>
          </div>

          <div class="form-group col-md-6">
            <label for="description">{{ __('Description') }}</label>
            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>
              {{ $warehouse ? $warehouse->description : "" }}
            </textarea>
          </div>

        </div>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <div class="form-check">
              @if($warehouse)
                <input class="form-check-input" type="checkbox" id="prorate" name= "prorate" @if($warehouse->prorate == 1) checked="checked" @endif >
              @else
                <input class="form-check-input" type="checkbox" id="prorate" name= "prorate">
              @endif
              <label class="form-check-label" for="prorate">Se prorratea según la venta</label>
            </div>
          </div> 

          <div class="form-group col-md-6">
            <div class="form-check">
              @if($warehouse)
                <input class="form-check-input" type="checkbox" id="estatus" name= "estatus" @if($warehouse->estatus == 1) checked="checked" @endif >
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
          <button id="saveFormWarehouse" type="button" class="btn btn-primary btn-sm">Guardar</button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">Cancelar</button>
      </div>
  </center>

  </div>
@endsection