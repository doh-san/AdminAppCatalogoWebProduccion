<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <link href="{{ asset('img/icon2.ico')}}" rel="shortcut icon" type="image/x-icon"/>
      <!-- Font Awesome -->
      <script src="https://kit.fontawesome.com/a4f63cacd6.js"></script>
      <!-- Bootstrap core CSS -->
      <link href="{{ asset('mdb/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="{{ asset('mdb/css/mdb.min.css')}}" rel="stylesheet">
      <style media="screen">
         main {
         min-height: 606px;
         }
         .loader-page {
         position: fixed;
         z-index: 25000;
         background: rgb(255, 255, 255);
         left: 0px;
         top: 0px;
         height: 100%;
         width: 100%;
         display: flex;
         align-items: center;
         justify-content: center;
         transition:all .3s ease;
         }
         .loader-page::before {
         content: "";
         position: absolute;
         border: 2px solid rgb(50, 150, 176);
         width: 60px;
         height: 60px;
         border-radius: 50%;
         box-sizing: border-box;
         border-left: 2px solid rgba(50, 150, 176,0);
         border-top: 2px solid rgba(50, 150, 176,0);
         animation: rotarload 1s linear infinite;
         transform: rotate(0deg);
         }
         @keyframes rotarload {
         0%   {transform: rotate(0deg)}
         100% {transform: rotate(360deg)}
         }
         .loader-page::after {
         content: "";
         position: absolute;
         border: 2px solid rgba(50, 150, 176,.5);
         width: 60px;
         height: 60px;
         border-radius: 50%;
         box-sizing: border-box;
         border-left: 2px solid rgba(50, 150, 176, 0);
         border-top: 2px solid rgba(50, 150, 176, 0);
         animation: rotarload 1s ease-out infinite;
         transform: rotate(0deg);
         }
      </style>
   </head>
   <body class="fixed-sn mdb-skin">
      <div class="loader-page"></div>
      <div id="app">
         <!--Double navigation-->
         <header>
            <!-- Sidebar navigation -->
            <div id="slide-out" class="side-nav fixed">
               <ul class="custom-scrollbar">
                  <!-- Logo -->
                  <li>
                     <div class="logo-wrapper waves-light">
                        <a href="#"><img src="{{ asset('img/ZAKUHPY_BLANCO.png')}}" class="img-fluid flex-center"></a>
                     </div>
                  </li>
                  <!--/. Logo -->
                  <!-- Side navigation links -->
                  <li>
                     <ul class="collapsible collapsible-accordion">
                        {{--
                        <li>
                           <a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i> Submit
                           blog<i class="fas fa-angle-down rotate-icon"></i></a>
                           <div class="collapsible-body">
                              <ul>
                                 <li><a href="#" class="waves-effect">Submit listing</a>
                                 </li>
                                 <li><a href="#" class="waves-effect">Registration form</a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                        --}}
                        <li><a href="{{ url('home') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-home"></i>Inicio</a></li>
                        @if (Auth::user()->role != '2')
                          <li><a href="{{ url('productos') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-boxes"></i>Productos Publicados</a></li>
                          <li><a href="{{ url('clasificacion') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-tags"></i> Clasificacion</a></li>
                          <li><a href="{{ url('categorias') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-list"></i> Categorias</a></li>
                          <li><a href="{{ url('vendedores') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-users"></i>Vendedores</a></li>
                          <li><a href="{{ url('ventas') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-file-invoice-dollar"></i> Ventas Realizadas</a></li>
                          <li><a href="{{ url('administradores') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-user-tie"></i> Administradores</a></li>
                          <li><a href="{{ url('forma_pago') }}" class="collapsible-header waves-effect arrow-r"><i class="fas fa-money-bill-wave"></i>Formas de Pago</a></li>
                        @endif
                     </ul>
                  </li>
                  <!--/. Side navigation links -->
               </ul>
               <div class="sidenav-bg mask-strong"></div>
            </div>
            <!--/. Sidebar navigation -->
            <!-- Navbar -->
            <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
               <!-- SideNav slide-out button -->
               <div class="float-left">
                  <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
               </div>
               <!-- Breadcrumb-->
               <div class="breadcrumb-dn mr-auto">
                  <p>ZAKUHPY</p>
               </div>
               <ul class="nav navbar-nav nav-flex-icons ml-auto">
                  {{--
                  <li class="nav-item">
                     <a class="nav-link"><i class="fas fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
                  </li>
                  --}}
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->photography }}" class="rounded-circle z-depth-0"
                          alt="avatar image" height="30" width="30">
                     {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                     </a>
                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('perfil') }}">Mi Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#modalLogout">
                        {{ __('Cerrar Sesión') }}
                        </a>
                     </div>
                  </li>
               </ul>
            </nav>
            <!-- /.Navbar -->
         </header>
         <!--/.Double navigation-->
         <main class="py-4">
            @yield('content')
         </main>
      </div>
      <!-- Footer -->
      <footer class="page-footer font-small mdb darken-3">
         <!-- Copyright -->
         <div class="footer-copyright text-center py-3">Realizado por:
            <a target="_blank" href="https://dohsan.net/">
            <img src="{{ asset('img/icon.ico')}}" width="15"/> DOHSAN
            </a>
         </div>
         <!-- Copyright -->
      </footer>
      <!-- Footer -->
      <!-- Modal Logout -->
      <div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog cascading-modal modal-notify modal-danger" role="document">
            <!--Content-->
            <div class="modal-content text-center">
               <!--Header-->
               <div class="modal-header d-flex justify-content-center">
                  <p class="heading">¿Estas seguro que desea cerrar sesiòn?</p>
               </div>
               <!--Body-->
               <div class="modal-body">
                  <i class="fas fa-sign-out-alt fa-4x animated rotateIn"></i>
               </div>
               <!--Footer-->
               <div class="modal-footer flex-center">
                  <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-md">Si</button>
                  <a type="button" class="btn btn-md btn-outline-danger waves-effect" data-dismiss="modal">No</a>
               </div>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
            </div>
            <!--/.Content-->
         </div>
      </div>
      <!-- Modal Logout -->
   </body>

   <!--  SCRIPTS  -->
   <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
   <script type="text/javascript">
      @if (session()->has('create_success'))
        Swal.fire({
          title: "Exito",
          text: "Se ha guardado correctamente el registro",
          icon: "success",
          timer: 5000,
        });
        @elseif(session()->has('update_success'))
          Swal.fire({
            title: "Exito",
            text: "Se ha actualizado correctamente el registro",
            icon: "success",
            timer: 5000,
          });
      @elseif(session()->has('delete_success'))
        Swal.fire({
          title: "Exito",
          text: "Se ha eliminado correctamente el registro",
          icon: "success",
          timer: 5000,
        });
      @elseif(session()->has('update_password_success'))
        Swal.fire({
          title: "Exito",
          text: "Se actualizo exitosamente su contraseña",
          icon: "success",
          timer: 5000,
        });
      @elseif(session()->has('update_profile_success'))
        Swal.fire({
          title: "Exito",
          text: "Se actualizo exitosamente su perfil",
          icon: "success",
          timer: 5000,
        });
      @elseif(session()->has('send_mail_success'))
        Swal.fire({
          title: "Exito",
          text: "Se ha enviado el reporte de ventas al correo ingresado",
          icon: "success",
          timer: 5000,
        });
      @elseif(session()->has('error_clasificacion_fk'))
        var emf = '{{ Session::get("error_clasificacion_fk") }}';
        Swal.fire({
          title: "Error",
          text: emf,
          icon: "error",
          timer: 8000,
        });
      @elseif(session()->has('error_clasificacion_2_fk'))
        var emf2 = '{{ Session::get("error_clasificacion_2_fk") }}';
        Swal.fire({
          title: "Error",
          text: emf2,
          icon: "error",
          timer: 8000,
        });
      @elseif(session()->has('error_categoria_fk'))
        var ecf = '{{ Session::get("error_categoria_fk") }}';
        Swal.fire({
          title: "Error",
          text: ecf,
          icon: "error",
          timer: 8000,
        });
      @elseif(session()->has('error_forma_pago_fk'))
        var eff = '{{ Session::get("error_forma_pago_fk") }}';
        Swal.fire({
          title: "Error",
          text: eff,
          icon: "error",
          timer: 8000,
        });
      @elseif(session()->has('send_mail_error'))
        var esr = '{{ Session::get("send_mail_error") }}';
        Swal.fire({
          title: "Error",
          text: esr,
          icon: "error",
          timer: 8000,
        });
      @elseif(session()->has('error_exception_forma_pago'))
        var eefp = '{{ Session::get("error_exception_forma_pago") }}';
        Swal.fire({
          title: "Excepción",
          text: eefp,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_administrador'))
        var eea = '{{ Session::get("error_exception_administrador") }}';
        Swal.fire({
          title: "Excepción",
          text: eea,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_categoria'))
        var eec = '{{ Session::get("error_exception_categoria") }}';
        Swal.fire({
          title: "Excepción",
          text: eec,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_clasificacion'))
        var eem = '{{ Session::get("error_exception_clasificacion") }}';
        Swal.fire({
          title: "Excepción",
          text: eem,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_perfil'))
        var eep = '{{ Session::get("error_exception_perfil") }}';
        Swal.fire({
          title: "Excepción",
          text: eep,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_producto'))
        var eepr = '{{ Session::get("error_exception_producto") }}';
        Swal.fire({
          title: "Excepción",
          text: eepr,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_vendedor'))
        var eev = '{{ Session::get("error_exception_vendedor") }}';
        Swal.fire({
          title: "Excepción",
          text: eev,
          icon: "warning",
        });
      @elseif(session()->has('error_exception_ventas'))
        var eevt = '{{ Session::get("error_exception_ventas") }}';
        Swal.fire({
          title: "Excepción",
          text: eevt,
          icon: "warning",
        });
      @endif
   </script>
   <!-- JQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script type="text/javascript" src="{{ asset('mdb/js/jquery.min.js')}}"></script>
   <!-- Bootstrap tooltips -->
   <script type="text/javascript" src="{{ asset('mdb/js/popper.min.js')}}"></script>
   <!-- Bootstrap core JavaScript -->
   <script type="text/javascript" src="{{ asset('mdb/js/bootstrap.min.js')}}"></script>
   <!-- MDB core JavaScript -->
   <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js')}}"></script>
   <!-- DataTables CSS -->
    <link href="{{ asset('mdb/css/addons/datatables2.min.css')}}" rel="stylesheet">
    <!-- DataTables JS -->
    <script src="{{ asset('mdb/js/addons/datatables2.min.js')}}" type="text/javascript"></script>

    <!-- DataTables Select CSS -->
    <link href="{{ asset('mdb/css/addons/datatables-select2.min.css')}}" rel="stylesheet">
    <!-- DataTables Select JS -->
    <script src="{{ asset('mdb/js/addons/datatables-select2.min.js')}}" type="text/javascript"></script>
   <script>
      $(document).ready(() => {
       new WOW().init();

       // SideNav Button Initialization
       $(".button-collapse").sideNav();
       // SideNav Scrollbar Initialization
       var sideNavScrollbar = document.querySelector('.custom-scrollbar');
       var ps = new PerfectScrollbar(sideNavScrollbar);

       // Material Select Initialization
       $('.mdb-select').materialSelect();

        // MDB Lightbox Init
        $(function () {
          $("#mdb-lightbox-ui").load("{{ asset('mdb/mdb-addons/mdb-lightbox-ui.html')}}");
        });
      });

      // Data Picker Initialization
      $('.datepicker').datepicker({
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Cerrar',
      monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
      weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
      labelMonthNext: 'Mes Siguiente',
      labelMonthPrev: 'Mes Anterior',
      labelMonthSelect: 'Selecciona un Mes',
      labelYearSelect: 'Selecciona un Año',
      format: 'yyyy-mm-dd',
      formatSubmit: 'yyyy-mm-dd'
      });

      function deleteAdmin(clicked_id) {
       var id = clicked_id;
       $('#deleteAdminForm').attr('action', 'http://localhost/proyectos/AdminAppCatalogo/public/administradores/'+id);
       $('#modalConfirmAdminDelete').modal('show');
      }

      function deleteCategoria(clicked_id) {
       var id = clicked_id;
       $('#deleteCategoriaForm').attr('action', 'http://localhost/proyectos/AdminAppCatalogo/public/categorias/'+id);
       $('#modalConfirmCategoriaDelete').modal('show');
      }

      function deleteClasificacion(clicked_id) {
       var id = clicked_id;
       $('#deleteClasificacionForm').attr('action', 'http://localhost/proyectos/AdminAppCatalogo/public/clasificacion/'+id);
       $('#modalConfirmClasificacionDelete').modal('show');
      }

      function deleteVendedor(clicked_id) {
       var id = clicked_id;
       $('#deleteVendedorForm').attr('action', 'http://localhost/proyectos/AdminAppCatalogo/public/vendedores/'+id);
       $('#modalConfirmVendedorDelete').modal('show');
      }

      function deleteProducto(clicked_id) {
       var id = clicked_id;
       $('#deleteProductoForm').attr('action', 'http://localhost/proyectos/AdminAppCatalogo/public/productos/'+id);
       $('#modalConfirmProductoDelete').modal('show');
      }

      function deleteFormaPago(clicked_id) {
       var id = clicked_id;
       $('#deleteFormaPagoForm').attr('action', 'http://localhost/proyectos/AdminAppCatalogo/public/forma_pago/'+id);
       $('#modalConfirmFormaPagoDelete').modal('show');
      }

      function verClasificacionImagen(clicked_id) {
       var id = clicked_id;
       document.getElementById("hcImagen").href = id;
       document.getElementById("icImagen").src = id;
      }

      function verIdentificacionVendedor(clicked_id) {
       var id = clicked_id;
       document.getElementById("hvIdentificacion").href = id;
       document.getElementById("ivIdentificacion").src = id;
      }

      function verProductoImagen(clicked_id) {
       var id = clicked_id;
       document.getElementById("hpImagen").href = id;
       document.getElementById("ipImagen").src = id;
      }

      function readURL(input) {
       if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function(e) {
           $('#chImg').attr('href', e.target.result);
           $('#ciImg').attr('src', e.target.result);
           $('.mdb-lightbox').css('display','block');
         }

         reader.readAsDataURL(input.files[0]); // convert to base64 string
       }
      }

      $("#imagen").change(function() {
         readURL(this);
      });

      $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img class="col-md-3">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }

                $("#prioridad").empty()

                $("#prioridad").append(new Option("Elige tu opción", "")).prop("selected", "selected");
                for (i = 0; i < filesAmount; i++) {
                    $("#prioridad").append(new Option("Imagen " + (i + 1), i + 1));
                }
            }

            document.getElementById('divPrioridad').style.display = 'block';
            document.getElementById('divPrioridadE').style.display = 'none';
            document.getElementById('gallerye').style.display = 'none';
            document.getElementById('galedit').style.display = 'block';
        };

        $('#imagen').on('change', function() {
          document.getElementById("preview").innerHTML = '';
          imagesPreview(this, 'div.gallery');
        });
      });

      $(window).on('load', function () {
        setTimeout(function () {
          $(".loader-page").css({visibility:"hidden",opacity:"0"})
        }, 2000);
      });

      // Material Design example
      $(document).ready(function () {
        $('#dtMaterialDesignExample').DataTable({
          "pagingType": "full_numbers",
        });
        $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
          $(this).parent().append($(this).children());
        });
        $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
          const $this = $(this);
          $this.attr("placeholder", "Buscar");
          $this.removeClass('form-control-sm');
        });
        $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
        $('#dtMaterialDesignExample_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
        $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
        $('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
        $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
      });
   </script>

</html>
