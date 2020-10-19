@extends('layouts.app')

@section('content')

<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 mb-4">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-plus"></i> Agregar Nuevo Producto
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ url('productos') }}" enctype="multipart/form-data">

                  @csrf

                  <!-- First row -->
                  <div class="row">
                    <!-- Name -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}">
                         @error('nombre')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="nombre">Nombre Producto<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Lastname -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="cantidad" type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="{{ old('cantidad') }}">
                         @error('cantidad')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="cantidad">Cantidad Producto<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <!-- Second row -->
                  <div class="row">
                    <!-- Email -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="descuento" type="text" class="form-control @error('descuento') is-invalid @enderror" name="descuento" value="{{ old('descuento') }}">
                         @error('descuento')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="descuento">Descuento<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Telephone -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="precio_venta" type="text" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" value="{{ old('precio_venta') }}">
                         @error('precio_venta')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="precio_venta">Precio Venta<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <!-- Third row -->
                  <div class="row">
                    <!-- Email -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="precio_vendedor" type="text" class="form-control @error('precio_vendedor') is-invalid @enderror" name="precio_vendedor" value="{{ old('precio_vendedor') }}">
                         @error('precio_vendedor')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="precio_vendedor">Precio Vendedor<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Telephone -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <select class="mdb-select md-form colorful-select dropdown-ins" searchable="Buscar..." name="marca">
                           <option value="" disabled selected>Elige tu opción</option>
                           @foreach ($marcas as $marca)
                             @foreach ($marca->producto_marca as $pm)
                               <option value="{{ $marca->id_marca }}" {{ old('marca') == $marca->id_marca ? 'selected' : '' }}>{{ $marca->nombre . ' - ' . $pm->fecha }}</option>
                             @endforeach
                           @endforeach
                         </select>
                         <label class="mdb-main-label" style="text-align: left;">Marca<span class="red-text">*</span></label>
                         @error('marca')
                           <span class="help-block text-center red-text" role="alert">
                           <strong><small>{{ $message }}</small></strong>
                           </span>
                         @enderror
                      </div>
                    </div>
                  </div>

                  <!-- Fourth row -->
                  <div class="row">
                    <!-- Gender -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <select class="mdb-select md-form colorful-select dropdown-ins" searchable="Buscar..." name="categoria">
                           <option value="" disabled selected>Elige tu opción</option>
                           @foreach ($categorias as $categoria)
                             <option value="{{ $categoria->id_categoria }}" {{ old('categoria') == $categoria->id_categoria ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                           @endforeach
                         </select>
                         <label class="mdb-main-label" style="text-align: left;">Categoria<span class="red-text">*</span></label>
                         @error('categoria')
                           <span class="help-block text-center red-text" role="alert">
                           <strong><small>{{ $message }}</small></strong>
                           </span>
                         @enderror
                      </div>
                    </div>

                    <!-- Role -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="puntos" type="text" class="form-control @error('puntos') is-invalid @enderror" name="puntos" value="{{ old('puntos') }}">
                         @error('puntos')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="puntos">Puntos por cada $100 de venta<span class="red-text">*</span></label>
                      </div>
                    </div>
                  </div>

                  <div class="md-form">
                    <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control {{$errors->has('descripcion') ? 'has-error' : ''}}" length="3000" maxlength="3000" rows="3">{{ old('descripcion') }}</textarea>
                    <!--CARGA EL ERROR DE VALIDACION-->
                    @if($errors->has('descripcion'))
                      <script type="text/javascript">
                        var elemento = document.getElementById("descripcion");
                        elemento.className += " is-invalid";
                      </script>
                      <small class="form-text text-muted mb-4 text-danger text-center">
                          {{$errors->first('descripcion')}}
                      </small>
                    @endif
                    <label for="descripcion">Descripción Producto<span class="red-text">*</span></label>
                  </div>

                  <!-- Image -->
                  <div class="md-form">
                    <div class="file-field">
                      <div class="btn btn-primary btn-sm float-left">
                        <span>Selecciona tus Imagenes</span>
                        <input type="file" name="imagen[]" id="imagen" multiple="">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate form-control {{$errors->has('imagen') ? 'has-error' : ''}}" type="text" placeholder="Sube tus imagenes" id="imagen">
                      </div>
                    </div>
                    @if($errors->has('imagen'))
                      <script type="text/javascript">
                        var elemento = document.getElementById("imagen");
                        elemento.className += " is-invalid";
                      </script>
                      <small class="form-text text-muted mb-4 text-danger text-center">
                          {{$errors->first('imagen')}}
                      </small>
                    @endif
                  </div>

                  <div class="md-form py-3">
                     <select class="mdb-select md-form colorful-select dropdown-ins" name="prioridad" id="prioridad" searchable="Buscar..">
                       <option value="" disabled selected>Elige tu opción</option>
                     </select>
                     <label class="mdb-main-label" style="text-align: left;">Selecciona la imagen prioritaria<span class="red-text">*</span></label>
                     @error('prioridad')
                       <span class="help-block text-center red-text" role="alert">
                       <strong><small>{{ $message }}</small></strong>
                       </span>
                     @enderror
                  </div>

                  <h5 class="font-weight-bold text-center">Imagenes de Producto</h5>

                  <div id="preview" class="gallery"></div>

                  <!-- Sign in button -->
                  <div class="text-center my-5">
                    <button type="submit" class="btn btn-sm btn-success" title="Guardar">
                      Guardar
                    </button>
                    <a id="cancelar" class="btn btn-sm btn-outline-danger" title="Cancelar" href="{{ url('productos') }}" style="background-color: #fd240c;">
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
