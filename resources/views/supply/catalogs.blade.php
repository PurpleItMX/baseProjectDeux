<div class="form-row">
  <div class="form-group col-md-4">
    <label for="id_supply_category">{{ __('Categoría:') }}</label>
    <div class="input-group mb-2 mr-sm-2">
      <select class="form-control" id="id_supply_category" name="id_supply_category" required >
        <option value="">{{ __('Seleccione') }}</option>
        @foreach($supplyCategories as $supplyCategory)
          <option value="{{$supplyCategory->id_supply_category}}">{{$supplyCategory->clave}}</option>
        @endforeach
      </select>
      <button id="newSupplyCategory" type="button" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i>
      </button>
    </div>
  </div>
  <div class="form-group col-md-4">
  </div>
  <div class="form-group col-md-4">
    <label for="id_season">{{ __('Temporada:') }}</label>
    <div class="input-group mb-2 mr-sm-2">
      <select class="form-control" id="id_season" name="id_season" required >
        <option value="">{{ __('Seleccione') }}</option>
        @foreach($seasons as $season)
          <option value="{{$season->id_season}}">{{$season->clave}}</option>
        @endforeach
      </select>
      <button id="newSeason" type="button" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i>
      </button>
    </div>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-4">
    <label for="id_supply_type">{{ __('Tipo:') }}</label>
    <div class="input-group mb-2 mr-sm-2">
      <select class="form-control" id="id_supply_type" name="id_supply_type" required>
        <option value="">{{ __('Seleccione') }}</option>
      </select>
      <button id="newSupplytype" type="button" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i>
      </button>
    </div>
  </div>
  <div class="form-group col-md-4">
  </div>
  <div class="form-group col-md-4">
    <label for="performance">{{ __('Rendimiento:') }}</label>
    <input id="performance" type="text" class="form-control" name="performance" required value="">
  </div>
</div>