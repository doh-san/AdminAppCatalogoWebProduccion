@extends('layouts.app')

@section('content')

  <div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <h3 class="card-header white-text mdb-color text-center">
        <i class="fas fa-list"></i>
        Lista de Categorias</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
            @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="categorias/create" class="btn btn-sm btn-success float-right" title="Agregar Nueva Categoria">
                  Nueva Categoria
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
              @forelse($categorias as $categoria)
                <tr class="text-center">
                  <td>{{ $categoria->nombre }}</td>
                  <td>{{ $categoria->descripcion }}</td>
                  <td>
                    <a href="{{ route('categorias.show', $categoria->id_categoria) }}" type="button" class="btn btn-default btn-sm" title="Ver Categoria"><i class="fas fa-eye"></i></a>
                    @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
                      <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" type="button" class="btn btn-success btn-sm" title="Actualizar Categoria"><i class="fas fa-edit"></i></a>
                      <a id="{{ $categoria->id_categoria }}" onclick="deleteCategoria(this.id)" class="btn btn-danger btn-sm delete" title="Eliminar Categoria"><i class="fas fa-trash"></i></a>
                    @endif
                  </td>
                </tr>
              @empty
                  <tr class="text-center">
                    <td colspan="3">No Hay Categorias</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @if (Auth::user()->role == '1' && Auth::user()->level == '1' || Auth::user()->level == '2')
    <!--Modal: modalConfirmDelete-->
    @if(isset($categoria))
    <div class="modal fade" id="modalConfirmCategoriaDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">

        <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">¿Estas seguro que deseas eliminar esta categoria?</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-times fa-4x animated rotateIn"></i>

          </div>

          <!--Footer-->
          <div class="modal-footer flex-center">
            <form action="/categorias" method="post" id="deleteCategoriaForm">
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
