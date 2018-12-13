<form id="saveSubrecipe" method="POST" action="{{ url('/subrecipe/save') }}">
  @csrf
  <input id="id_subrecipe" name="id_subrecipe" type="hidden" value="">
  <input id="id_subrecipe_redirect" name="id_subrecipe_redirect" type="hidden" value="true">
  <input id="supplies" name="supplies_subrecipe" type="hidden" value="" />
  <div class="form-row">
    <div class="form-group col-md-5">
    <label for="clave">{{ __('Clave:') }}</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-search"></i></div>
        </div>
        <input id="clave" type="text" class="form-control search" data-id="" data-controller ="subrecipe" name="clave" required value="" maxlength="30">
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
        <label for="unit_cost">{{ __('Costo Unitario:') }}</label>
        <div id="unit_cost_text"> </div>
        <input id="unit_cost" type="text" class="form-control number hide" name="unit_cost" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="performance">{{ __('Rendimiento:') }}</label>
        <input id="performance" type="text" class="form-control hide number" name="performance" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="recipe_cost">{{ __('Costo Receta:') }}</label>
        <div id="recipe_cost_text"> </div>
        <input id="recipe_cost" type="text" class="form-control hide number" name="recipe_cost" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="previous_production_week">{{ __('Prod. sem Ant:') }}</label>
        <div id="previous_production_week_text"> </div>
        <input id="previous_production_week" type="text" class="form-control hide number" name="previous_production_week" required value="">
    </div>
    <div class="form-group col-md-2">
        <label for="quantity_produce">{{ __('Cantidad a Producir:') }}</label>
        <div id="quantity_produce_text"> </div>
        <input id="quantity_produce" type="text" class="form-control hide number" name="quantity_produce" required value="">
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
          <th>{{ __('Se Ocupó:') }}</th>
          <th>{{ __('Req. Prod:') }}</th>
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
        <center><h5 class="modal-title">{{ __('Descripción del Insumo') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveSupply" method="POST" action="">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-8">
          <label for="clave">{{ __('Descripción:') }}</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input id="claveSupply" type="text" class="form-control" data-id="" name="description" required value="" maxlength="30">
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
