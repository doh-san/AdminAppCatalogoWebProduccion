@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-file-invoice-dollar"></i>
        Historico de Ventas</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center">Fecha Compra</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Clasificación</th>
                <th class="text-center">Cantidad Vendida</th>
                <th class="text-center">Total Vendido</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Fecha Compra</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Clasificación</th>
                <th class="text-center">Cantidad Vendida</th>
                <th class="text-center">Total Vendido</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($ventas as $venta)
                <tr class="text-center">
                  <td>{{ $venta->fecha_compra }}</td>
                  <td>{{ $venta->nombre_producto }}</td>
                  <td>{{ $venta->clasificacion }}</td>
                  <td>{{ $venta->cantidad_producto }}</td>
                  <td>{{ ($venta->cantidad_producto * $venta->precio_vendedor) }}</td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="5">No Hay Historico de Ventas</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
