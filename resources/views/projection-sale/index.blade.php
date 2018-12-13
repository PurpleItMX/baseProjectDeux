@extends('layouts.app')
@section('content')
<div class="container">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">{{ __('Lista de Proyección de Ventas') }}</h3>
      <div class="box-title-left">
        <a type="button" class="btn btn-primary btn-sm" href="{{ url('/projection-sale') }}">
          <i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
        </a>
        <button type="button" class="btn btn-default btn-sm disabled" id="">
          <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
        </button>
      </div>
    </div>
    <div class="box-body">
  		<table id="listTable" class="table table-striped table-bordered table-list" width="100%">
  			<thead>
  				<tr>
  					<th>{{ __('Folio:') }}</th>
            <!--<th>{{ __('Descripción:') }}</th>-->
  	        <th>{{ __('Estatus:') }}</th>
  					<th>{{ __('Acciones:') }}</th>
  				</tr>
  			</thead>
  			<tbody>
  				@foreach ($projectionSales as $projectionSale)
  					<tr>
  						<td>{{ $projectionSale->folio }}</td>
              <!--<td>{{ str_limit($service->description, $limit = 30, $end = '...') }}</td>-->
  	          <td> @if($projectionSale->estatus == 1) Activo @else Inactivo @endif</td>
  						<td>
  							<a type="button" class="btn btn-default btn-sm" href="{{ url('/projection-sale/'.$projectionSale->id_projection_sale)}}">>
  								<i class="fa fa-pencil" aria-hidden="true"></i>
  							</a>
  							<a type="button" class="btn btn-danger btn-sm" href="{{ url('/projection-sale/delete/'.$projectionSale->id_projection_sale)}}">
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