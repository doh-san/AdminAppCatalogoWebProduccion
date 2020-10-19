@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-lg-10 mb-4">

            <!-- Card -->
            <div class="card card-cascade narrower">

              @foreach($venta as $v)

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-tag"></i> Detalle de Venta
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
                        <input type="text" id="form1" class="form-control validate" value="{{ $v->nombre_producto }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Nombre Producto</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $v->cantidad_producto }}" disabled>
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
                        <input type="text" id="form1" class="form-control validate" value="{{ ($v->cantidad_producto * $v->precio_vendedor) }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Total Pagado</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $v->precio_vendedor }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Precio a Vendedor</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">
                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $v->marca }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Marca</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $v->categoria }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Categoria</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">
                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $v->fecha }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Fecha</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $v->nombre_vendedor }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Nombre Vendedor</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">
                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $v->forma_pago }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Forma Pago</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $v->fecha_compra }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Fecha Compra</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <!-- First row -->
                  <div class="row">
                    <!-- First column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form1" class="form-control validate" value="{{ $v->fecha_entrega }}" disabled>
                        <label for="form1" data-error="wrong" data-success="right">Fecha Entrega</label>
                      </div>
                    </div>
                    <!-- Second column -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                        <input type="text" id="form3" class="form-control validate" value="{{ $v->codigo_pedido }}" disabled>
                        <label for="form3" data-error="wrong" data-success="right">Código Pedido</label>
                      </div>
                    </div>
                  </div>
                  <!-- First row -->

                  <div class="md-form mb-0">
                    <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control" length="3000" maxlength="3000" rows="3" disabled>{{ $v->descripcion }}</textarea>
                    <label for="form1" data-error="wrong" data-success="right">Descripción Producto</label>
                  </div>

                  <!-- Fourth row -->
                  <div class="row">
                    <div class="col-md-12 text-center my-3">
                      <a href="{{ url('ventas') }}" class="btn btn-sm btn-info" title="Regresar">Regresar</a>
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
