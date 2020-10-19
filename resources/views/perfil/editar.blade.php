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
                <h5 class="mb-0 font-weight-bold"><i class="fas fa-user-edit"></i> Editar Perfil</h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('validarEditarPerfil') }}" enctype="multipart/form-data">

                  @csrf

                  <div class="row">
                    <!-- Name -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', Auth::user()->name)}}">
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
                         <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{old('lastname', Auth::user()->lastname)}}">
                         @error('lastname')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="lastname">Apellido(s)<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <!-- Email -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email', Auth::user()->email)}}" autocomplete="email">
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
                         <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{old('telephone', Auth::user()->telephone)}}">
                         @error('telephone')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="telephone">Teléfono<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <!-- Gender -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <select class="mdb-select md-form colorful-select dropdown-ins" name="gender">
                           <option value="" disabled selected>Elige tu opción</option>
                           <option value="Mujer" {{ old('gender', Auth::user()->gender) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                           <option value="Hombre" {{ old('gender', Auth::user()->gender) == 'Hombre' ? 'selected' : '' }}>Hombre</option>
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
                         <input placeholder="Selecciona Fecha" type="text" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate', Auth::user()->birthdate) }}">
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

                  @if (Auth::user()->role > 1)
                    <!-- Image -->
                    <div class="md-form">
                      <div class="file-field">
                        <div class="btn btn-primary btn-sm float-left">
                          <span>Selecciona una Imagen</span>
                          <input type="file" name="identification" id="identification">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate form-control {{$errors->has('identification') ? 'has-error' : ''}}" type="text" placeholder="Sube tu identificacion" id="identification">
                        </div>
                      </div>
                      @if($errors->has('identification'))
                        <script type="text/javascript">
                          var elemento = document.getElementById("identification");
                          elemento.className += " is-invalid";
                        </script>
                        <small class="form-text text-muted mb-4 text-danger text-center">
                            {{$errors->first('identification')}}
                        </small>
                      @endif
                    </div>

                    <!-- Image -->
                    <div class="md-form">
                      <div class="file-field">
                        <div class="btn btn-primary btn-sm float-left">
                          <span>Selecciona una Imagen</span>
                          <input type="file" name="voucher" id="voucher">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate form-control {{$errors->has('voucher') ? 'has-error' : ''}}" type="text" placeholder="Sube tu comprobante de domicilio" id="voucher">
                        </div>
                      </div>
                      @if($errors->has('voucher'))
                        <script type="text/javascript">
                          var elemento = document.getElementById("voucher");
                          elemento.className += " is-invalid";
                        </script>
                        <small class="form-text text-muted mb-4 text-danger text-center">
                            {{$errors->first('voucher')}}
                        </small>
                      @endif
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

                    <div class="col-md-12 clearfix">

                      <!--First row-->
                      <div class="row ml-3 mr-3 pb-5 pt-1">

                        <!--First column-->
                        <div class="col-md-12">

                          <div id="mdb-lightbox-ui"></div>

                          <!--Full width lightbox-->
                          <div class="mdb-lightbox">

                            <figure class="col-md-4">
                              <a href="{{Auth::user()->identification}}" data-size="1600x1067">
                                <img src="{{Auth::user()->identification}}" class="img-fluid z-depth-1">
                              </a>
                              <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Identificación</p>
                            </figure>

                            <figure class="col-md-4">
                              <a href="{{Auth::user()->voucher}}" data-size="1600x1067">
                                <img src="{{Auth::user()->voucher}}" class="img-fluid z-depth-1">
                              </a>
                              <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Comprobante de Domicilio</p>
                            </figure>

                            <figure class="col-md-4">
                              <a href="{{Auth::user()->photography}}" data-size="1600x1067">
                                <img src="{{Auth::user()->photography}}" class="img-fluid z-depth-1">
                              </a>
                              <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen de Perfil</p>
                            </figure>

                          </div>
                          <!--/Full width lightbox-->

                        </div>
                        <!--/First column-->

                      </div>
                      <!--/First row-->

                    </div>
                  @else
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

                    <div class="col-md-12 clearfix">

                      <!--First row-->
                      <div class="row ml-3 mr-3 pb-5 pt-1">

                        <!--First column-->
                        <div class="col-md-12">

                          <div id="mdb-lightbox-ui"></div>

                          <!--Full width lightbox-->
                          <div class="mdb-lightbox">

                            <figure class="col-md-6">
                              <a href="{{Auth::user()->photography}}" data-size="1600x1067">
                                <img src="{{Auth::user()->photography}}" class="img-fluid z-depth-1">
                              </a>
                              <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen de Perfil</p>
                            </figure>

                          </div>
                          <!--/Full width lightbox-->

                        </div>
                        <!--/First column-->

                      </div>
                      <!--/First row-->

                    </div>
                  @endif

                  <div class="text-center my-3">
                    <button type="submit" class="btn btn-sm btn-success" title="Actualizar">
                      Actualizar
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
