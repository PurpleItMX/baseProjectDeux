<form id="saveRecipe" method="POST" action="{{ url('/recipe/save') }}">
  @csrf
  <input id="id_recipe" name="id_recipe" type="hidden" value="">
  <input id="id_recipe_redirect" name="id_recipe_redirect" type="hidden" value="true">
  <input id="supplies" name="supplies_recipe" type="hidden" value="" />
  <div class="form-row">
    <div class="form-group col-md-5">
    <label for="clave">{{ __('Clave:') }}</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-search"></i></div>
        </div>
        <input id="clave" type="text" class="form-control search" data-id="" data-controller ="recipe" name="clave" required value="" maxlength="30">
      </div>
    </div>
    <div class="form-group col-md-5">
      <label for="umd">{{ __('UDM:') }}</label>
      <input id="umd" type="text" class="form-control" name="umd" required value="">
    </div>
    <div class="form-group col-md-2">
      <div class="form-group">
        <label class="" for="estatus">{{ __('Activo:') }}</label>
        <label class="switch">
          <input type="checkbox" id="estatus" name="estatus" >
           <span class="slider round"></span>
        </label>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
       <label for="description">{{ __('Descripción:') }}</label>
       <textarea id="description" name="description" class="form-control" required>
       </textarea>
     </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
        <label for="cost_sale">{{ __('Costo de venta:') }}</label>
        <input id="cost_sale" type="text" class="form-control number" name="cost_sale" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="expenditure_operative">{{ __('Gasto operativo:') }}</label>
        <input id="expenditure_operative" type="text" class="form-control number" name="expenditure_operative" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="margen_actually">{{ __('Margen Actual:') }}</label>
        <input id="margen_actually" type="text" class="form-control number" name="margen_actually" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="margen_category">{{ __('Margen X Categoría:') }}</label>
        <input id="margen_category" type="text" class="form-control number" name="margen_category" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="price_sale">{{ __('Precio de venta:') }}</label>
        <input id="price_sale" type="text" class="form-control number" name="price_sale" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="utility">{{ __('Utilidad:') }}</label>
        <input id="utility" type="text" class="form-control number" name="utility" required value="">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
        <label for="iva">{{ __('% IVA:') }}</label>
        <input id="iva" type="text" class="form-control number" name="iva" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="import_iva">{{ __('Importe IVA:') }}</label>
        <input id="import_iva" type="text" class="form-control number" name="import_iva" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="price_sale_iva">{{ __('Precio Venta con IVA:') }}</label>
        <input id="price_sale_iva" type="text" class="form-control number" name="price_sale_iva" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="quantity_sale">{{ __('Cantidad vendida:') }}</label>
        <input id="quantity_sale" type="text" class="form-control number" name="quantity_sale" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="production_cost">{{ __('Costo de Producción:') }}</label>
        <input id="production_cost" type="text" class="form-control number" name="production_cost" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="quantity_sell">{{ __('Cantidad a Vender:') }}</label>
        <input id="quantity_sell" type="text" class="form-control number" name="quantity_sell" required value="">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
        <label for="cost_projection">{{ __('Costo de Proyección:') }}</label>
        <input id="cost_projection" type="text" class="form-control number" name="cost_projection" required value="">
    </div>
  </div>
  <div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ __('Insumos') }}</h3>
    <div class="box-title-left">
      <button type="button" class="btn btn-success btn-sm" id="addButtonSupply" >
        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Agregar') }}
      </button>
      <button type="button" class="btn btn-default btn-sm disabled" id="">
        <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
      </button>
    </div>
  </div>
  <div class="box-body">
    <table id="listTableIn" class="table table-striped table-bordered table-list" width="100%">
      <thead>
        <tr>
          <th>{{ __('Clave:') }}</th>
          <th>{{ __('Descripción:') }}</th>
          <th>{{ __('Unidad:') }}</th>
          <th>{{ __('Costo:') }}</th>
          <th>{{ __('Gr X Rec:') }}</th>
          <th>{{ __('Rend:') }}</th>
          <th>{{ __('Gr Neto:') }}</th>
          <th>{{ __('CostoXIns:') }}</th>
          <th>{{ __('Debio Ocupar:') }}</th>
          <th>{{ __('Costo total:') }}</th>
          <th>{{ __('Acciones:') }}</th>
        </tr>
      </thead>
      <tbody id="addWarehouses">
      </tbody>
    </table>
  </div>
</div>
</form>

<div id="myModalSupply" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Clave Insumo') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveSupply" method="POST" action="">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-8">
          <label for="clave">{{ __('Clave:') }}</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input id="claveSupply" type="text" class="form-control" data-id="" name="clave" required value="" maxlength="30">
            </div>
          </div>
        </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button id="saveFormSupply" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{__('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>
