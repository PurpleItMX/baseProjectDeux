@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/role/form.js') }}"></script>
	<div class="container">
		<div class="box">
	      	<div class="box-header">
	            <h3 class="box-title">{{ __('Lista Roles') }}</h3>
	            <div class="box-title-left">
	            <button type="button" class="btn btn-primary btn-sm" id="newRole" >
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
							<th>{{ __('Nombre:') }}</th>
							<th>{{ __('Estatus:') }}</th>
							<th>{{ __('Acciones:') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($roles as $role)
							<tr>
								<td>{{ $role->name }}</td>
								<td> @if($role->status == 1) Activo @else Inactivo @endif</td>
								<td>
									<button type="button" class="btn btn-default btn-sm search-role" data-id="{{$role->id_role}}">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</button>
									<a type="button" class="btn btn-danger btn-sm" href="{{ url('/role/delete/'.$role->id_role)}}">
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
<div id="myModalRole" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Rol') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveRole" method="POST" action="{{ url('/role/save') }}">
	        @csrf
	        <input id="id_role" name="id_role" type="hidden" value="">
	        <input id="id_role_redirect" name="id_role_redirect" type="hidden" value="true">
	        <div class="form-row">
	          <div class="form-group col-md-6">
	            <label for="name">{{ __('Nombre:') }}</label>
	            <div class="input-group mb-2 mr-sm-2">
                	<div class="input-group-prepend">
                  		<div class="input-group-text"><i class="fa fa-search"></i></div>
                	</div>
	            	<input id="name" type="text" class="form-control search" data-id="" data-controller ="role" name="name" required autofocus value="" maxlength="20">
	            </div>
	          </div>
	          <div class="form-group col-md-6">
	            <div class="form-check">
	            	<label class="" for="estatus">{{ __('Activo:') }}</label>
                	<label class="switch">
                  		<input type="checkbox" id="estatus" name="estatus" >
                  		<span class="slider round"></span>
                	</label>
	            </div>
	          </div> 
	        </div>
	    </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormRole" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Aceptar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>