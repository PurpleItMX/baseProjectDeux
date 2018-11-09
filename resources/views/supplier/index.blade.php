extends('layouts.app')

@section('content')
	<center><h5>{{ __('Lista Categorias de Insumos') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Nombre:') }}</th>
				<th>{{ __('Acciones:') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($supplyCategories as $supplyCategory)
				<tr>
					<td>{{ $supplyCategory->id_supply_category }}</td>
					<td>{{ $supplyCategory->clave }}</td>
					<td>
						<a type="button" class="btn btn-secondary btn-sm" href="{{ url('/supply-category/'.$supplyCategory->id_supply_category)}}">
							<span class="glyphicon glyphicon-search" aria-hidden="true">
								Editar
							</span>
						</a>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/supply-category/delete/'.$supplyCategory->id_supply_category)}}">
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