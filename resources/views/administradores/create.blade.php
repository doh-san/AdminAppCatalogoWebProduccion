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
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-plus"></i> Agregar Nuevo Administrador
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ url('administradores') }}" enctype="multipart/form-data">

                  @csrf

                  <!-- First row -->
                  <div class="row">
                    <!-- Name -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                         @error('name')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="name">Nombre(s)<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Lastname -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}">
                         @error('lastname')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="lastname">Apellido(s)<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <!-- Second row -->
                  <div class="row">
                    <!-- Email -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                         @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="email">Correo Electrónico<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Telephone -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}">
                         @error('telephone')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="telephone">Teléfono<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <!-- Third row -->
                  <div class="row">
                    <!-- Gender -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <select class="mdb-select md-form colorful-select dropdown-ins" name="gender">
                           <option value="" disabled selected>Elige tu opción</option>
                           <option value="Mujer" {{ old('gender') == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                           <option value="Hombre" {{ old('gender') == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                         </select>
                         <label class="mdb-main-label" style="text-align: left;">Genero<span class="red-text">*</span></label>
                         @error('gender')
                           <span class="help-block text-center red-text" role="alert">
                           <strong><small>{{ $message }}</small></strong>
                           </span>
                         @enderror
                      </div>
                    </div>

                    <!-- Role -->
                    <div class="col-md-6">
                      <div class="md-form mb-0 input-with-post-icon datepicker">
                         <input placeholder="Selecciona Fecha" type="text" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}">
                         <label for="birthdate">Fecha de Nacimiento<span class="red-text">*</span></label>
                         <i class="fas fa-calendar input-prefix" tabindex=0></i>
                         @error('birthdate')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                      </div>
                    </div>
                  </div>

                  <!-- Level -->
                  <div class="md-form">
                     <select class="mdb-select md-form colorful-select dropdown-ins" name="level">
                       <option value="" disabled selected>Elige tu opción</option>
                       <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>Nivel 2</option>
                       <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>Nivel 3</option>
                     </select>
                     <label class="mdb-main-label" style="text-align: left;">Nivel Admin<span class="red-text">*</span></label>
                     @error('level')
                       <span class="help-block text-center red-text" role="alert">
                       <strong><small>{{ $message }}</small></strong>
                       </span>
                     @enderror
                  </div>

                  <!-- Image -->
                  <div class="md-form">
                    <div class="file-field">
                      <div class="btn btn-primary btn-sm float-left">
                        <span>Selecciona una Imagen</span>
                        <input type="file" name="photography" id="photography">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate form-control {{$errors->has('photography') ? 'has-error' : ''}}" type="text" placeholder="Sube tu imagen de perfil" id="photography">
                      </div>
                    </div>
                    @if($errors->has('photography'))
                      <script type="text/javascript">
                        var elemento = document.getElementById("photography");
                        elemento.className += " is-invalid";
                      </script>
                      <small class="form-text text-muted mb-4 text-danger text-center">
                          {{$errors->first('photography')}}
                      </small>
                    @endif
                  </div>

                  <!-- Fifth row -->
                  <div class="row">
                    <!-- Password -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                         @error('password')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="password">Contraseña<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Repeat password -->
                    <div class="col-md-6">
                      <div class="md-form">
                         <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                         @error('password_confirmation')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="password_confirmation">Repetir Contraseña<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <!-- Sign in button -->
                  <div class="text-center my-3">
                    <button type="submit" class="btn btn-sm btn-success" title="Guardar">
                      Guardar
                    </button>
                    <a id="cancelar" class="btn btn-sm btn-outline-danger" title="Cancelar" href="{{ url('administradores') }}" style="background-color: #fd240c;">
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
