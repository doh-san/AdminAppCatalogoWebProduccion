<table class="table table-striped">
    <thead>
    <tr>
      <th colspan="5" style="text-align:center;">Reporte de Ventas</th>
    </tr>
    <tr>
      <th colspan="13"></th>
    </tr>
    <tr>
      <th colspan="13" style="text-align:center;">Fecha de Reporte: {{ date('d-m-Y') }}</th>
    </tr>
    <tr>
      <th colspan="13"></th>
    </tr>
    <tr>
      <th style="text-align:center;">Codigo Pedido</th>
      <th style="text-align:center;">Nombre Producto</th>
      <th style="text-align:center;">Descripción</th>
      <th style="text-align:center;">Clasificación</th>
      <th style="text-align:center;">Marca</th>
      <th style="text-align:center;">Categoria</th>
      <th style="text-align:center;">Precio Vendedor</th>
      <th style="text-align:center;">Cantidad</th>
      <th style="text-align:center;">Total Pagado</th>
      <th style="text-align:center;">Forma de Pago</th>
      <th style="text-align:center;">Vendedor</th>
      <th style="text-align:center;">Fecha Compra</th>
      <th style="text-align:center;">Fecha Entrega</th>
    </tr>
    </thead>
    <tbody>
      @forelse($ventas as $venta)
        <tr>
          <td style="text-align:center;">{{ $venta->codigo_pedido }}</td>
          <td style="text-align:center;">{{ $venta->nombre_producto }}</td>
          <td style="text-align:center;">{{ $venta->descripcion }}</td>
          <td style="text-align:center;">{{ $venta->clasificacion }}</td>
          <td style="text-align:center;">{{ $venta->marca }}</td>
          <td style="text-align:center;">{{ $venta->categoria }}</td>
          <td style="text-align:center;">{{ $venta->precio_vendedor }}</td>
          <td style="text-align:center;">{{ $venta->cantidad_producto }}</td>
          <td style="text-align:center;">$ {{ ($venta->cantidad_producto * $venta->precio_vendedor) }}</td>
          <td style="text-align:center;">{{ $venta->forma_pago }}</td>
          <td style="text-align:center;">{{ $venta->nombre_vendedor }}</td>
          <td style="text-align:center;">{{ $venta->fecha_compra }}</td>
          <td style="text-align:center;">{{ $venta->fecha_entrega }}</td>
        </tr>
      @empty
          <tr>
            <td colspan="13" style="text-align:center;">No Hay Ventas</td>
          </tr>
      @endforelse
    </tbody>
</table>
