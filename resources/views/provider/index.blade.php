@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/provider/form.js') }}"></script>
<!-- Vista proveedores -->
<div class="container-fluid">
	<!-- Titulo -->
	<div class="flat-cont espacio-flat">
		<div class="row">
			<div class="line-title"></div>
			<div class="col-lg-4 col-xl-4">
				<h5 class="title center-left">{{ __('Lista de Proveedores') }}</h5>
			</div>
			<div class="col-lg-2 col-xl-2 offset-lg-6 offset-xl-6">
				<div class="groupButton aling-left esp-header">
					<button type="button" class="btn-send" id="newProvider" >
						{{ __('AGREGAR PROVEEDOR') }}
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Tabla de proveedores -->
	<div class="row">
		<div class="flat-cont">
			<!-- Tabla -->
			<div class="row">
				<div class="col-lg-12 col-xl-12">
					<table id="listTable" class="table table-striped table-bordered table-list">
						<thead>
							<tr>
								<th>{{ __('Id:') }}</th>
								<th>{{ __('Clave:') }}</th>
				        <th>{{ __('Nombre:') }}</th>
				        <th>{{ __('Nombre Comercial:') }}</th>
				        <th>{{ __('RFC:') }}</th>
				        <th>{{ __('Estatus:') }}</th>
								<th>{{ __('Acciones:') }}
									<!--<button type="button" class="btn btn-primary btn-sm" id="newProvider" >
										<i class="fa fa-file" aria-hidden="true"></i> {{ __('Crear') }}
									</button>-->
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($providers as $provider)
								<tr>
									<td>{{ $provider->id_provider }}</td>
									<td>{{ $provider->clave }}</td>
				          <td>{{ $provider->name }}</td>
				          <td>{{ $provider->name_commercial }}</td>
				          <td>{{ $provider->rfc }}</td>
				          <td> @if($provider->estatus == 1) Activo @else Inactivo @endif</td>
									<td>
										<button type="button" class="btn btn-secondary btn-sm search-provider" data-id="{{ $provider->id_provider }}">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</button>
				            <button type="button" class="btn btn-warning btn-sm send-list" data-id="{{ $provider->id_provider }}">
				              <i class="fa fa-list" aria-hidden="true"></i>
				            </button>
										<button type="button" class="btn btn-danger btn-sm" href="{{ url('/provider/delete/'.$provider->id_provider)}}">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
<div id="myModalProvider" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Proveedor') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveProvider" method="POST" action="{{ url('/provider/save') }}">
          @csrf
          <input id="id_provider" name="id_provider" type="hidden" value="">
          <input id="id_provider_redirect" name="id_provider_redirect" type="hidden" value="true">
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
              <label for="rfc">{{ __('RFC') }}</label>
              <input id="rfc" type="text" class="form-control" name="rfc" required value="" maxlength="13">
            </div>
            <div class="form-group col-md-2">
              <div class="form-group">
                <label class="" for="estatus">{{ __('activo') }}</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label class="container-radio">{{ __('Persona Física') }}
                <input id="radio1" type="radio" checked="checked" name="type" value="0">
                  <span class="checkmark"></span>
              </label>
            </div>
            <div class="form-group col-md-3">
               <label class="container-radio">{{ __('Persona Moral') }}
                <input id="radio2" type="radio" name="type" value="1">
                  <span class="checkmark"></span>
              </label>
            </div>
            <div class="form-group col-md-3">
              <label class="container-radio">{{ __('Extranjero') }}
                <input id="radio3" type="radio" name="type" value="2">
                  <span class="checkmark"></span>
              </label>
            </div>
            <div class="form-group col-md-3">
              <label class="container-radio">{{ __('Proveedor General') }}
                <input id="radio4" type="radio" name="type" value="3">
                  <span class="checkmark"></span>
              </label>
            </div>
          </div>

          <div class="form-row">
             <div class="form-group col-md-6">
              <label for="name">{{ __('Razón social') }}</label>
              <input id="name" type="text" class="form-control" name="name" required autofocus value="" maxlength="50">
            </div>
            <div class="form-group col-md-6">
              <label for="name_commercial">{{ __('Nombre Comercial') }}</label>
              <input id="name_commercial" type="text" class="form-control" name="name_commercial" required autofocus value="" maxlength="20">
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="id_supply_category">{{ __('Categoria de Insumo') }}</label>
              <select class="form-control" id="id_supply_category" name="id_supply_category" required>
                <option value="" >{{ __('Seleccione') }}</option>
                @foreach($supplyCategories as $supplyCategory)
                  <option value="{{$supplyCategory->id_supply_category}}" >{{ $supplyCategory->clave }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="id_supply_type">{{ __('Tipo de Insumo') }}</label>
              <select class="form-control" id="id_supply_type" name="id_supply_type" required>
                <option value="" >{{ __('Seleccione') }}</option>
              </select>
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="form-group col-md-9">
              <label for="street">{{ __('Calle:') }}</label>
              <input id="street" type="text" class="form-control" name="street" required value="" maxlength="10">
            </div>
            <div class="form-group col-md-3">
              <label for="number_ext">{{ __('Núm Ext:') }}</label>
              <input id="number_ext" type="text" class="form-control" name="number_ext" required value="" maxlength="6">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="number_int">{{ __('Núm Int.:') }}</label>
              <input id="number_int" type="text" class="form-control" name="number_int" value="" maxlength="6">
            </div>
            <div class="form-group col-md-3">
              <label for="zip_code">{{ __('Codigo Postal:') }}</label>
              <input id="zip_code" type="number" class="form-control" name="zip_code" required value="" maxlength="5">
            </div>
            <div class="form-group col-md-6">
              <label for="colony">{{ __('Colonia:') }}</label>
              <input id="colony" type="text" class="form-control" name="colony" required value="" maxlength="20">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="city">{{ __('Ciudad:') }}</label>
              <input id="city" type="text" class="form-control" name="city" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="state">{{ __('Estado:') }}</label>
              <input id="state" type="text" class="form-control" name="state" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="country">{{ __('País:') }}</label>
              <input id="country" type="text" class="form-control" name="country" required value="" maxlength="20">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormProvider" type="button" class="btn btn-primary">{{ __('Guardar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>
