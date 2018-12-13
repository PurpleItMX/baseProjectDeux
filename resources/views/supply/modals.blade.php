<!------------------------------------------ modal season  --------------------------------------------------->
<div id="myModalSeason" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
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
          <input id="id_season_modal" name="id_season" type="hidden" value="">
          <input id="id_season_redirect" name="id_season_redirect" type="hidden" value="false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="clave_season_modal">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-search"></i></div>
                  </div>
                <input id="clave_season_modal" type="text" class="form-control search" data-id="" data-controller ="season" name="clave" required autofocus value="" maxlength="10">
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="form-check">
                <label class="" for="estatus_season_modal">{{ __('Activo:') }}</label>
                  <label class="switch">
                      <input type="checkbox" id="estatus_season_modal" name="estatus" >
                      <span class="slider round"></span>
                  </label>
              </div>
            </div> 
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-check">
                  <label for="time_initial_season_modal">{{ __('Fecha Inicial:') }}</label>
                  <input class="form-control" type="date" id="time_initial_season_modal" name= "time_initial" value="" required>
                </div>
             </div>
            <div class="form-group col-md-6">
                <div class="form-check">
                    <label for="time_end_season_modal">{{ __('Fecha Final:') }}</label>
                    <input class="form-control" type="date" id="time_end_season_modal" name= "time_end" value="" required>
                </div>
              </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-12">
                <label for="description_season_modal">{{ __('Descripción:') }}</label>
                <textarea id="description_season_modal" name="description" class="form-control" required maxlength="255"></textarea>
              </div>
            </div>
      </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSeason" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Aceptar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------ modal supply-type  --------------------------------------------------->
<div id="myModalSupplyType" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Tipos de Insumo') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveSupplyType" method="POST" action="{{ url('/supply-type/save') }}">
          @csrf
          <input id="id_supply_modal" name="id_supply_type" type="hidden" value="">
          <input id="id_supply_type_redirect" name="id_supply_type_redirect" type="hidden" value="false">
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="clave_supply_type_modal">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave_supply_type_modal" type="text" class="form-control search" data-id="" data-controller ="supply-type" name="clave" required autofocus value="" maxlength="10">
              </div>
            </div>
            <div class="form-group col-md-5">
              <div class="form-group">
                <label for="id_supply_category_supply_type_modal">{{ __('Categoría de Insumos:') }}</label>
                <select class="form-control" id="id_supply_category_supply_type_modal" name="id_supply_category"  required>
                  <option value="">{{ __('Seleccione') }}</option>
                  @foreach($supplyCategories as $supplyCategory)
                    <option value="{{$supplyCategory->id_supply_category}}">{{$supplyCategory->clave}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-2">
              <div class="form-group">
                <label class="" for="estatus_supply_type_modal">{{ __('Activo') }}</label>
                <label class="switch">
                  <input type="checkbox" id="estatus_supply_type_modal" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="description_supply_type_modal">{{ __('Descripción:') }}</label>
              <textarea id="description_supply_type_modal" name="description" class="form-control" required maxlength="255"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSupplyType" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{__('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------- modal supply-category  ------------------------------------------------->
<div id="myModalSupplyCategory" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Categorias de Insumo') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveSupplyCategory" method="POST" action="{{ url('/supply-category/save') }}">
            @csrf
            <input id="id_supply_category_modal" name="id_supply_category" type="hidden" value="">
            <input id="id_supply_category_redirect" name="id_supply_category_redirect" type="hidden" value="false">
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="clave_supply_category_modal">{{ __('Clave:') }}</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                  </div>
                  <input id="clave_supply_category_modal" type="text" class="form-control search" data-id="" data-controller ="supply-category" name="clave" required autofocus value="" maxlength="10">
                </div>
              </div>
              <div class="form-group col-md-5">
                <div class="form-check">
                  <label for="variant_supply_category_modal">{{ __('Variación Permitída:') }}</label>
                  <input class="form-control" type="number" id="variant_supply_category_modal" name= "variant" min="0" max="100" required>
                </div>
              </div> 
              <div class="form-group col-md-2">
                <div class="form-group">
                  <label class="" for="estatus_supply_category_modal">{{ __('Activo:') }}</label>
                  <label class="switch">
                    <input type="checkbox" id="estatus_supply_category_modal" name="estatus" >
                    <span class="slider round"></span>
                  </label>
                </div>
              </div> 
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="description_supply_category_modal">{{ __('Descripción:') }}</label>
                <textarea id="description_supply_category_modal" name="description" class="form-control" required maxlength="255"></textarea>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSupplyCategory" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

<!----------------------------------------------- warehouse ------------------------------------------------------->
<div id="myModalWarehouse" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Almacén') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveWarehouse" method="POST" action="{{ url('/warehouse/save') }}">
          @csrf
          <input id="id_warehouse_modal" name="id_warehouse" type="hidden" value="">
          <input id="redirect" name="id_warehouse_redirect" type="hidden" value="false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="clave_warehouse_modal">{{ __('Clave:') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave_warehouse_modal" type="text" class="form-control search" data-id="" data-controller ="warehouse" name="clave" required autofocus value="" maxlength="10">
              </div>
            </div>
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="prorate_warehouse_modal">{{ __('¿Se prorratea?') }}</label>
                <label class="switch">
                  <input type="checkbox" id="prorate_warehouse_modal" name= "prorate">
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="estatus_warehouse_modal">{{ __('Activo:') }}</label>
                <label class="switch">
                  <input type="checkbox" id="estatus_warehouse_modal" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
                <label for="description_warehouse_modal">{{ __('Descripción:') }}</label>
                <textarea id="description_warehouse_modal" name="description" class="form-control" required maxlength="255"></textarea>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormWarehouse" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {{ __('Guardar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> {{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>