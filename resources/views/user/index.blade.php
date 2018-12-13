@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="box">
	      	<div class="box-header">
	            <h3 class="box-title">{{ __('Lista Usuarios') }}</h3>
	            <div class="box-title-left">
	            <a type="button" class="btn btn-primary btn-sm" href="{{ url('/user')}}" data-toggle="tooltip" data-placement="bottom" title="Nuevo Usuario">
	            	<i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
				</a>
	            <button type="button" class="btn btn-default btn-sm disabled" id="">
	                <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
	            </button>
	          </div>
	     	</div>
	     	<div class="box-body">
				<table id="listTable" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>{{ __('Id:') }}</th>
							<th>{{ __('Nombre:') }}</th>
							<th>{{ __('Correo:') }}</th>
							<th>{{ __('Acciones:') }} 
										
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>
									<a type="button" class="btn btn-default btn-sm" href="{{ url('/user/'.$user->id)}}" data-toggle="tooltip" data-placement="bottom" title="Editar">
										<span class="fa fa-pencil" aria-hidden="true"></span>
									</a>
									<a type="button" class="btn btn-danger btn-sm" href="{{ url('/user/delete/'.$user->id)}}" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
										<span class="fa fa-trash-o" aria-hidden="true"></span>
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