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
                  <i class="fas fa-tag"></i> Consultando a {{ $user->name }} {{ $user->lastname }}
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" >
                  <!-- First row -->

                  <div class="row">

                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $user->name }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Nombre(s)</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form2" class="form-control validate" value="{{ $user->email }}" disabled>
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
                        <input type="text" id="form3" class="form-control validate" value="{{ $user->lastname }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Apellido(s)</label>
                      </div>
                    </div>

                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form4" class="form-control validate" value="{{ $user->telephone }}" disabled>
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
                        <input type="text" id="form5" class="form-control validate" value="{{ $user->gender }}" disabled>
                        <label for="form5" data-error="wrong" data-success="right">Genero</label>
                      </div>
                    </div>
                    <!-- Second column -->

                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form6" class="form-control validate" value="{{ $user->birthdate }}" disabled>
                        <label for="form6" data-error="wrong" data-success="right">Fecha de Nacimiento</label>
                      </div>
                    </div>
                  </div>
                  <!-- Second row -->

                  <div class="col-md-12 clearfix">

                    <!--First row-->
                    <div class="row ml-3 mr-3 pb-5 pt-1">

                      <!--First column-->
                      <div class="col-md-12">

                        <div id="mdb-lightbox-ui"></div>

                        <!--Full width lightbox-->
                        <div class="mdb-lightbox">

                          <figure class="col-md-6">
                            <a href="{{$user->photography}}" data-size="1600x1067">
                              <img src="{{$user->photography}}" class="img-fluid z-depth-1">
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

                  <!-- Fourth row -->
                  <div class="row">
                    <div class="col-md-12 text-center my-3">
                      <a href="{{ url('administradores') }}" class="btn btn-sm btn-info" title="Regresar">Regresar</a>
                    </div>
                  </div>
                  <!-- Fourth row -->

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
