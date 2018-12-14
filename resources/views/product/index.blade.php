@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/product/form.js') }}"></script>
	<div class="container">
    <div class="box">
      <div class="box-header">
            <h3 class="box-title">{{ __('Lista Productos') }}</h3>
            <div class="box-title-left">
            <!--<button type="button" class="btn btn-primary btn-sm" id="newProduct" >
                    <i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
            </button>-->
            <button type="button" class="btn btn-default btn-sm disabled" id="">
                    <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
            </button>
          </div>
      </div>
      <div class="box-body">
      	<table id="listTable" class="table table-striped table-bordered" width="100%">
      		<thead>
      			<tr>
      				<th>{{ __('Clave:') }}</th>
              <th>{{ __('UDM:') }}</th>
              <th>{{ __('Descripción:') }}</th>
              <th>{{ __('Estatus:') }}</th>
      				<th>{{ __('Acciones:') }}</th>
      			</tr>
      		</thead>
      		<tbody>
      			@foreach ($products as $product)
      				<tr>
      					<td>{{ $product->clave }}</td>
                <td>{{ $product->udm }}</td>
                <td>{{ str_limit($product->description, $limit = 30, $end = '...') }}</td>
                <td> @if($product->estatus == 1) Activo @else Inactivo @endif</td>
      					<td>
      						<button type="button" class="btn btn-default btn-sm search-product" data-id="{{ $product->id_product }}">
      							<i class="fa fa-pencil" aria-hidden="true"></i>
      						</button>
      						<!--<a type="button" class="btn btn-danger btn-sm" href="{{ url('/product/delete/'.$product->id_product)}}">
      							<i class="fa fa-trash-o" aria-hidden="true"></i>
      						</a>-->
      					</td>
      				</tr>
      			@endforeach
      		</tbody>
      	</table>
      </div>
    </div>
	</div>

@endsection
<div id="myModalProduct" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Producto') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveProduct" method="POST" action="{{ url('/product/save') }}">
          @csrf
          <input id="id_product" name="id_product" type="hidden" value="">
          <input id="id_product_redirect" name="id_product_redirect" type="hidden" value="true">
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="clave">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control search" data-id="" data-controller ="product" name="clave" required autofocus value="" maxlength="20">
              </div>
            </div>
            <div class="form-group col-md-5">
              <div class="form-group">
                <label for="umd">{{ __('UDM:') }}</label>
                <input id="umd" type="text" class="form-control" data-id="" name="umd" required value="" maxlength="20">
              </div>
            </div>
            <div class="form-group col-md-2">
              <div class="form-group">
                <label class="" for="estatus">{{ __('Activo') }}</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="form-group">
                <label for="id_product_category">{{ __('Categoría de Producto:') }}</label>
                <select class="form-control" id="id_product_category" name="id_product_category"  required>
                  <option value="">{{ __('Seleccione') }}</option>
                  @foreach($productCategories as $productCategory)
                    <option value="{{$productCategory->id_product_category}}">{{$productCategory->clave}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="form-group">
                <label for="id_product_type">{{ __('Tipo de Producto:') }}</label>
                <select class="form-control" id="id_product_type" name="id_product_type"  required>
                  <option value="">{{ __('Seleccione') }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="description">{{ __('Descripción:') }}</label>
              <textarea id="description" name="description" class="form-control" required maxlength="255"></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="price_sale">{{ __('Precio de Venta:') }}</label>
              <input id="price_sale" type="text" class="form-control" name="price_sale" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="cost_sale">{{ __('Costo de Venta:') }}</label>
              <input id="cost_sale" type="text" class="form-control" name="cost_sale" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="iva">{{ __('% Iva:') }}</label>
              <input id="iva" type="text" class="form-control" name="iva" required value="" maxlength="20">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="margen_category">{{ __('Margen Por Categoría:') }}</label>
              <input id="margen_category" type="text" class="form-control" name="margen_category" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="expenditure_operative">{{ __('Gasto Operativo:') }}</label>
              <input id="expenditure_operative" type="text" class="form-control" name="expenditure_operative" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="import_iva">{{ __('Importe Iva:') }}</label>
              <input id="import_iva" type="text" class="form-control" name="import_iva" required value="" maxlength="20">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="margen_actually">{{ __('Margen Actual:') }}</label>
              <input id="margen_actually" type="text" class="form-control" name="margen_actually" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="utility">{{ __('Utilidad:') }}</label>
              <input id="utility" type="text" class="form-control" name="utility" required value="" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="price_sale_iva">{{ __('Precio Venta con Iva:') }}</label>
              <input id="price_sale_iva" type="text" class="form-control" data-id="" name="price_sale_iva" required value="" maxlength="20">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormProduct" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{__('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>