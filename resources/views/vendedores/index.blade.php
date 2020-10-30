@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-users"></i>
        Lista de Vendedores</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="vendedores/create" class="btn btn-sm btn-success float-right" title="Agregar Nuevo Vendedor">
                  Nuevo Vendedor
                </a>
                <div class="clearfix"></div>
                <hr>
              </div>
            @endif
            <thead>
              <tr>
                <th class="text-center">Nombre(s)</th>
                <th class="text-center">Apellido(s)</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Puntos Acumulados</th>
                <th class="text-center">Identificación</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Nombre(s)</th>
                <th class="text-center">Apellido(s)</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Puntos Acumulados</th>
                <th class="text-center">Identificación</th>
                <th class="text-center">Acciones</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($vendedores as $vendedor)
                <tr class="text-center">
                  <td>{{ $vendedor->name }}</td>
                  <td>{{ $vendedor->lastname }}</td>
                  <td>{{ $vendedor->email }}</td>
                  <td>{{ $vendedor->telephone }}</td>
                  <td>{{ $vendedor->points }}</td>
                  <td>
                    <a id="{{ $vendedor->identification }}" onclick="verIdentificacionVendedor(this.id)" class="blue-text" data-toggle="modal" data-target="#modalIdentificacionVendedor" data-backdrop="static" data-keyboard="false" title="Ver Identificación"><i class="fas fa-image fa-2x"></i></a>
                  </td>
                  <td>
                    <a href="{{ route('vendedores.show', $vendedor->id) }}" type="button" class="btn btn-default btn-sm" title="Ver Vendedor"><i class="fas fa-eye"></i></a>
                    @if (Auth::user()->role == '1' && Auth::user()->level == '1')
                      <a href="{{ route('vendedores.edit', $vendedor->id) }}" type="button" class="btn btn-success btn-sm" title="Actualizar Vendedor"><i class="fas fa-edit"></i></a>
                      <a id="{{ $vendedor->id }}" onclick="deleteVendedor(this.id)" class="btn btn-danger btn-sm delete" title="Eliminar Vendedor"><i class="fas fa-trash"></i></a>
                    @endif
                  </td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="7">No Hay Vendedores</td>
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
    @if(isset($vendedor))
    <div class="modal fade" id="modalConfirmVendedorDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">

        <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">¿Estas seguro que deseas eliminar a este vendedor?</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-times fa-4x animated rotateIn"></i>

          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            <form action="/vendedores" method="post" id="deleteVendedorForm">
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

  <!--Modal: modalImagen-->
  <div class="modal fade" id="modalIdentificacionVendedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading">Identificación</p>
        </div>

        <!--Body-->
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">

              <div id="mdb-lightbox-ui"></div>

              <div class="mdb-lightbox">

                <figure class="col-md-8" style="left: 50%; transform: translate(-50%);">
                  <a id="hvIdentificacion" href="#" data-size="1600x1067">
                    <img id="ivIdentificacion" src="#" class="img-fluid">
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
  <!--Modal: modalImagen-->
@endsection
