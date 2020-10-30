@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-lg-10 mb-4 my-5 py-5">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-edit"></i> Editando "{{ $categoria->nombre }}"
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('categorias.update', $categoria->id_categoria) }}" enctype="multipart/form-data">

                  @method('PATCH')
                  @csrf

                  <!-- First row -->
                  <div class="md-form mb-0">
                     <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre', $categoria->nombre)}}">
                     @error('nombre')
                       <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                     <label for="nombre">Nombre de Categoria<span class="red-text">*</span></label>
                  </div>

                  <div class="md-form mb-0">
                     <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control {{$errors->has('descripcion') ? 'has-error' : ''}}" length="3000" maxlength="3000" rows="3">{{old('descripcion', $categoria->descripcion)}}</textarea>
                     <!--CARGA EL ERROR DE VALIDACION-->
                     @if($errors->has('descripcion'))
                       <script type="text/javascript">
                         var elemento = document.getElementById("descripcion");
                         elemento.className += " is-invalid";
                       </script>
                       <small class="form-text text-muted mb-4 text-danger text-center">
                           {{$errors->first('descripcion')}}
                       </small>
                     @endif
                     <label for="descripcion">Descripción de Categoria<span class="red-text">*</span></label>

                  </div>

                  <!-- Sign in button -->
                  <div class="text-center my-3">
                    <button type="submit" class="btn btn-sm btn-success" title="Actualizar">
                      Actualizar
                    </button>
                    <a id="cancelar" class="btn btn-sm btn-outline-danger" title="Cancelar" href="{{ url('categorias') }}" style="background-color: #fd240c;">
                      Cancelar
                    </a>
                  </div>

                </form>
                <!-- Edit Form -->

              </div>
              <!-- Card content -->

            </div>
            <!-- Card -->

          </div>
          <!-- Second column -->

    </div>
</div>
@endsection
