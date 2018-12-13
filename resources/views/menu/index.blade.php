@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/menu/form.js') }}"></script>
	<div class="container">
		<div class="box">
	      	<div class="box-header">
	            <h3 class="box-title">{{ __('Lista Menús') }}</h3>
	            <div class="box-title-left">
	            <button type="button" class="btn btn-primary btn-sm" id="newMenu" >
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
							<th>{{ __('Menu Principal:') }}</th>
							<th>{{ __('Estatus:') }}</th>
							<th>{{ __('Acciones:') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($menus as $menu)
							<tr>
								<td>{{ $menu->name }}</td>
								@if($menu->id_parent == NULL)
									<td></td> 
								@else
									@foreach($parents as $parent)
			                    		@if($parent->id_menu == $menu->id_parent)
											<td>{{ $parent->name }}</td> 
			                    		@endif
			                  		@endforeach
			                  	@endif
								<td> @if($menu->estatus == 1) Activo @else Inactivo @endif</td>
								<td>
									<button type="button" class="btn btn-default btn-sm search-menu" data-id="{{$menu->id_menu}}">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</button>
									<a type="button" class="btn btn-danger btn-sm" href="{{ url('/menu/delete/'.$menu->id_menu)}}">
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
<div id="myModalMenu" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Menú') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveMenu" method="POST" action="{{ url('/menu/save') }}">
	        @csrf
	        <input id="id_menu" name="id_menu" type="hidden" value="">
	        <input id="id_menu_redirect" name="id_menu_redirect" type="hidden" value="true">
	        <div class="form-row">
	          <div class="form-group col-md-5">
	            <label for="name">{{ __('Nombre:') }}</label>
	            <div class="input-group mb-2 mr-sm-2">
                	<div class="input-group-prepend">
                  		<div class="input-group-text"><i class="fa fa-search"></i></div>
                	</div>
	            	<input id="name" type="text" class="form-control search" data-id="" data-controller ="menu" name="name" required autofocus value="" maxlength="30">
	            </div>
	          </div>
	          <div class="form-group col-md-5">
	            	<div class="form-check">
	            		<label for="id_parent">{{ __('Menu Príncipal:') }}</label>
	            		<select class="form-control" id="id_parent" name="id_parent">
		                  <option value="">{{ __('Seleccione') }}</option>
		                  @foreach($parents as $parent)
		                    <option value="{{$parent->id_menu}}">{{$parent->name}}</option>
		                  @endforeach
		                </select>
	          		</div>
	           </div>
	          <div class="form-group col-md-2">
	            <div class="form-check">
	            	<label class="" for="estatus">{{ __('Activo:') }}</label>
                	<label class="switch">
                  		<input type="checkbox" id="estatus" name="estatus" >
                  		<span class="slider round"></span>
                	</label>
	            </div>
	          </div> 
	        </div>
	        <div class="form-row">
	        	<div class="form-group col-md-6">
	            	<div class="form-check">
	            		<label for="icono">{{ __('Icono:') }}</label>
	            		<input class="form-control" type="text" id="icono" name= "icono" value="" required>
	          		</div>
	           </div>
	        	<div class="form-group col-md-6">
	            	<div class="form-check">
	              		<label for="url">{{ __('Ruta:') }}</label>
	              		<input class="form-control" type="text" id="url" name= "url_menu" value="">
	            	</div>
	          	</div>
	        </div>
	        <div class="form-row">
              <div class="form-group col-md-12">
                <!--<label for="description">{{ __('Descripción:') }}</label>
                <textarea id="description" name="description" class="form-control" required maxlength="255"></textarea>-->
              </div>
            </div>
	    </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormMenu" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Aceptar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>