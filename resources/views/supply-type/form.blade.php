@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/supply-type/form.js') }}"></script>
  <center>
    <h5>@if($supplyType) Editar tipo de insumos @else Nuevo tipo de insumos @endif</h5>
  </center>
  <div class="container">
    <form id="saveSupplyType" method="POST" action="{{ url('/supply-type/save') }}">
        @csrf
        <input id="id_supply_type" name="id_supply_type" type="hidden" value={{ $supplyType ? $supplyType->id_supply_type: "" }}>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <label for="clave">{{ __('Clave') }}</label>
            <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave" required autofocus value={{ $supplyType ? $supplyType->clave : "" }}>
          </div>

          <div class="form-group col-md-6">
            <label for="description">{{ __('Description') }}</label>
            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>
              {{ $supplyType ? $supplyType->description : "" }}
            </textarea>
          </div>

        </div>
        <div class="form-row">
          
          <div class="form-group col-md-6">
            <div class="form-check">
              <label for="id_supply_category">Categoria insumos:</label>
              <select class="form-control" id="id_supply_category" name="id_supply_category" >
                @foreach($supplyCategories as $supplyCategory)
                  <option value="{{$supplyCategory->id_supply_category}}" >{{ $supplyCategory->clave }}</option>
                @endforeach
              </select>
            </div>
          </div> 

          <div class="form-group col-md-6">
            <div class="form-check">
              @if($supplyType)
                <input class="form-check-input" type="checkbox" id="estatus" name= "estatus" @if($supplyType->estatus == 1) checked="checked" @endif >
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
          <button id="saveFormSupplyType" type="button" class="btn btn-primary btn-sm">Guardar</button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">Cancelar</button>
      </div>
  </center>

  </div>
@endsection