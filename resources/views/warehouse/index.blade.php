@extends('layouts.app')

@section('content')
<script src="{{ URL::asset('js/warehouse/form.js') }}"></script>
	<center><h5>{{ __('Lista Almacenes') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Clave:') }}</th>
				<th>{{ __('Descripcion:') }}</th>
				<th>{{ __('Estatus:') }}</th>
				<th>{{ __('Acciones:') }}
					<button type="button" class="btn btn-primary btn-sm" id="newWarehouse">
							<i class="fa fa-file" aria-hidden="true"></i> {{ __('Crear') }}
					</button>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($warehouses as $warehouse)
				<tr>
					<td>{{ $warehouse->id_warehouse }}</td>
					<td>{{ $warehouse->clave }}</td>
					<td>{{ $warehouse->description }}</td>
					<td> @if($warehouse->estatus == 1) Activo @else Inactivo @endif</td>
					<td>
						<button type="button" class="btn btn-secondary btn-sm searchWarehouse" data-id="{{$warehouse->id_warehouse}}">
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

@endsection


<div id="myModalWarehouse" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Almacenes') }}</h5></center>
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
              <label for="clave">{{ __('Clave') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control" name="clave" required autofocus value="" maxlength="10">
              </div>
            </div>
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="prorate">¿Se prorratea?</label>
                <label class="switch">
                  <input type="checkbox" id="prorate" name= "prorate">
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="estatus">activo</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
                <label for="description">{{ __('Descripción') }}</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormWarehouse" type="button" class="btn btn-primary">{{ __('Guardar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>