@extends('layouts.app')

@section('content')
	<center><h5>{{ __('Lista Temporadas') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Clave:') }}</th>
				<th>{{ __('Fecha Inicio:') }}</th>
				<th>{{ __('Fecha Fin:') }}</th>
				<th>{{ __('Acciones:') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($seasons as $season)
				<tr>
					<td>{{ $season->id_season }}</td>
					<td>{{ $season->clave }}</td>
					<td>
						<a type="button" class="btn btn-secondary btn-sm" href="{{ url('/season/'.$season->id_season)}}">
							<span class="glyphicon glyphicon-search" aria-hidden="true">
								Editar
							</span>
						</a>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/season/delete/'.$season->id_season)}}">
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