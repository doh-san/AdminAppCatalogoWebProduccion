@extends('layouts.app')

@section('content')

<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 mb-4">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-edit"></i> Editando "{{ $clasificacion->nombre }}"
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('clasificacion.update', $clasificacion->id_clasificacion) }}" enctype="multipart/form-data">

                  @method('PATCH')
                  @csrf

                  <!-- Nombre -->
                  <div class="md-form">
                     <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre', $clasificacion->nombre)}}">
                     @error('nombre')
                       <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                     <label for="nombre">Nombre de Clasificación<span class="red-text">*</span></label>
                  </div>

                  <!-- Email -->
                  <div class="md-form">
                     <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control {{$errors->has('descripcion') ? 'has-error' : ''}}" length="3000" maxlength="3000" rows="3">{{old('descripcion', $clasificacion->descripcion)}}</textarea>
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
                     <label for="descripcion">Descripción de Clasificación<span class="red-text">*</span></label>

                  </div>

                  <!-- Image -->
                  <div class="md-form">
                    <div class="file-field">
                      <div class="btn btn-primary btn-sm float-left">
                        <span>Selecciona una Imagen</span>
                        <input type="file" name="imagen" id="imagen">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate form-control {{$errors->has('imagen') ? 'has-error' : ''}}" type="text" placeholder="Sube tu imagén*" id="imagen">
                      </div>
                    </div>
                    @if($errors->has('imagen'))
                      <script type="text/javascript">
                        var elemento = document.getElementById("imagen");
                        elemento.className += " is-invalid";
                      </script>
                      <small class="form-text text-muted mb-4 text-danger text-center">
                          {{$errors->first('imagen')}}
                      </small>
                    @endif
                  </div>

                  <div class="col-md-12 clearfix">

                    <div id="mdb-lightbox-ui"></div>

                    <div class="mdb-lightbox">

                      <figure class="col-md-5" style="left: 50%; transform: translate(-50%);">
                        <a href="{{$clasificacion->imagen}}" data-size="1600x1067">
                          <img src="{{$clasificacion->imagen}}" class="img-fluid">
                        </a>
                      </figure>

                    </div>

                  </div>

                  <!-- Sign in button -->
                  <div class="text-center my-3">
                    <button type="submit" class="btn btn-sm btn-success" title="Actualizar">
                      Actualizar
                    </button>
                    <a id="cancelar" class="btn btn-sm btn-outline-danger" title="Cancelar" href="{{ url('clasificacion') }}" style="background-color: #fd240c;">
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
