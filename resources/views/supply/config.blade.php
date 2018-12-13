<div class="form-row">
  <div class="form-group col-md-3">
    <div class="form-check">
      <label class="form-check-label" for="is_inventorial">{{ __('Es Inventariable:') }}</label>
      <label class="switch">
        <input type="checkbox" id="is_inventorial" name="is_inventorial" >
        <span class="slider round"></span>
      </label>
    </div>
  </div> 
  <div class="form-group col-md-3">
    <div class="form-check">
      <label class="form-check-label" for="is_product">{{ __('Es Producción:') }}</label>
      <label class="switch">
        <input type="checkbox" id="is_product" name="is_product" >
        <span class="slider round"></span>
      </label>
    </div>
  </div>    
  <div class="form-group col-md-3">
    <div class="form-check"  style="display: flex; flex-direction: column; justify-content: flex-start;">
      <label class="form-check-label" for="is_auditable">{{ __('Es Auditable:') }}</label>
      <label class="switch">
        <input type="checkbox" id="is_auditable" name="is_auditable" >
        <span class="slider round"></span>
      </label>
    </div>
  </div>
  <div class="form-group col-md-3">
    <div class="form-check">
      <label class="form-check-label" for="is_direct_purchase">{{ __('Compra Directa:') }}</label>
      <label class="switch">
        <input type="checkbox" id="is_direct_purchase" name="is_direct_purchase" >
        <span class="slider round"></span>
      </label>
    </div>
  </div> 
</div>
<br>
<div class="form-row">
  <div class="form-group col-md-4">
    <label class="container-radio" for="radioSupply0">{{ __('Venta Directa:') }}
      <input id="radioSupply0" type="radio" checked="checked" name="type" value="0">
      <span class="checkmark"></span>
    </label>            
  </div>
  <div class="form-group col-md-4">
    <label class="container-radio" for="radioSupply1">{{ __('Producto Unico:') }}
      <input id="radioSupply1" type="radio" name="type" value="1">
      <span class="checkmark"></span>
    </label>            
  </div>
  <div class="form-group col-md-4">
    <label class="container-radio" for="radioSupply2">{{ __('Copeo:') }}
      <input id="radioSupply2" type="radio" name="type" value="2">
      <span class="checkmark"></span>
    </label>            
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-3">
    <label for="stock_fixed">{{ __('Stock Fijo:') }}</label>
    <input id="stock_fixed" type="text"  name="stock_fixed" class="form-control required" />
  </div>
  <div class="form-group col-md-3">
    <label for="stock_variable">{{ __('Stock Variable:') }}</label>
    <input id="stock_variable" type="text" class="form-control required" name="stock_variable" />
  </div>
  <div class="form-group col-md-3">
    <label for="minimal_presentation">{{ __('Presentación Minima:') }}</label>
    <input id="minimal_presentation" type="text" class="form-control required" name="minimal_presentation" />
  </div>
  <div class="form-group col-md-3">
    <label for="tolerance">{{ __('Tolerancia:') }}</label>
    <input id="tolerance" type="text" class="form-control required" name="tolerance" />
  </div>
</div>

