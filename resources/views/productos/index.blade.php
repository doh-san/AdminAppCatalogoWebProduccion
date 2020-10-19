@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-boxes"></i>
        Lista de Productos</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="productos/create" class="btn btn-sm btn-success float-right" title="Agregar Nuevo Producto">
                  Nuevo Producto
                </a>
                <div class="clearfix"></div>
                <hr>
              </div>
            @endif
            <thead>
              <tr>
                <th class="text-center">Nombre Producto</th>
                <th class="text-center">Catalogo</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Nombre Producto</th>
                <th class="text-center">Catalogo</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Acciones</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($productos as $producto)
                <tr class="text-center">
                  <td>{{ $producto->nombre }}</td>
                  <td>{{ $producto->marca }}</td>
                  <td>{{ $producto->fecha }}</td>
                  <td>{{ $producto->categoria }}</td>
                  <td>{{ $producto->precio_venta }}</td>
                  <td>{{ $producto->cantidad }}</td>
                  <td>
                    <a href="{{ route('productos.show', $producto->id_producto) }}" type="button" class="btn btn-default btn-sm" title="Ver Producto"><i class="fas fa-eye"></i></a>
                    @if (Auth::user()->role == '1' && Auth::user()->level == '1')
                      <a href="{{ route('productos.edit', $producto->id_producto) }}" type="button" class="btn btn-success btn-sm" title="Actualizar Producto"><i class="fas fa-edit"></i></a>
                      <a id="{{ $producto->id_producto }}" onclick="deleteProducto(this.id)" class="btn btn-danger btn-sm delete" title="Eliminar Producto"><i class="fas fa-trash"></i></a>
                    @endif
                  </td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="7">No Hay Productos</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @if (Auth::user()->role == '1' && Auth::user()->level == '1')
    <!--Modal: modalConfirmVendedorDelete-->
    @if(isset($producto))
    <div class="modal fade" id="modalConfirmProductoDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">

        <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">¿Estas seguro que deseas eliminar este producto?</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-times fa-4x animated rotateIn"></i>

          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            <form action="/productos" method="post" id="deleteProductoForm">
              @csrf
              @method('DELETE')
              <td><button type="submit" class="btn btn-danger btn-md">Si</button></td>
            </form>
            <a type="button" class="btn btn-md btn-outline-danger waves-effect" data-dismiss="modal">No</a>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    @endif
    <!--Modal: modalConfirmVendedorDelete-->
  @endif

@endsection
