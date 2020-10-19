

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
           <div class="container my-4 py-4">
              <!--Section: Content-->
              <section class="px-md-3 mx-md-3 text-center text-lg-left dark-grey-text">
                  <!--Grid row-->
                  <div class="row d-flex justify-content-center">
                     <!--Grid column-->
                     <div class="card col-md-6 my-4 py-4">
                        <!-- Default form login -->
                        <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('login') }}">
                           <div class="col-md-4 mx-auto">
                              <div class="view mb-4 pb-2">
                                 <img src="img/300cp.png" class="img-fluid" alt="smaple image">
                              </div>
                           </div>
                           <p class="h4 mb-4">Ingresa a tu cuenta</p>
                           @csrf
                           <!-- Email -->
                           <div class="md-form">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="email">Correo Electrónico</label>
                           </div>
                           <!-- Password -->
                           <div class="md-form input-group">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                              <label for="password">Contraseña</label>
                              <div class="input-group-prepend">
                                 <a class="col-md-1" onclick="mostrarContrasena()"><i id="icon_login" class="fas fa-eye input-prefix"></i></a>
                              </div>
                           </div>
                           {{--
                           <div class="d-flex justify-content-around">
                              <div>
                                 <!-- Remember me -->
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                                    <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                                 </div>
                              </div>
                              <div>
                                 <!-- Forgot password -->
                                 <a href="">Forgot password?</a>
                              </div>
                           </div>
                           --}}
                           <!-- Sign in button -->
                           <button class="btn btn-sm btn-info btn-rounded btn-block my-4 col-md-8 mx-auto" type="submit">ENTRAR</button>
                           <hr>
                           <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                           {{--<a href="#" class="mx-1" role="button"><i class="fab fa-facebook-f"></i></a>
                           <a href="#" class="mx-1" role="button"><i class="fab fa-twitter"></i></a>
                           <a href="#" class="mx-1" role="button"><i class="fab fa-linkedin-in"></i></a>
                           <a href="#" class="mx-1" role="button"><i class="fab fa-github"></i></a>--}}
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

         function mostrarContrasena(){
           var tipo = document.getElementById("password");
           var icono = document.getElementById("icon_login");
           if(tipo.type == "password"){
               tipo.type = "text";
               icono.className =icono.className.replace( /(?:^|\s)fas fa-eye(?!\S)/g , '' );
               icono.className += " fas fa-eye-slash";
           }else{
               tipo.type = "password";
               icono.className =icono.className.replace( /(?:^|\s)fas fa-eye-slash(?!\S)/g , '' );
               icono.className += " fas fa-eye";
           }
         }
      </script>
   </body>
</html>
