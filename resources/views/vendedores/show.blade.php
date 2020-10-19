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
                  <i class="fas fa-tag"></i> Consultando a {{ $vendedor->name }} {{ $vendedor->lastname }}
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
                        <input type="text" id="form1" class="form-control validate" value="{{ $vendedor->name }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Nombre(s)</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $vendedor->lastname }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Apellido(s)</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">
                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form2" class="form-control validate" value="{{ $vendedor->email }}" disabled>
                        <label for="form2" data-error="wrong" data-success="right">Correo electrónico</label>
                      </div>
                    </div>

                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form4" class="form-control validate" value="{{ $vendedor->telephone }}" disabled>
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
                        <input type="text" id="form5" class="form-control validate" value="{{ $vendedor->gender }}" disabled>
                        <label for="form5" data-error="wrong" data-success="right">Genero</label>
                      </div>
                    </div>
                    <!-- Second column -->

                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form6" class="form-control validate" value="{{ $vendedor->birthdate }}" disabled>
                        <label for="form6" data-error="wrong" data-success="right">Fecha de Nacimiento</label>
                      </div>
                    </div>
                  </div>
                  <!-- Second row -->

                  <!-- Second row -->
                  <div class="col-md-12 mb-4">

                    <!-- Pricing card -->
                    <div class="card pricing-card">

                      <!-- Price -->
                      <div class="price header white-text mdb-color rounded-top">
                        <div class="version">
                          <h5>Marcas Asignadas</h5>
                        </div>
                      </div>

                      <!-- Features -->
                      <div class="card-body striped mb-1">

                        <ul>
                          @forelse($vendedor->marcas as $marca)
                            <li>
                              <p class="mt-2"><i class="fas fa-angle-right pr-2"></i>{{$marca->nombre}}</p>
                            </li>
                          @empty
                              <li>
                                <p class="mt-2"><i class="fas fa-check green-text pr-2"></i>No Hay Marcas Asignadas</p>
                              </li>
                          @endforelse
                        </ul>

                      </div>
                      <!-- Features -->

                    </div>
                    <!-- Pricing card -->

                  </div>
                  <!-- Second row -->

                  <!-- First row -->
                  <div class="col-md-12 clearfix">

                    <!--First row-->
                    <div class="row ml-3 mr-3 pb-5 pt-1">

                      <!--First column-->
                      <div class="col-md-12">

                        <div id="mdb-lightbox-ui"></div>

                        <!--Full width lightbox-->
                        <div class="mdb-lightbox">

                          <figure class="col-md-4">
                            <a href="{{$vendedor->identification}}" data-size="1600x1067">
                              <img src="{{$vendedor->identification}}" class="img-fluid z-depth-1">
                            </a>
                            <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Identificación</p>
                          </figure>

                          <figure class="col-md-4">
                            <a href="{{$vendedor->voucher}}" data-size="1600x1067">
                              <img src="{{$vendedor->voucher}}" class="img-fluid z-depth-1">
                            </a>
                            <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Comprobante de Domicilio</p>
                          </figure>

                          <figure class="col-md-4">
                            <a href="{{$vendedor->photography}}" data-size="1600x1067">
                              <img src="{{$vendedor->photography}}" class="img-fluid z-depth-1">
                            </a>
                            <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Fotografía</p>
                          </figure>

                        </div>
                        <!--/Full width lightbox-->

                      </div>
                      <!--/First column-->

                    </div>
                    <!--/First row-->

                  </div>
                  <!-- First row -->

                  <!-- Fourth row -->
                  <div class="row">
                    <div class="col-md-12 text-center my-3">
                      <a href="{{ url('vendedores') }}" class="btn btn-sm btn-info" title="Regresar">Regresar</a>
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
