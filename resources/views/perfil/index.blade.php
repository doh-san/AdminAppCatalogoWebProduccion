@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-lg-10 mb-4">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold"><i class="fas fa-id-card"></i> Mi Perfil</h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Grid column -->
                <div class="col-md-6 offset-md-3 mb-4">

                  <!-- Rotating card -->
                  <div class="card-wrapper">
                    <div id="card-1" class="card card-rotating text-center">
                      <!-- Front Side -->
                      <div class="face front">
                        <!-- Image -->
                        <div class="card-up">
                          <img class="card-img-top" src="https://fondosmil.com/fondo/17021.jpg" alt="Team member card image">
                        </div>
                        <!-- Avatar -->
                        <div class="avatar mx-auto white">
                          @if (empty(Auth::user()->photography))
                          <img src="https://appcatalogo.s3-us-west-1.amazonaws.com/sin_imagen.png" class="rounded-circle img-fluid"
                            style="width:100px !important; height:100px !important" alt="First sample avatar image">
                          @else
                            <img src="{{ Auth::user()->photography }}" class="rounded-circle img-fluid"
                              style="width:100px !important; height:100px !important" alt="First sample avatar image">
                          @endif
                        </div>
                        <!-- Content -->
                        <div class="card-body">
                          <h4 class="font-weight-bold mt-1 mb-3">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h4>
                          <!-- Triggering button -->
                          <a class="btn btn-sm btn-info rotate-btn white-text" data-card="card-1">
                            <i class="fas fa-redo-alt white-text"></i> Ver Perfil</a>
                        </div>
                      </div>
                      <!-- Front Side -->
                      <!-- Back Side -->
                      <div class="face back">
                        <!-- Content -->
                        <div class="card-body">
                          <!-- Content -->
                          <h4 class="font-weight-bold mt-4 mb-2">
                            <strong>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</strong>
                          </h4>
                          <hr>
                          <p><span class="font-weight-bold mr-2">Correo Electrónico:</span>{{ Auth::user()->email }}</p>
                          <p><span class="font-weight-bold mr-2">Teléfono:</span>{{ Auth::user()->telephone }}</p>
                          <p><span class="font-weight-bold mr-2">Genero:</span>{{ Auth::user()->gender }}</p>
                          <p><span class="font-weight-bold mr-2">Fecha de Nacimiento:</span>{{ Auth::user()->birthdate }}</p>
                          <hr>
                          <a class="btn btn-sm btn-info rotate-btn white-text" data-card="card-1">
                            <i class="fas fa-redo-alt white-text"></i> Regresar</a>
                        </div>
                      </div>
                      <!-- Back Side -->
                    </div>
                  </div>
                  <!-- Rotating card -->

                </div>
                <!-- Grid column -->

                <!-- Edit Form -->
                {{--<form class="text-center col-md-10 offset-md-1" >
                  <!-- First row -->

                  <div class="row">

                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ Auth::user()->name }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Nombre(s)</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form2" class="form-control validate" value="{{ Auth::user()->email }}" disabled>
                        <label for="form2" data-error="wrong" data-success="right">Correo electrónico</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">
                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ Auth::user()->lastname }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Apellido(s)</label>
                      </div>
                    </div>

                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form4" class="form-control validate" value="{{ Auth::user()->telephone }}" disabled>
                        <label for="form4" data-error="wrong" data-success="right">Teléfono</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- Second row -->
                  <div class="row">

                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form5" class="form-control validate" value="{{ Auth::user()->gender }}" disabled>
                        <label for="form5" data-error="wrong" data-success="right">Genero</label>
                      </div>
                    </div>
                    <!-- Second column -->

                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form6" class="form-control validate" value="{{ Auth::user()->birthdate }}" disabled>
                        <label for="form6" data-error="wrong" data-success="right">Fecha de Nacimiento</label>
                      </div>
                    </div>
                  </div>
                  <!-- Second row -->

                  <!-- Third row -->
                  <!-- Third row -->

                  <!-- Fourth row -->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <a href="{{ route('cambiarContrasena') }}" class="btn btn-sm btn-info" title="Cambiar Contraseña">Cambiar Contraseña</a>

                      @if ($diff >= 1)
                        <a href="{{ route('editarPerfil') }}" class="btn btn-sm btn-success" title="Editar Perfil">Editar Perfil</a>
                      @endif
                    </div>
                  </div>
                  <!-- Fourth row -->

                </form>--}}
                <!-- Edit Form -->

                <div class="row">
                  <div class="col-md-12 text-center">
                    <a href="{{ route('cambiarContrasena') }}" class="btn btn-sm btn-info" title="Cambiar Contraseña">Cambiar Contraseña</a>

                    @if ($diff >= 1)
                      <a href="{{ route('editarPerfil') }}" class="btn btn-sm btn-success" title="Editar Perfil">Editar Perfil</a>
                    @endif
                  </div>
                </div>

              </div>
              <!-- Card content -->

            </div>
            <!-- Card -->

          </div>
          <!-- Second column -->

    </div>
</div>
@endsection
