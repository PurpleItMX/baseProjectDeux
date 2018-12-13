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