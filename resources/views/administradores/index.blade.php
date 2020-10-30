@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-users"></i>
        Lista de Administradores</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (Auth::user()->role == '1' && Auth::user()->level == '1')
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="administradores/create" class="btn btn-sm btn-success float-right" title="Agregar Nuevo Administrador">
                  Nuevo Administrador
                </a>
                <div class="clearfix"></div>
                <hr>
              </div>
            @endif
            <thead>
              <tr>
                <th class="text-center">Nombre(s)</th>
                <th class="text-center">Apellido(s)</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Nivel Admin</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Nombre(s)</th>
                <th class="text-center">Apellido(s)</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Nivel Admin</th>
                <th class="text-center">Acciones</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($users as $user)
                <tr class="text-center">
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->lastname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->telephone }}</td>
                  @if ($user->level == 1)
                    <td>Nivel 1</td>
                  @elseif ($user->level == 2)
                    <td>Nivel 2</td>
                  @elseif ($user->level == 3)
                    <td>Nivel 3</td>
                  @endif
                  @if ($user->level > 1)
                    <td>
                      <a href="{{ route('administradores.show', $user->id) }}" type="button" class="btn btn-default btn-sm" title="Ver Administrador"><i class="fas fa-eye"></i></a>
                      @if (Auth::user()->role == '1' && Auth::user()->level == '1')
                        <a href="{{ route('administradores.edit', $user->id) }}" type="button" class="btn btn-success btn-sm" title="Actualizar Administrador"><i class="fas fa-edit"></i></a>
                        <a id="{{ $user->id }}" onclick="deleteAdmin(this.id)" class="btn btn-danger btn-sm delete" title="Eliminar Administrador"><i class="fas fa-trash"></i></a>
                      @endif
                    </td>
                  @else
                    <td></td>
                  @endif
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="6">No Hay Usuarios</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @if (Auth::user()->role == '1' && Auth::user()->level == '1')
    <!--Modal: modalConfirmDelete-->
    @if(isset($user))
    <div class="modal fade" id="modalConfirmAdminDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">

        <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">¿Estas seguro que deseas eliminar a este administrador?</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-times fa-4x animated rotateIn"></i>

          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            <form action="/administradores" method="post" id="deleteAdminForm">
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
    <!--Modal: modalConfirmDelete-->
  @endif

  <!--Modal: modalImagen-->
  <div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading">Fotofrafía</p>
        </div>

        <!--Body-->
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">

              <div id="mdb-lightbox-ui"></div>

              <div class="mdb-lightbox">

                <figure class="col-md-8" style="left: 50%; transform: translate(-50%);">
                  <a id="hfPlacas" href="#" data-size="1600x1067">
                    <img id="ifPlacas" src="#" class="img-fluid">
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
