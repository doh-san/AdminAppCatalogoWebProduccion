@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-lg-10 mb-4 my-4 py-5">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-tag"></i> Consultando "{{ $forma->nombre }}"
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" >

                  <!-- First column -->
                  <div class="md-form mb-0">
                    <input type="text" id="form1" class="form-control validate" value="{{ $forma->nombre }}" disabled>
                    <label for="form1" data-error="wrong" data-success="right">Nombre de Forma de Pago</label>
                  </div>
                  <!-- First column -->

                  <!-- First column -->
                  <div class="md-form mb-0">
                    <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control" length="3000" maxlength="3000" rows="3" disabled>{{ $forma->descripcion }}</textarea>
                    <label for="form1" data-error="wrong" data-success="right">Descripción de Forma de Pago</label>
                  </div>
                  <!-- First column -->

                  <!-- Fourth row -->
                  <div class="row">
                    <div class="col-md-12 text-center my-3">
                      <a href="{{ url('forma_pago') }}" class="btn btn-sm btn-info" title="Regresar">Regresar</a>
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
