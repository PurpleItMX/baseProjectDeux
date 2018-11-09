@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/supply-category/form.js') }}"></script>
  <center>
    <h5>@if($supplyCategory) Editar categoria de insumos @else Nuevo categoria de insumos @endif</h5>
  </center>
  <div class="container">
    <form id="saveSupplyCategory" method="POST" action="{{ url('/supply-category/save') }}">
        @csrf
        <input id="id_supply_category" name="id_supply_category" type="hidden" value={{ $supplyCategory ? $supplyCategory->id_supply_category: "" }}>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <label for="clave">{{ __('Clave') }}</label>
            <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave" required autofocus value={{ $supplyCategory ? $supplyCategory->clave : "" }}>
          </div>

          <div class="form-group col-md-6">
            <label for="description">{{ __('Description') }}</label>
            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>
              {{ $supplyCategory ? $supplyCategory->description : "" }}
            </textarea>
          </div>

        </div>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <div class="form-check">
              <label for="variant">Variación Permitida:</label>
              <input class="form-control" type="number" id="variant" name= "variant" min="0" max="100">
            </div>
          </div> 

          <div class="form-group col-md-6">
            <div class="form-check">
              @if($supplyCategory)
                <input class="form-check-input" type="checkbox" id="estatus" name= "estatus" @if($supplyCategory->estatus == 1) checked="checked" @endif >
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
          <button id="saveFormSupplyCategory" type="button" class="btn btn-primary btn-sm">Guardar</button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">Cancelar</button>
      </div>
  </center>

  </div>
@endsection