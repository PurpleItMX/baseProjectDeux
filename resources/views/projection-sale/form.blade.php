@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('js/projection-sale/form.js') }}"></script>
<!-- Formulario -->
<div class="container-fluid">
  <div class="row">
    <!-- Secc 01 -->
    <div class="col-lg-3 col-xl-3">
      <div class="agrupar-form">
        <p>Folio:</p>
        <div class="input-icon">
          <div class="icon-search"></div>
          <input type="text" class="" name="" value="">
        </div>
      </div>
      <div class="agrupar-form">
        <p>% Var</p>
        <div class="group-row padding-top">
           <input type="text" class="form-control input-folio input-compress" disabled="disabled" name="" value="">
        </div>
      </div>
    </div>
    <!-- Secc 02 -->
    <div class="col-lg-3 col-xl-3">
      <div class="agrupar-form">
        <p class="text">Fecha ini:</p>
        <input id="date_end" type="date" class="form-control input-date input-compress" value="">
      </div>
      <div class="agrupar-form">
          <p class="text">Fecha fin:</p>
          <input id="date_end" type="date" class="form-control input-date input-compress" value="">
      </div>
    </div>
    <div class="col-lg-3 col-lx-2">
      <div class="layout-cont">
        <p class="titulo-layout">Semana Anterior</p>
        <div class="grupo-datos   flow-dat">
          <p>Venta</p>
          <div class="grupo-datos aling-dat esp-left-text">
            <p>250,000.00</p>
            <div class="icon-green"></div>
          </div>
        </div>

        <div class="grupo-datos aling-dat flow-dat">
          <p>Costo</p>
          <div class="grupo-datos aling-dat esp-left-text">
            <p>62,000.00</p>
            <p>29.9%</p>
            <div class="icon-alert"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-lx-2">
      <div class="layout-cont">
        <p class="titulo-layout">Semana Proyectada</p>
        <div class="grupo-datos   flow-dat">
          <p>Venta</p>
          <div class="grupo-datos aling-dat esp-left-text">
            <p>275,000.00</p>
            <div class="icon-green"></div>
          </div>
        </div>
        <div class="grupo-datos aling-dat flow-dat">
          <p>Costo</p>
          <div class="grupo-datos aling-dat esp-left-text">
            <p>65,000.00</p>
            <p>29.9%</p>
            <div class="icon-alert"></div>
          </div>
        </div>
      </div>
    </div>
   </div>
  <div class="row">
    <div class="col-lg-5 col-xl-5">
      <div class="buttons-inline cont-buttons">
        <button id="search-detail-sales"type="button" class="btn btn-sm btnLayout btn-secondary padding-top" name="button">Eventos</button>
        <button type="button" class="btn btn-sm btnLayout btn-success padding-top margin-left" name="button">ABIERTO</button>
        <button type="button" class="btn btn-sm btnLayout btn-success padding-top margin-left" name="button">SIN AUTORIZAR</button>
      </div>
    </div>
  </div>
</div>

<form id="saveProjectionSale" method="POST" action="{{ url('/projection-sale/save') }}">
  @csrf
  <input id="id_projection_sale" name="id_service" type="hidden" value="">
  <input id="id_projection_sale_redirect" name="id_projection-sale_redirect" type="hidden" value="true">

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">{{ __('Insumos') }}</h3>
      <div class="box-title-left">
        <!--<button type="button" class="btn btn-success btn-sm" id="addButtonWarehouse" >
          <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Agregar') }}
        </button>
        <button type="button" class="btn btn-primary btn-sm" id="newWarehouse" >
          <i class="fa fa-file-o" aria-hidden="true"></i> {{ __('Crear') }}
        </button>-->
        <button type="button" class="btn btn-default btn-sm disabled" id="">
          <i class="fa fa-print" aria-hidden="true"></i> {{ __('Imprimir') }}
        </button>
      </div>
    </div>
    <div class="box-body">
      <table id="listTableIn" class="table table-striped table-bordered table-list" width="60%">
        <thead>
          <tr>
            <th>{{ __('Clave:') }}</th>
            <th>{{ __('Descripción:') }}</th>
            <th>{{ __('Cantidad Vendida:') }}</th>
            <th>{{ __('Cantidad Proy:') }}</th>
            <th>{{ __('Precio Venta:') }}</th>
            <th>{{ __('Precio Proy:') }}</th>
            <th>{{ __('Precio S/IVA:') }}</th>
            <th>{{ __('Ingreso Total:') }}</th>
            <th>{{ __('Ingreso Proy:') }}</th>
            <th>{{ __('Costo:') }}</th>
            <th>{{ __('% Costo:') }}</th>
            <th>{{ __('Costo Total:') }}</th>
            <th>{{ __('Gastos:') }}</th>
            <th>{{ __('Utilidad:') }}</th>
            <th>{{ __('Utilidad Total:') }}</th>
          </tr>
        </thead>
        <tbody id="addWarehouses">
        </tbody>
      </table>
    </div>
  </div>
</form>
@endsection
