@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/supply/form.js') }}"></script>
<div class="container">
   <center>
    <h5>{{ __('Insumos') }}</h5>
  </center>
   <form id="saveSupply" method="POST" action="{{ url('/supply/save') }}">
      @csrf
      <input id="id_supply" name="id_supply" type="hidden" value={{ $supply ? $supply->id_supply: "" }} >
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="clave">{{ __('Clave') }}</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-search"></i></div>
            </div>
            <input id="clave" type="text" class="form-control" name="clave" required autofocus value="">
          </div>
        </div>
        <div class="form-group col-md-5">
          <label for="umd">{{ __('UMD') }}</label>
          <input id="umd" type="text" class="form-control" name="umd" required value="">
        </div>
        <div class="form-group col-md-1">
          <div class="form-group">
            <label class="" for="estatus">activo</label>
            <label class="switch">
              <input type="checkbox" id="estatus" name="estatus" >
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
           <label for="description">{{ __('Description') }}</label>
           <textarea id="description" name="description" class="form-control" required>
           </textarea>
         </div>
      </div>
    </form>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('Almacenes') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Configuración') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('Estadisticas') }}</a>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="table-responsive-sm">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Almacén <a class="btn btn-success btn-sm" href="#myModalWarehouse" class="trigger-btn" data-toggle="modal"><i class="fa fa-plus"></i></a></th>
                <th>% Part</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Almacen 1</td>
                <td>100%</td>
                <td><button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="id_supply_category">{{ __('Categoría') }}</label>
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control" id="id_supply_category" name="id_supply_category" >
                @foreach($supplyCategories as $supplyCategory)
                  <option value="{{$supplyCategory->id_supply_category}}">{{$supplyCategory->clave}}</option>
                @endforeach
              </select>
              <a class="btn btn-success btn-sm" href="#myModalSupplyCategory" class="trigger-btn" data-toggle="modal">
                <i class="fa fa-plus"></i>
              </a>
            </div>
          </div>
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-4">
            <label for="id_season">{{ __('Temporada') }}</label>
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control" id="id_season" name="id_season" >
              </select>
              <a class="btn btn-success btn-sm" href="#myModalSeason" class="trigger-btn" data-toggle="modal">
                <i class="fa fa-plus"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="id_supply_type">{{ __('Tipo') }}</label>
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control" id="id_supply_type" name="id_supply_type" >
              </select>
              <a class="btn btn-success btn-sm" href="#myModalSupplyType" class="trigger-btn" data-toggle="modal">
                <i class="fa fa-plus"></i>
              </a>
            </div>
          </div>
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-4">
            <label for="id_season">{{ __('Rendimiento') }}</label>
            <input id="clave" type="number" class="form-control" name="clave" required value="">
          </div>
        </div>
        <br>
        <div class="form-row">
          <div class="form-group col-md-3">
            <div class="form-check">
              <label class="form-check-label" for="prorate">Es Inventariable</label>
              <label class="switch">
                <input type="checkbox" id="estatus" name="estatus" >
                <span class="slider round"></span>
              </label>
            </div>
          </div> 
          <div class="form-group col-md-3">
            <div class="form-check">
              <label class="form-check-label" for="is_production">Es Producción</label>
              <label class="switch">
                <input type="checkbox" id="estatus" name="estatus" >
                <span class="slider round"></span>
              </label>
            </div>
          </div> 
          <div class="form-group col-md-3">
            <div class="form-check">
              <label class="form-check-label" for="prorate">Es Auditable</label>
              <label class="switch">
                <input type="checkbox" id="estatus" name="estatus" >
                <span class="slider round"></span>
              </label>
            </div>
          </div> 
          <div class="form-group col-md-3">
            <div class="form-check">
              <label class="form-check-label" for="estatus">Compra Directa</label>
              <label class="switch">
                <input type="checkbox" id="estatus" name="estatus" >
                <span class="slider round"></span>
              </label>
            </div>
          </div> 
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="id_season">{{ __('Stock Fijo') }}</label>
            <input id="clave" type="number" class="form-control" name="clave" required value="">
          </div>
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-4">
            <label class="container-radio" for="prorate">{{ __('Venta Directa') }}
              <input type="radio" checked="checked" name="radio">
              <span class="checkmark"></span>
            </label>            
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="id_season">{{ __('Stock Variable') }}</label>
            <input id="clave" type="number" class="form-control" name="clave" required value="">
          </div>
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-4">
            <input class="form-radio-input" type="radio" id="prorate" name= "prorate">
            <label class="form-radio-label" for="prorate">{{ __('Producto Unico') }}</label>            
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="id_season">{{ __('Presentación Minima') }}</label>
            <input id="clave" type="number" class="form-control" name="clave" required value="">
          </div>
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-4">
            <input class="form-radio-input" type="radio" id="prorate" name= "prorate">
              <label class="form-radio-label" for="prorate">{{ __('Copeo') }}</label>            
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        


      </div>
    </div>
    <center>
    <div class="footer-page">
      <button id="saveFormSupply" type="button" class="btn btn-primary btn-sm">{{ __('Guardar') }}</button>
      <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">{{ __('Cancelar') }}</button>
    </div>
    </center>
