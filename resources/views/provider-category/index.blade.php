@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/provider-category/form.js') }}"></script>
	<div class="container">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{ __('Lista Categorias de Proveedor') }}</h3>
        <div class="box-title-left">
          <button type="button" class="btn btn-primary btn-sm" id="newProviderCategory">
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
              <th>{{ __('Descripción:') }}</th>
              <th>{{ __('Estatus:') }}</th>
      				<th>{{ __('Acciones:') }}</th>
      			</tr>
      		</thead>
      		<tbody>
      			@foreach ($providerCategories as $providerCategory)
      				<tr>
      					<td>{{ $providerCategory->clave }}</td>
                <td>{{ str_limit($providerCategory->description, $limit = 50, $end = '...') }}</td>
                <td> @if($providerCategory->estatus == 1) Activo @else Inactivo @endif</td>
      					<td>
      						<button type="button" class="btn btn-default btn-sm search-provider-category" data-id="{{$providerCategory->id_provider_category}}">
      							<i class="fa fa-pencil" aria-hidden="true"></i>
      						</button>
      						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/provider-category/delete/'.$providerCategory->id_provider_category)}}">
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

<div id="myModalProviderCategory" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Categoria de Proveedor') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveProviderCategory" method="POST" action="{{ url('/provider-category/save') }}">
            @csrf
            <input id="id_provider_category" name="id_provider_category" type="hidden" value="">
            <input id="id_provider_category_redirect" name="id_provider_category_redirect" type="hidden" value="true">
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="clave">{{ __('Clave:') }}</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                  </div>
                  <input id="clave" type="text" class="form-control  search" data-id="" data-controller ="provider-category" name="clave" required autofocus value="" maxlength="10">
                </div>
              </div>
              <div class="form-group col-md-5">
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
              <div class="form-group col-md-12">
                <label for="description">{{ __('Descripción:') }}</label>
                <textarea id="description" name="description" class="form-control" required maxlength="255"></textarea>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormProviderCategory" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>