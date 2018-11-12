@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/supply-category/form.js') }}"></script>
	<center><h5>{{ __('Lista Categorias de Insumos') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Nombre:') }}</th>
        <th>{{ __('Estatus:') }}</th>
				<th>{{ __('Acciones:') }}
					<button type="button" class="btn btn-primary btn-sm" id="newSupplyCategory">
							<i class="fa fa-file" aria-hidden="true"></i> {{ __('Crear') }}
					</button>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($supplyCategories as $supplyCategory)
				<tr>
					<td>{{ $supplyCategory->id_supply_category }}</td>
					<td>{{ $supplyCategory->clave }}</td>
          <td> @if($supplyCategory->estatus == 1) Activo @else Inactivo @endif</td>
					<td>
						<button type="button" class="btn btn-secondary btn-sm search-supply-category" data-id="{{$supplyCategory->id_supply_category}}">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</button>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/supply-category/delete/'.$supplyCategory->id_supply_category)}}">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>

@endsection

<div id="myModalSupplyCategory" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Categorias de Insumo') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveSupplyCategory" method="POST" action="{{ url('/supply-category/save') }}">
            @csrf
            <input id="id_supply_category" name="id_supply_category" type="hidden" value="">
            <input id="id_supply_category_redirect" name="id_supply_category_redirect" type="hidden" value="true">
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="clave">{{ __('Clave') }}</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                  </div>
                  <input id="clave" type="text" class="form-control" name="clave" required autofocus value="" maxlength="10">
                </div>
              </div>
              <div class="form-group col-md-5">
                <div class="form-check">
                  <label for="variant">Variación Permitida:</label>
                  <input class="form-control" type="number" id="variant" name= "variant" min="0" max="100">
                </div>
              </div> 
              <div class="form-group col-md-2">
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
        <button id="saveFormSupplyCategory" type="button" class="btn btn-primary">{{ __('Guardar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>