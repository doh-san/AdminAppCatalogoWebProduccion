<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <link href="img/icon2.ico" rel="shortcut icon" type="image/x-icon"/>

      <!-- Font Awesome -->
      <script src="https://kit.fontawesome.com/a4f63cacd6.js"></script>
      <!-- Bootstrap core CSS -->
      <link href="mdb/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="mdb/css/mdb.min.css" rel="stylesheet">
   </head>
   <body style="background-color: #F8FBFE;">
      <div id="app">
         <main class="py-4">
            <div class="container my-1 py-1">
               <!--Section: Content-->
               <section class="px-md-3 mx-md-3 text-center text-lg-left dark-grey-text">
                  <!--Grid row-->
                  <div class="row d-flex justify-content-center">
                     <!--Grid column-->
                     <div class="card col-md-6 my-4 py-4">
                        <!-- Default form login -->
                        <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('register') }}">
                           <div class="col-md-4 mx-auto">
                              <div class="view mb-4 pb-2">
                                 <img src="img/300cp.png" class="img-fluid" alt="smaple image">
                              </div>
                           </div>
                           <p class="h4 mb-4">Ingresa a tu cuenta</p>
                           @csrf
                           <input name="admin" type="hidden" value="1">
                           <!-- Name -->
                           <div class="md-form">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                              @error('name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="name">Nombre(s)*</label>
                           </div>
                           <!-- Lastname -->
                           <div class="md-form">
                              <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}">
                              @error('lastname')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="lastname">Apellido(s)*</label>
                           </div>
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
                           <!-- Gender -->
                           <div class="md-form">
                              <div class="text-center">
                                 <p class="col-form-label ">Genero*</p>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input type="radio" class="form-check-input" id="mujer" name="gender" value="Mujer" {{ old('gender')=="Mujer" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                 <label class="form-check-label" for="mujer">Mujer</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input type="radio" class="form-check-input" id="hombre" name="gender" value="Hombre" {{ old('gender')=="Hombre" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                 <label class="form-check-label" for="hombre">Hombre</label>
                              </div>
                              <div class="clearfix my-3"></div>
                              @error('gender')
                              <span class="help-block text-center red-text" role="alert">
                              <strong><small>{{ $message }}</small></strong>
                              </span>
                              @enderror
                           </div>
                           <!-- Telephone -->
                           <div class="md-form">
                              <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}">
                              @error('telephone')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="telephone">Teléfono*</label>
                           </div>
                           <div class="md-form input-with-post-icon datepicker">
                              <input placeholder="Selecciona Fecha" type="text" id="birthdate" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}">
                              <label for="birthdate">Fecha de Nacimiento<span class="red-text">*</span></label>
                              <i class="fas fa-calendar input-prefix" tabindex=0></i>
                              @error('birthdate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                           <!-- Password -->
                           <div class="md-form">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="password">Contraseña*</label>
                           </div>
                           <div class="md-form">
                              <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                              @error('password_confirmation')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="password_confirmation">Repetir Contraseña*</label>
                           </div>
                           <!-- Sign in button -->
                           <button class="btn btn-sm btn-info btn-rounded btn-block my-4 col-md-8 mx-auto" type="submit">REGISTRARSE</button>
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
      <!-- JQuery -->
      <script type="text/javascript" src="mdb/js/jquery.min.js"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="mdb/js/popper.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="mdb/js/bootstrap.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="mdb/js/mdb.min.js"></script>
      <script>
         $(document).ready(() => {
         new WOW().init();
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
      </script>
   </body>
</html>
