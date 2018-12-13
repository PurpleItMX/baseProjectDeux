<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ __('Almacenes') }}</h3>
    <div class="box-title-left">
      <button type="button" class="btn btn-success btn-sm" id="addButtonWarehouse" >
        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Agregar') }}
      </button>
      <button type="button" class="btn btn-primary btn-sm" id="newWarehouse" >
        <i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
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
          <th>{{ __('Almacén:') }}</th>
          <th>{{ __('% Part:') }}</th>
          <th>{{ __('Acciones:') }}</th>
        </tr>
      </thead>
      <tbody id="addWarehouses">
      </tbody>
    </table>
  </div>
</div>