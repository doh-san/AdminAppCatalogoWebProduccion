<table class="table table-striped">
    <thead>
    <tr>
      <th colspan="5" style="text-align:center;">Reporte de Ventas</th>
    </tr>
    <tr>
      <th colspan="5"></th>
    </tr>
    <tr>
      <th colspan="5" style="text-align:center;">Fecha de Reporte: {{ date('d-m-Y') }}</th>
    </tr>
    <tr>
      <th colspan="5"></th>
    </tr>
    <tr>
      <th style="text-align:center;">Mes</th>
      <th style="text-align:center;">Nombre Producto</th>
      <th style="text-align:center;">Marca</th>
      <th style="text-align:center;">Cantidad Vendida</th>
      <th style="text-align:center;">Total Vendido</th>
    </tr>
    </thead>
    <tbody>
      @forelse($ventas as $venta)
        <tr>
          <td style="text-align:center;">{{ $venta->fecha }}</td>
          <td style="text-align:center;">{{ $venta->nombre_producto }}</td>
          <td style="text-align:center;">{{ $venta->marca }}</td>
          <td style="text-align:center;">{{ $venta->cantidad_producto }}</td>
          <td style="text-align:center;">$ {{ ($venta->cantidad_producto * $venta->precio_vendedor) }}</td>
        </tr>
      @empty
          <tr>
            <td colspan="5" style="text-align:center;">No Hay Ventas</td>
          </tr>
      @endforelse
    </tbody>
</table>
