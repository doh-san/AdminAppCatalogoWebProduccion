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
   </head>
   <body style="background-color: #F8FBFE;">
      <div id="app">
         <main class="py-4">

           <div class="container my-5 py-5 z-depth-1">
              <!--Section: Content-->
              <section class="px-md-5 mx-md-5 text-center dark-grey-text">
                  <img src="https://mdbootstrap.com/img/Others/404_mdb.png" alt="Error 404" class="img-fluid mb-4" >
                  <h3 class="font-weight-bold">Pagina no encontrada.</h3>
                  <p>Para regresar a la pagina de inicio, da clic en el botón de abajo.</p>
                  <a class="btn btn-info btn-sm btn-rounded" href="{{ url('home') }}" role="button">Inicio</a>
              </section>
              <!--Section: Content-->
          </div>

         </main>
      </div>
      <!--  SCRIPTS  -->
      <!-- JQuery -->
      <script type="text/javascript" src="{{ asset('mdb/js/jquery.min.js')}}"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="{{ asset('mdb/js/popper.min.js')}}"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="{{ asset('mdb/js/bootstrap.min.js')}}"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js')}}"></script>
      <script>
         $(document).ready(() => {
         new WOW().init();
         });
      </script>
   </body>
</html>
