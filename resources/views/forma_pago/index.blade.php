@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-money-bill-wave"></i>
        Lista de Formas de Pago</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (Auth::user()->role == '1' && Auth::user()->level == '1')
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="forma_pago/create" class="btn btn-sm btn-success float-right" title="Agregar Nueva Forma de Pago">
                  Nueva Forma de Pago
                </a>
                <div class="clearfix"></div>
                <hr>
              </div>
            @endif
            <thead>
              <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Acciones</th>
              </tr>
            </tfoot>
            <tbody class="text-center">
              @forelse($formas as $forma)
                <tr class="text-center">
                  <td>{{ $forma->nombre }}</td>
                  <td>{{ $forma->descripcion }}</td>
                  <td>
                    <a href="{{ route('forma_pago.show', $forma->id_forma_pago) }}" type="button" class="btn btn-default btn-sm" title="Ver Forma de Pago"><i class="fas fa-eye"></i></a>
                    @if (Auth::user()->role == '1' && Auth::user()->level == '1')
                    <a href="{{ route('forma_pago.edit', $forma->id_forma_pago) }}" type="button" class="btn btn-success btn-sm" title="Actualizar Forma de Pago"><i class="fas fa-edit"></i></a>
                    <a id="{{ $forma->id_forma_pago }}" onclick="deleteFormaPago(this.id)" class="btn btn-danger btn-sm delete" title="Eliminar Forma de Pago"><i class="fas fa-trash"></i></a>
                    @endif
                  </td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="3">No Hay Formas de Pago</td>
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
    @if(isset($forma))
    <div class="modal fade" id="modalConfirmFormaPagoDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">

        <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">¿Estas seguro que deseas eliminar esta forma de pago?</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-times fa-4x animated rotateIn"></i>

          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            <form action="/forma_pago" method="post" id="deleteFormaPagoForm">
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

@endsection
