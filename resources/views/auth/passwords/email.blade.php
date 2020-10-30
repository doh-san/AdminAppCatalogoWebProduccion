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
         <main class="py-5">
            <div class="container my-4 py-4">
               <!--Section: Content-->
               <section class="px-md-3 mx-md-3 text-center text-lg-left dark-grey-text">
                  <!--Grid row-->
                  <div class="row d-flex justify-content-center">
                     <!--Grid column-->
                     <div class="card col-md-6 my-4 py-4">
                        <!-- Default form login -->
                        <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('password.email') }}">
                           <div class="col-md-4 mx-auto">
                              <div class="view mb-4 pb-2">
                                 <img src="{{ asset('img/300cp.png')}}" class="img-fluid" alt="smaple image">
                              </div>
                           </div>
                           <p class="h4 mb-4">Recuperar contraseña</p>

                           @csrf

                           <!-- Email -->
                           <div class="md-form">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="email">Correo Electrónico*</label>
                           </div>

                           <!-- Sign in button -->
                           <button type="submit" class="btn btn-sm btn-info btn-rounded btn-block my-4 col-md-8 mx-auto">Recuperar</button>
                           <hr>
                           ¿Tienes una cuenta?<a href="{{ route('login') }}"> Inicia Sesión</a>
                        </form>
                        <!-- Default form login -->
                     </div>
                     <!--Grid column-->
                  </div>
                  <!--Grid row-->
               </section>
               <!--Section: Content-->
            </div>
         </main>
      </div>

      <!--  SCRIPTS  -->
      <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

      <script type="text/javascript">
        @if (session()->has('status'))
          Swal.fire({
            title: "Exito",
            text: "{{ session('status') }}",
            icon: "success",
            timer: 3000,
          });
        @endif
      </script>
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
