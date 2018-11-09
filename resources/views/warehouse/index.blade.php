@extends('layouts.app')

@section('content')
	<center><h5>{{ __('Lista Almacenes') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Clave:') }}</th>
				<th>{{ __('Descripcion:') }}</th>
				<th>{{ __('Estatus:') }}</th>
				<th>{{ __('Acciones:') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($warehouses as $warehouse)
				<tr>
					<td>{{ $warehouse->id_warehouse }}</td>
					<td>{{ $warehouse->clave }}</td>
					<td>{{ $warehouse->description }}</td>
					<td> @if($warehouse->estatus == 1) Activo @else Inactivo @endif</td>
					<td>
						<a type="button" class="btn btn-secondary btn-sm" href="{{ url('/warehouse/'.$warehouse->id_warehouse)}}">
							<span class="glyphicon glyphicon-search" aria-hidden="true">
								Editar
							</span>
						</a>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/warehouse/delete/'.$warehouse->id_warehouse)}}">
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