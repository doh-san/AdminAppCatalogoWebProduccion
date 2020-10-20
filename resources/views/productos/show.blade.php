@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-lg-10 mb-4">

            <!-- Card -->
            <div class="card card-cascade narrower">

              @foreach($producto as $prod)

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-tag"></i> Consultando "{{ $prod->nombre }}"
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
                        <input type="text" id="form1" class="form-control validate" value="{{ $prod->nombre }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Nombre Producto</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $prod->cantidad }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Cantidad Producto</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">

                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $prod->descuento }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Descuento</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $prod->precio_venta }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Precio Venta</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- Second row -->
                  <div class="row">

                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $prod->precio_vendedor }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Precio Vendedor</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $prod->clasificacion }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Clasificación</label>
                      </div>
                    </div>
                  </div>
                  <!-- Second row -->

                  <!-- Second row -->
                  <div class="row">

                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $prod->categoria }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Categoria</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $prod->puntos }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Puntos por cada $100 de venta</label>
                      </div>
                    </div>
                  </div>
                  <!-- Second row -->

                  <div class="md-form mb-0">
                    <input type="text" id="form3" class="form-control validate" value="{{ $prod->marca }}" disabled>
                    <label for="form3" data-error="wrong" data-success="right">Marca</label>
                  </div>

                  <div class="md-form mb-0">
                    <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control" length="3000" maxlength="3000" rows="3" disabled>{{ $prod->descripcion }}</textarea>
                    <label for="form1" data-error="wrong" data-success="right">Descripción Producto</label>
                  </div>

                  <!-- First row -->
                  <div class="col-md-12 clearfix">

                    <h5 class="font-weight-bold my-5 text-center">Imagenes de Producto</h5>

                    <!--First row-->
                    <div class="row ml-3 mr-3 pb-5 pt-1">

                      <!--First column-->
                      <div class="col-md-12">

                        <div id="mdb-lightbox-ui"></div>

                        <!--Full width lightbox-->
                        <div class="mdb-lightbox">

                          @php
                            $con = count($pi)
                          @endphp

                          @if ($con == 1)
                            @foreach($pi as $img)
                              <figure class="col-md-6">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                              </figure>
                            @endforeach
                          @elseif ($con == 2)
                            @foreach($pi as $img)
                              <figure class="col-md-6">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                              </figure>
                            @endforeach
                          @elseif ($con == 3)
                            @foreach($pi as $img)
                              <figure class="col-md-4">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                              </figure>
                            @endforeach
                          @elseif ($con == 4)
                            @foreach($pi as $img)
                              <figure class="col-md-3">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                              </figure>
                            @endforeach
                          @elseif ($con > 4)
                            @foreach($pi as $img)
                              <figure class="col-md-3">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                              </figure>
                            @endforeach
                          @endif

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
                      <a href="{{ url('productos') }}" class="btn btn-sm btn-info" title="Regresar">Regresar</a>
                    </div>
                  </div>
                  <!-- Fourth row -->

                </form>
                <!-- Edit Form -->

              </div>
              <!-- Card content -->

              @endforeach

            </div>
            <!-- Card -->

          </div>
          <!-- Second column -->

    </div>
</div>
@endsection
