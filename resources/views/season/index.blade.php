@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/season/form.js') }}"></script>
	<center><h5>{{ __('Lista Temporadas') }}</h5></center>
	<div class="container">
	<table id="listTable" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>{{ __('Id:') }}</th>
				<th>{{ __('Clave:') }}</th>
				<th>{{ __('Fecha Inicio:') }}</th>
				<th>{{ __('Fecha Fin:') }}</th>
				<th>{{ __('Estatus:') }}</th>
				<th>{{ __('Acciones:') }}
					<button type="button" class="btn btn-primary btn-sm" id="newSeason" >
						<i class="fa fa-file" aria-hidden="true"></i> {{ __('Crear') }}
					</button>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($seasons as $season)
				<tr>
					<td>{{ $season->id_season }}</td>
					<td>{{ $season->clave }}</td>
					<td>{{ $season->time_initial }}</td>
					<td>{{ $season->time_end }}</td>
					<td> @if($season->estatus == 1) Activo @else Inactivo @endif</td>
					<td>
						<button type="button" class="btn btn-secondary btn-sm search-season" data-id="{{$season->id_season}}">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</button>
						<a type="button" class="btn btn-danger btn-sm" href="{{ url('/season/delete/'.$season->id_season)}}">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@endsection
<div id="myModalSeason" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Temporadas') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveSeason" method="POST" action="{{ url('/season/save') }}">
	        @csrf
	        <input id="id_season" name="id_season" type="hidden" value="">
	        <input id="id_season_redirect" name="id_season_redirect" type="hidden" value="true">
	        <div class="form-row">
	          <div class="form-group col-md-6">
	            <label for="clave">{{ __('Clave') }}</label>
	            <input id="clave" type="text" class="form-control" name="clave" required autofocus value="" maxlength="10">
	          </div>
	          <div class="form-group col-md-6">
	            <div class="form-check">
	            	<label class="" for="estatus">activo</label>
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
	            		<label for="time_initial">{{ __('Fecha inicial') }}</label>
	            		<input class="form-control" type="date" id="time_initial" name= "time_initial" value="">
	          		</div>
	           </div>
	        	<div class="form-group col-md-6">
	            	<div class="form-check">
	              		<label for="time_end">{{ __('Fecha final') }}</label>
	              		<input class="form-control" type="date" id="time_end" name= "time_end" value="">
	            	</div>
	          	</div>
	        </div>
	    </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSeason" type="button" class="btn btn-primary">{{ __('Aceptar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>