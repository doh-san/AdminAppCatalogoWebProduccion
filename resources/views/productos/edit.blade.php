@extends('layouts.app')

@section('content')

<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row justify-content-center">

      <!-- Second column -->
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 mb-4">

            <!-- Card -->
            <div class="card card-cascade narrower">

              @foreach($producto as $prod)

              <!-- Card image -->
              <div class="view view-cascade gradient-card-header mdb-color">
                <h5 class="mb-0 font-weight-bold">
                  <i class="fas fa-edit"></i> Editando "{{ $prod->nombre }}"
                </h5>
              </div>
              <!-- Card image -->

              <!-- Card content -->
              <div class="card-body card-body-cascade text-center">

                <!-- Edit Form -->
                <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('productos.update', $prod->id_producto) }}" enctype="multipart/form-data">

                  @method('PATCH')
                  @csrf

                  <!-- First row -->
                  <div class="row">
                    <!-- Name -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre', $prod->nombre)}}">
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
                         <input id="cantidad" type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="{{old('cantidad', $prod->cantidad)}}">
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
                    <!-- Name -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="descuento" type="text" class="form-control @error('descuento') is-invalid @enderror" name="descuento" value="{{old('descuento', $prod->descuento)}}">
                         @error('descuento')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="descuento">Descuento<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Lastname -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="precio_venta" type="text" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" value="{{old('precio_venta', $prod->precio_venta)}}">
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
                    <!-- Gender -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <input id="precio_vendedor" type="text" class="form-control @error('precio_vendedor') is-invalid @enderror" name="precio_vendedor" value="{{old('precio_vendedor', $prod->precio_vendedor)}}">
                         @error('precio_vendedor')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                         @enderror
                         <label for="precio_vendedor">Precio Vendedor<span class="red-text">*</span></label>
                      </div>
                    </div>

                    <!-- Role -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <select class="mdb-select md-form colorful-select dropdown-ins" name="clasificacion">
                           <option value="" disabled selected>Elige tu opción</option>
                           @foreach ($clasificaciones as $clasificacion)
                             <option value="{{ $clasificacion->id_clasificacion }}" {{ old('clasificacion') == $clasificacion->id_clasificacion ? 'selected' : '' }} {{ $prod->id_clasificacion == $clasificacion->id_clasificacion ? 'selected' : '' }}>{{ $clasificacion->nombre }}</option>
                           @endforeach
                         </select>
                         <label class="mdb-main-label" style="text-align: left;">Clasificación<span class="red-text">*</span></label>
                         @error('clasificacion')
                           <span class="help-block text-center red-text" role="alert">
                           <strong><small>{{ $message }}</small></strong>
                           </span>
                         @enderror
                      </div>
                    </div>
                  </div>

                  <!-- Third row -->
                  <div class="row">
                    <!-- Gender -->
                    <div class="col-md-6">
                      <div class="md-form mb-0">
                         <select class="mdb-select md-form colorful-select dropdown-ins" name="categoria">
                           <option value="" disabled selected>Elige tu opción</option>
                           @foreach ($categorias as $categoria)
                             <option value="{{ $categoria->id_categoria }}" {{ old('categoria') == $categoria->id_categoria ? 'selected' : '' }} {{ $prod->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
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
                         <input id="puntos" type="text" class="form-control @error('puntos') is-invalid @enderror" name="puntos" value="{{old('puntos', $prod->puntos)}}">
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
                     <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{old('marca', $prod->marca)}}">
                     @error('marca')
                       <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                       </span>
                     @enderror
                     <label for="marca">Puntos por cada $100 de venta<span class="red-text">*</span></label>
                  </div>

                  <div class="md-form">
                    <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control {{$errors->has('descripcion') ? 'has-error' : ''}}" length="3000" maxlength="3000" rows="3">{{ old('descripcion', $prod->descripcion)}}</textarea>
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
                        <span>Selecciona una Imagen</span>
                        <input type="file" name="imagen[]" id="imagen" multiple="">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate form-control {{$errors->has('imagen') ? 'has-error' : ''}}" type="text" placeholder="Sube tu imagen" id="imagen">
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

                  <div class="md-form py-3" id="divPrioridad" style="display: none">
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

                  <div id="galedit" style="display: none">
                    <h5 class="font-weight-bold text-center">Imagenes de Producto</h5>
                    <div id="preview" class="gallery"></div>
                  </div>


                  <div class="col-md-12 clearfix">

                    <div class="md-form py-3" id="divPrioridadE" style="display: block">
                       <select class="mdb-select md-form colorful-select dropdown-ins" name="prioridade">
                         <option value="" disabled>Elige tu opción</option>
                         @php
                           $dp = 0
                         @endphp
                         @foreach($pi as $img)
                           @php
                             $dp = $dp + 1
                           @endphp
                           <option value="{{ $dp }}" {{ old('prioridade') == $dp ? 'selected' : '' }} {{ $img->principal == 1 ? 'selected' : '' }}>Imagen {{ $dp }}</option>
                         @endforeach
                       </select>
                       <label class="mdb-main-label" style="text-align: left;">Selecciona la imagen prioritaria<span class="red-text">*</span></label>
                       @error('prioridade')
                         <span class="help-block text-center red-text" role="alert">
                         <strong><small>{{ $message }}</small></strong>
                         </span>
                       @enderror
                    </div>

                    <!--First row-->
                    <div class="row ml-3 mr-3 pb-5 pt-1" id="gallerye">

                      <!--First column-->
                      <div class="col-md-12">

                        <h5 class="font-weight-bold text-center">Imagenes de Producto</h5>

                        <div id="mdb-lightbox-ui"></div>

                        <!--Full width lightbox-->
                        <div class="mdb-lightbox">

                          @php
                            $con = count($pi);
                            $imgCon = 0;
                          @endphp

                          @if ($con == 1)
                            @foreach($pi as $img)
                              @php
                                $imgCon = $imgCon + 1
                              @endphp
                              <figure class="col-md-6">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                                <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen {{ $imgCon }}</p>
                              </figure>
                            @endforeach
                          @elseif ($con == 2)
                            @foreach($pi as $img)
                              @php
                                $imgCon = $imgCon + 1
                              @endphp
                              <figure class="col-md-6">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                                <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen {{ $imgCon }}</p>
                              </figure>
                            @endforeach
                          @elseif ($con == 3)
                            @foreach($pi as $img)
                              @php
                                $imgCon = $imgCon + 1
                              @endphp
                              <figure class="col-md-4">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                                <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen {{ $imgCon }}</p>
                              </figure>
                            @endforeach
                          @elseif ($con == 4)
                            @foreach($pi as $img)
                              @php
                                $imgCon = $imgCon + 1
                              @endphp
                              <figure class="col-md-3">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                                <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen {{ $imgCon }}</p>
                              </figure>
                            @endforeach
                          @elseif ($con > 4)
                            @foreach($pi as $img)
                              @php
                                $imgCon = $imgCon + 1
                              @endphp
                              <figure class="col-md-3">
                                <a href="{{$img->ruta}}" data-size="1600x1067">
                                  <img src="{{$img->ruta}}" class="img-fluid z-depth-1">
                                </a>
                                <p class="text-uppercase font-weight-bold blue-grey-text mt-4">Imagen {{ $imgCon }}</p>
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

                  <!-- Sign in button -->
                  <div class="text-center my-5">
                    <button type="submit" class="btn btn-sm btn-success" title="Actualizar">
                      Actualizar
                    </button>
                    <a id="cancelar" class="btn btn-sm btn-outline-danger" title="Cancelar" href="{{ url('productos') }}" style="background-color: #fd240c;">
                      Cancelar
                    </a>
                  </div>

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