</div>


<!--------------------  modal de almacenes  ------------------------->
<div id="myModalWarehouse" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">{{ __('Almacenes') }}</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveWarehouse" method="POST" action="{{ url('/warehouse/save') }}">
          @csrf
          <input id="id_warehouse" name="id_warehouse" type="hidden" value="">
          <input id="redirect" name="id_warehouse_redirect" type="hidden" value="false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="clave">{{ __('Clave') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control" name="clave" required autofocus value="">
              </div>
            </div>
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="prorate">¿Se prorratea?</label>
                <label class="switch">
                  <input type="checkbox" id="prorate" name= "prorate">
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
            <div class="form-group col-md-3">
              <div class="form-group">
                <label class="" for="estatus">activo</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div> 
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
                <label for="description">{{ __('Descripción') }}</label>
                <textarea id="description" name="description" class="form-control" required>
                </textarea>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="addWarehouseTable" type="button" class="btn btn-primary">{{ __('Agregar') }}</button>
        <button id="saveFormWarehouse" type="button" class="btn btn-primary">{{ __('Guardar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

<!--------------------  modal de categoría  ------------------------->
<div id="myModalSupplyCategory" class="modal" tabindex="-1" role="dialog">
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
            <input id="id_supply_category" name="id_supply_category" type="hidden" value="">
            <input id="id_supply_category_redirect" name="id_supply_category_redirect" type="hidden" value="false">
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="clave">{{ __('Clave') }}</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                  </div>
                  <input id="clave" type="text" class="form-control" name="clave" required autofocus value="">
                </div>
              </div>
              <div class="form-group col-md-5">
                <div class="form-check">
                  <label for="variant">Variación Permitida:</label>
                  <input class="form-control" type="number" id="variant" name= "variant" min="0" max="100">
                </div>
              </div> 
              <div class="form-group col-md-2">
                <div class="form-group">
                  <label class="" for="estatus">activo</label>
                  <label class="switch">
                    <input type="checkbox" id="estatus" name="estatus" >
                    <span class="slider round"></span>
                  </label>
                </div>
              </div> 
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="description">{{ __('Descripción') }}</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSupplyCategory" type="button" class="btn btn-primary">{{ __('Guardar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

<!------------------  modal de tipo categoría  ---------------------->
<div id="myModalSupplyType" class="modal" tabindex="-1" role="dialog">
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
          <input id="id_supply_type" name="id_supply_type" type="hidden" value="">
          <input id="id_supply_type_redirect" name="id_supply_type_redirect" type="hidden" value="false">
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="clave">{{ __('Clave') }}</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
                <input id="clave" type="text" class="form-control" name="clave" required autofocus value="">
              </div>
            </div>
            <div class="form-group col-md-5">
              <div class="form-group">
                <label for="id_supply_category">Categoria insumos:</label>
                <select class="form-control" id="id_supply_category" name="id_supply_category" >
                  @foreach($supplyCategories as $supplyCategory)
                    <option value="{{$supplyCategory->id_supply_category}}">{{$supplyCategory->clave}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-2">
              <div class="form-group">
                <label class="" for="estatus">activo</label>
                <label class="switch">
                  <input type="checkbox" id="estatus" name="estatus" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="description">{{ __('Description') }}</label>
              <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSupplyType" type="button" class="btn btn-primary">{{ __('Guardar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>

<!---------------------  modal de temporada  ------------------------>
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
          <input id="id_season_redirect" name="id_season_redirect" type="hidden" value="false">
        </form>
      </div>
      <div class="modal-footer">
        <button id="saveFormSeason" type="button" class="btn btn-primary">{{ __('Aceptar') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancelar') }}</button>
      </div>
    </div>
  </div>
</div>
@endsection