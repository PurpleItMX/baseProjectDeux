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
				<th>{{ __('Acciones:') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						<a type="button" class="btn btn-secondary btn-sm" href="{{ url('/user/edit/'.$user->id)}}">
							<span class="glyphicon glyphicon-search" aria-hidden="true">
								Editar
							</span>
						</a>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/user/delete/'.$user->id)}}">
							<span class="glyphicon glyphicon-search" aria-hidden="true">
								Eliminar
							</span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>

@endsection