@extends('layouts.app')

@section('content')
	<center><h5>{{ __('Lista Usuarios') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Nombre:') }}</th>
				<th>{{ __('Correo:') }}</th>
				<th>{{ __('Acciones:') }} <a type="button" class="btn btn-primary btn-sm" href="{{ url('/user')}}" data-toggle="tooltip" data-placement="bottom" title="Nuevo Usuario">
							<span class="fa fa-file" aria-hidden="true"></span>
						</a>
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
						<a type="button" class="btn btn-secondary btn-sm" href="{{ url('/user/'.$user->id)}}" data-toggle="tooltip" data-placement="bottom" title="Editar">
							<span class="fa fa-pencil" aria-hidden="true"></span>
						</a>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/user/delete/'.$user->id)}}" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
							<span class="fa fa-trash" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>

@endsection