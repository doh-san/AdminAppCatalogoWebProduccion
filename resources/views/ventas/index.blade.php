@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-file-invoice-dollar"></i>
        Ventas Generadas</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (!(Auth::user()->role == '1' && Auth::user()->level == '3'))
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="row">
                <div class="col-md-12 text-center">
                  @if (Auth::user()->role == '1' && Auth::user()->level == '1')
                  <a href="{{ route('historico') }}" class="btn btn-sm btn-info" title="Historico de Ventas">Historico de Ventas</a>
                  @endif
                  @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
                  <a class="btn btn-sm btn-success" title="Enviar Reporte de Ventas" data-toggle="modal" data-target="#modalCorreoReporte">Enviar Reporte de Ventas</a>
                  @endif
                </div>
              </div>
              <div class="clearfix"></div>
              <hr>
            </div>
            @endif
            <thead>
              <tr>
                <th class="text-center">Nombre Producto</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Cantidad Vendida</th>
                <th class="text-center">Total Vendido</th>
                <th class="text-center">Imagen</th>
                <th class="text-center">Ver Detalle</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Nombre Producto</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Cantidad Vendida</th>
                <th class="text-center">Total Vendido</th>
                <th class="text-center">Imagen</th>
                <th class="text-center">Ver Detalle</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($ventas as $venta)
                <tr class="text-center">
                  <td>{{ $venta->nombre_producto }}</td>
                  <td>{{ $venta->marca }}</td>
                  <td>{{ $venta->cantidad_producto }}</td>
                  <td>{{ ($venta->cantidad_producto * $venta->precio_vendedor) }}</td>
                  <td>
                    <a id="{{ $venta->imagen }}" onclick="verProductoImagen(this.id)" class="blue-text" data-toggle="modal" data-target="#modalProductoImagen" data-backdrop="static" data-keyboard="false"><i class="fas fa-image fa-2x" title="Ver Imagén"></i></a>
                  </td>
                  <td>
                    <a href="ventas/ver_detalle/{{ $venta->id_pedido }}/{{ $venta->id_producto }}" type="button" class="btn btn-default btn-sm" title="Ver Detalle"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="5">No Hay Ventas</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--Modal: modalProductoImagen-->
  <div class="modal fade" id="modalProductoImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading">Imagén Producto</p>
        </div>

        <!--Body-->
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">

              <div id="mdb-lightbox-ui"></div>

              <div class="mdb-lightbox">

                <figure class="col-md-8" style="left: 50%; transform: translate(-50%);">
                  <a id="hpImagen" href="#" data-size="1600x1067">
                    <img id="ipImagen" src="#" class="img-fluid">
                  </a>
                </figure>

              </div>

            </div>
          </div>

        </div>

        <!--Footer-->
        <div class="modal-footer flex-center">
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Cerrar</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!--Modal: modalProductoImagen-->

  <!--Modal: modalCorreoReporte-->
  <div class="modal fade" id="modalCorreoReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
      <!--Content-->
      <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

          <!-- Nav tabs -->
          <ul class="nav md-tabs light-blue darken-3">
            <li>
              <h5 class="white-text text-center">Enviar reporte de ventas por correo</h5>
            </li>
          </ul>

          <!-- Tab panels -->
          <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

              <!--Body-->
              <div class="modal-body mb-1">

                <form class="text-center col-md-10 offset-md-1" action="ventas/export" method="POST">
                  @csrf

                  <!-- Email -->
                  <div class="md-form form-sm mb-5">
                     <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                     @error('email')
                       <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                     <label for="email">Correo Electronico<span class="red-text">*</span></label>

                     <div class="text-center mt-2">
                       <button type="submit" class="btn btn-sm btn-success">Enviar<i class="fas fa-sign-in ml-1"></i></button>
                       <button type="button" class="btn btn-sm btn-outline-danger waves-effect ml-auto" data-dismiss="modal">Cerrar</button>
                     </div>
                  </div>
                </form>
              </div>

            </div>
            <!--/.Panel 7-->
          </div>

        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!--Modal: modalCorreoReporte-->

@endsection
