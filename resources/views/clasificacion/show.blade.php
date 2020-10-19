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
                  <i class="fas fa-tag"></i> Consultando "{{ $clasificacion->nombre }}"
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" >
                  <!-- First row -->
                  <div class="md-form">
                    <input type="text" id="form1" class="form-control validate" value="{{ $clasificacion->nombre }}" disabled>
                    <label for="form1" data-error="wrong" data-success="right">Nombre de Clasificación</label>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="md-form mb-0">
                    <textarea type="text" id="form2" class="md-textarea form-control" length="3000" maxlength="3000" rows="3" disabled>{{ $clasificacion->descripcion }}</textarea>
                    <label for="form2">Descripción de Clasificación</label>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
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
                  <!-- First row -->

                  <!-- Fourth row -->
                  <div class="row">
                    <div class="col-md-12 text-center my-3">
                      <a href="{{ url('clasificacion') }}" class="btn btn-sm btn-info" title="Regresar">Regresar</a>
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
