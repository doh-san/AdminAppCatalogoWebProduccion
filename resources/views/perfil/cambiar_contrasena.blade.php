@extends('layouts.app')

@section('content')

<div class="container my-5 py-2">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-lg-10 mb-4 my-4 py-1">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold"><i class="fas fa-user-lock"></i> Cambiar Contraseña</h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('validarCambiarContrasena') }}">

                  @csrf

                  <div class="md-form">
                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                     @error('password')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                     <label for="password">Contraseña*</label>
                  </div>

                  <div class="md-form">
                     <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                     @error('password_confirmation')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                     <label for="password_confirmation">Repetir Contraseña*</label>
                  </div>

                  <div class="text-center my-3">
                    <button type="submit" class="btn btn-sm btn-success" title="Cambiar Contraseña">
                      Cambiar Contraseña
                    </button>
                    <a id="cancelar" class="btn btn-sm btn-outline-danger" title="Cancelar" href="{{ url('perfil') }}" style="background-color: #fd240c;">
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
