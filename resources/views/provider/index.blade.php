@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/provider/form.js') }}"></script>
<div class="container">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">{{ __('Lista de Proveedores') }}</h3>
      <div class="box-title-left">
        <button type="button" class="btn btn-primary btn-sm" id="newProvider" >
          <i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
        </button>
        <button type="button" class="btn btn-default btn-sm disabled" id="">
          <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
        </button>
      </div>
    </div>
    <div class="box-body">
  		<table id="listTable" class="table table-striped table-bordered table-list" width="100%">
  			<thead>
  				<tr>
  					<th>{{ __('Clave:') }}</th>
  	        <th>{{ __('Nombre/Razón Social:') }}</th>
  	        <!--<th>{{ __('Nombre Comercial:') }}</th>-->
            <th>{{ __('RFC:') }}</th>
            <!--<th>{{ __('Categoría:') }}</th>
            <th>{{ __('Tipo:') }}</th>-->
  	        <th>{{ __('Estatus:') }}</th>
  					<th>{{ __('Acciones:') }}</th>
  				</tr>
  			</thead>
  			<tbody>
  				@foreach ($providers as $provider)
  					<tr>
  						<td>{{ $provider->clave }}</td>
  	          <td>{{ $provider->name }}</td>
  	          <!--<td>{{ $provider->name_commercial }}</td>-->
  	          <td>{{ $provider->rfc }}</td>
              <!--@foreach($providerCategories as $providerCategory)
                @if($provider->id_provider_category == $providerCategory->id_provider_category)
                  <td>{{$providerCategory->clave }}</td>
                @endif
               @endforeach
               @foreach($providerTypes as $providerType)
                @if($provider->id_provider_type == $providerType->id_provider_type)
                  <td>{{$providerType->clave }}</td>
                @endif
               @endforeach-->
  	          <td> @if($provider->estatus == 1) Activo @else Inactivo @endif</td>
  						<td>
  							<button type="button" class="btn btn-default btn-sm search-provider" data-id="{{ $provider->id_provider }}">
  								<i class="fa fa-pencil" aria-hidden="true"></i>
  							</button>
  	            <button type="button" class="btn btn-warning btn-sm send-list-o" data-id="{{ $provider->id_provider }}">
  	              <i class="fa fa-list" aria-hidden="true"></i>
  	            </button>
  							<a type="button" class="btn btn-danger btn-sm" href="{{ url('/provider/delete/'.$provider->id_provider)}}">
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
<div id="myModalProvider" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
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
              <label for="clave">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control search" data-id="" data-controller ="provider" name="clave" required autofocus value="" maxlength="10">
              </div>
            </div>
            <div class="form-group col-md-5">
              <label for="rfc">{{ __('RFC:') }}</label>
              <input id="rfc" type="text" class="form-control rfc" name="rfc" required value="" maxlength="13">
            </div>
            <div class="form-group col-md-2">
              <div class="form-group">
                <label class="" for="estatus">{{ __('Activo:') }}</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-data-tab" data-toggle="pill" href="#pills-data" role="tab" aria-controls="pills-data" aria-selected="true">{{ __('Datos General:') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-address-tab" data-toggle="pill" href="#pills-address" role="tab" aria-controls="pills-address" aria-selected="false">{{ __('Dirección:') }}</a>
            </li>
          </ul>

          <div class="tab-content" id="pills-tabContent">
            <!--- -----------------------------    pill de datos     --------------------------------->
            <div class="tab-pane fade show active" id="pills-data" role="tabpanel" aria-labelledby="pills-data-tab">
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label class="container-radio">{{ __('Persona Física') }}
                    <input id="radio1" class="radio-type" type="radio" checked="checked" name="type" value="0">
                      <span class="checkmark"></span>
                  </label>
                </div>
                <div class="form-group col-md-3">
                   <label class="container-radio">{{ __('Persona Moral') }}
                    <input id="radio2" class="radio-type" type="radio" name="type" value="1">
                      <span class="checkmark"></span>
                  </label>
                </div>
                <div class="form-group col-md-3">
                  <label class="container-radio">{{ __('Extranjero') }}
                    <input id="radio3" class="radio-type" type="radio" name="type" value="2">
                      <span class="checkmark"></span>
                  </label>
                </div>
                <div class="form-group col-md-3">
                  <label class="container-radio">{{ __('Proveedor General') }}
                    <input id="radio4" class="radio-type" type="radio" name="type" value="3">
                      <span class="checkmark"></span>
                  </label>
                </div>
              </div>

              <div class="form-row">
                 <div class="form-group col-md-6">
                  <label for="name">{{ __('Nombre/Razón Social:') }}</label>
                  <input id="name" type="text" class="form-control" name="name" required autofocus value="" maxlength="50">
                </div>
                <div class="form-group col-md-6">
                  <label for="name_commercial">{{ __('Nombre Comercial:') }}</label>
                  <input id="name_commercial" type="text" class="form-control" name="name_commercial" required autofocus value="" maxlength="20">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="id_provider_category">{{ __('Categoria') }}</label>
                  <select class="form-control" id="id_provider_category" name="id_provider_category" required>
                    <option value="" >{{ __('Seleccione') }}</option>
                    @foreach($providerCategories as $providerCategory)
                      <option value="{{$providerCategory->id_provider_category}}" >{{ $providerCategory->clave }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="id_provider_type">{{ __('Tipo') }}</label>
                  <select class="form-control" id="id_provider_type" name="id_provider_type" required>
                    <option value="" >{{ __('Seleccione') }}</option>
                  </select>
                </div>
              </div>
          
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="phone">{{ __('Teléfono:') }}</label>
                  <input id="phone" type="text" class="form-control phone" name="phone" required value="" maxlength="10">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">{{ __('Correo:') }}</label>
                  <input id="email" type="email" class="form-control" name="email" required value="">
                </div>
              </div>

            </div>
            <!--- -----------------------------    pill de direccion     --------------------------------->
            <div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab">

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
                  <input id="zip_code" type="text" class="form-control zip_code" name="zip_code" required value="" maxlength="5">
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

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormProvider" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>
