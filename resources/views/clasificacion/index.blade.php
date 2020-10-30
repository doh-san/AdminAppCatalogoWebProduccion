@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-tags"></i>
        Lista de Clasificaciones</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="clasificacion/create" class="btn btn-sm btn-success float-right" title="Agregar Nueva Clasificación">
                  Nueva Clasificación
                </a>
                <div class="clearfix"></div>
                <hr>
              </div>
            @endif
            <thead>
              <tr>
                <th class="text-center">Nombre Clasificación</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Imagén</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Nombre Clasificación</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Imagén</th>
                <th class="text-center">Acciones</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($clasificaciones as $clasificacion)
                <tr class="text-center">
                  <td>{{ $clasificacion->nombre }}</td>
                  <td>{{ $clasificacion->descripcion }}</td>
                  <td>
                    <a id="{{ $clasificacion->imagen }}" onclick="verClasificacionImagen(this.id)" class="blue-text" data-toggle="modal" data-target="#modalClasificacionImagen" data-backdrop="static" data-keyboard="false"><i class="fas fa-image fa-2x" title="Ver Imagén"></i></a>
                  </td>
                  <td>
                    <a href="{{ route('clasificacion.show', $clasificacion->id_clasificacion) }}" type="button" class="btn btn-default btn-sm" title="Ver Clasificación"><i class="fas fa-eye"></i></a>
                    @if (Auth::user()->role == '1' && Auth::user()->level == '1')
                      <a href="{{ route('clasificacion.edit', $clasificacion->id_clasificacion) }}" type="button" class="btn btn-success btn-sm" title="Actualizar Clasificación"><i class="fas fa-edit"></i></a>
                      <a id="{{ $clasificacion->id_clasificacion }}" onclick="deleteClasificacion(this.id)" class="btn btn-danger btn-sm delete" title="Eliminar Clasificación"><i class="fas fa-trash"></i></a>
                    @endif
                  </td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="4">No Hay Calsificaciones</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @if (Auth::user()->role == '1' && Auth::user()->level == '1')
    <!--Modal: modalConfirmClasificacionDelete-->
    @if(isset($clasificacion))
    <div class="modal fade" id="modalConfirmClasificacionDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">

        <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">¿Estas seguro que deseas eliminar esta clasificación?</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-times fa-4x animated rotateIn"></i>

          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            <form action="/clasificacion" method="post" id="deleteClasificacionForm">
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
    <!--Modal: modalConfirmClasificacionDelete-->
  @endif

  <!--Modal: modalClasificacionImagen-->
  <div class="modal fade" id="modalClasificacionImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading">Imagén</p>
        </div>

        <!--Body-->
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">

              <div id="mdb-lightbox-ui"></div>

              <div class="mdb-lightbox">

                <figure class="col-md-8" style="left: 50%; transform: translate(-50%);">
                  <a id="hcImagen" href="#" data-size="1600x1067">
                    <img id="icImagen" src="#" class="img-fluid">
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
  <!--Modal: modalClasificacionImagen-->
@endsection
