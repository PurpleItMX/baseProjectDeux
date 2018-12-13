@extends('layouts.app')

@section('content')
<script src="{{ URL::asset('js/supply/form.js') }}"></script>
<script src="{{ URL::asset('js/supply/modals.js') }}"></script>
<div class="container">
    <div class="box">
      <div class="box-header">
            <h3 class="box-title">{{ __('Lista Insumos') }}</h3>
            <div class="box-title-left">
            <button type="button" class="btn btn-primary btn-sm" id="newSupply" >
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
      				<th>{{ __('UDM:') }}</th>
              <th>{{ __('Descripción:') }}</th>
              <th>{{ __('Estatus:') }}</th>
      				<th>{{ __('Acciones:') }}</th>
      			</tr>
      		</thead>
      		<tbody>
      			@foreach ($supplies as $supply)
      				<tr>
      					<td>{{ $supply->clave }}</td>
      					<td>{{ $supply->udm }}</td>
                		<td>{{ str_limit($supply->description, $limit = 30, $end = '...') }}</td>
                		<td> @if($supply->estatus == 1) Activo @else Inactivo @endif</td>
      					<td>
      						<button type="button" class="btn btn-default btn-sm search-supply" data-id="{{ $supply->id_supply }}">
      							<i class="fa fa-pencil" aria-hidden="true"></i>
      						</button>
      						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/supply-type/delete/'.$supply->id_supply)}}">
      							<i class="fa fa-trash-o" aria-hidden="true"></i>
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
<div id="myModalSupply" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Insumo') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="warehousesInput" type="hidden" value="{{$warehouses}}">
      	@include('supply.form')
      </div>
      <div class="modal-footer">
        <button id="saveFormSupply" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{__('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

@include('supply.modals')