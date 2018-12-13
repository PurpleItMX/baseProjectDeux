@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/service/form.js') }}"></script>
<div class="container">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">{{ __('Lista de Servicios') }}</h3>
      <div class="box-title-left">
        <button type="button" class="btn btn-primary btn-sm" id="newService" >
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
  	        <th>{{ __('UDM:') }}</th>
            <th>{{ __('Descripción:') }}</th>
  	        <th>{{ __('Estatus:') }}</th>
  					<th>{{ __('Acciones:') }}</th>
  				</tr>
  			</thead>
  			<tbody>
  				@foreach ($services as $service)
  					<tr>
  						<td>{{ $service->clave }}</td>
  	          <td>{{ $service->udm }}</td>
              <td>{{ str_limit($service->description, $limit = 30, $end = '...') }}</td>
  	          <td> @if($service->estatus == 1) Activo @else Inactivo @endif</td>
  						<td>
  							<button type="button" class="btn btn-default btn-sm search-service" data-id="{{ $service->id_service }}">
  								<i class="fa fa-pencil" aria-hidden="true"></i>
  							</button>
  							<a type="button" class="btn btn-danger btn-sm" href="{{ url('/service/delete/'.$service->id_service)}}">
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
<div id="myModalService" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Servicio') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveService" method="POST" action="{{ url('/service/save') }}">
          @csrf
          <input id="id_service" name="id_service" type="hidden" value="">
          <input id="id_service_redirect" name="id_service_redirect" type="hidden" value="true">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="clave">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control search" data-id="" data-controller ="service" name="clave" required autofocus value="" maxlength="10">
              </div>
            </div>
            <div class="form-group col-md-5">
                <label for="udm">{{ __('UDM:') }}</label>
                <input id="udm" type="text" class="form-control" name="udm" required value="">
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
          <div class="form-row">
            <div class="form-group col-md-5">
                <label for="apportionment">{{ __('Prorrateo:') }}</label>
                <select class="form-control" id="apportionment" name="apportionment"  required>
                  <option value="">{{ __('Seleccione') }}</option>
                  <option value="1">{{ __('Mensual') }}</option>
                  <option value="2">{{ __('Bimestral') }}</option>
                  <option value="3">{{ __('trimestral') }}</option>
                  <option value="4">{{ __('Semestral') }}</option>
                  <option value="5">{{ __('Anual') }}</option>
                </select>
            </div>
            <div class="form-group col-md-5">
              <label for="percentage_apportionment">{{ __('% Prorrateo:') }}</label>
              <input id="percentage_apportionment" type="number" class="form-control" name="percentage_apportionment" required value="">
            </div>

          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="id_service_category">{{ __('Categoría de Servicio:') }}</label>
              <select class="form-control" id="id_service_category" name="id_service_category"  required>
                <option value="">{{ __('Seleccione') }}</option>
                @foreach($serviceCategories as $serviceCategory)
                  <option value="{{$serviceCategory->id_service_category}}">{{$serviceCategory->clave}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="id_service_type">{{ __('Tipo de Servicio:') }}</label>
              <select class="form-control" id="id_service_type" name="id_service_type"  required>
                <option value="">{{ __('Seleccione') }}</option>
              </select>
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
        <button id="saveFormService" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>
