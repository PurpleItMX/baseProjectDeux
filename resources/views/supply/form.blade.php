<form id="saveSupply" method="POST" action="{{ url('/supplier/save') }}">
  @csrf
  <input id="id_supply" name="id_supply" type="hidden" value="">
  <input id="id_supply_redirect" name="id_supply_redirect" type="hidden" value="true">
  <input id="warehouses" name="supply_warehouse" type="hidden" value="" />
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="clave">{{ __('Clave:') }}</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-search"></i></div>
        </div>
        <input id="clave" type="text" class="form-control search" data-id="" data-controller ="supplier" name="clave" required value="" maxlength="30">
      </div>
    </div>
    <div class="form-group col-md-5">
      <label for="umd">{{ __('UDM:') }}</label>
      <input id="umd" type="text" class="form-control" name="umd" required value="">
    </div>
    <div class="form-group col-md-1">
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

  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="warehouse-tab" data-toggle="tab" href="#warehouse" role="tab" aria-controls="warehouse" aria-selected="true">{{ __('Almacenes') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="catalogs-tab" data-toggle="tab" href="#catalogs" role="tab" aria-controls="catalogs" aria-selected="false">{{ __('Catálogos') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="config-tab" data-toggle="tab" href="#config" role="tab" aria-controls="config" aria-selected="false">{{ __('Configuración') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">{{ __('Estadisticas') }}</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
     <div class="tab-pane fade show active" id="warehouses" role="tabpanel" aria-labelledby="warehouse-tab">
        @include('supply.warehouse') 
     </div>
     <div class="tab-pane fade" id="catalogs" role="tabpanel" aria-labelledby="catalogs-tab">
        @include('supply.catalogs')
    </div>
    <div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">
      @include('supply.config')
    </div>
    <div class="tab-pane fade" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
      @include('supply.statistics')
    </div>
  </div>

</form>