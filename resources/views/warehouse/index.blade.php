@extends('layouts.app')

@section('content')
<script src="{{ URL::asset('js/warehouse/form.js') }}"></script>
	<div class="container">
    <div class="box">
      <div class="box-header">
            <h3 class="box-title">{{ __('Lista Almacenes') }}</h3>
            <div class="box-title-left">
            <button type="button" class="btn btn-primary btn-sm" id="newWarehouse">
                    <i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
                </button>
            <button type="button" class="btn btn-default btn-sm disabled" id="">
                    <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
            </button>
          </div>
      </div>
      <div class="box-body">
      	<table id="listTable" class="table table-striped table-bordered" width="100%">
      		<thead>
      			<tr>
      				<th>{{ __('Clave:') }}</th>
      				<th width="30%">{{ __('Descripción:') }}</th>
      				<th>{{ __('Estatus:') }}</th>
      				<th width="10%">{{ __('Acciones:') }}</th>
      			</tr>
      		</thead>
      		<tbody>
      			@foreach ($warehouses as $warehouse)
      				<tr>
      					<td>{{ $warehouse->clave }}</td>
      					<td>{{ str_limit($warehouse->description, $limit = 30, $end = '...') }}</td>
      					<td> @if($warehouse->estatus == 1) Activo @else Inactivo @endif</td>
      					<td>
      						<button type="button" class="btn btn-default btn-sm searchWarehouse" data-id="{{$warehouse->id_warehouse}}">
      							<i class="fa fa-pencil" aria-hidden="true">
      							</i>
      						</button>
      						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/warehouse/delete/'.$warehouse->id_warehouse)}}">
      							<i class="fa fa-trash" aria-hidden="true"></i>
      						</a>
      					</td>
      				</tr>
      			@endforeach
      		</tbody>
      	</table>
      </div>
    </div>
	</div>

@endsection


<div id="myModalWarehouse" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Almacén') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveWarehouse" method="POST" action="{{ url('/warehouse/save') }}">
          @csrf
          <input id="id_warehouse" name="id_warehouse" type="hidden" value="">
          <input id="redirect" name="id_warehouse_redirect" type="hidden" value="true">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="clave">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control search" data-id="" data-controller ="warehouse" name="clave" required autofocus value="" maxlength="10">
              </div>
            </div>
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="prorate">{{ __('¿Se prorratea?') }}</label>
                <label class="switch">
                  <input type="checkbox" id="prorate" name= "prorate">
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="estatus">{{ __('Activo:') }}</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
                <label for="description">{{ __('Descripción:') }}</label>
                <textarea id="description" name="description" class="form-control" required maxlength="255"></textarea>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormWarehouse" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>