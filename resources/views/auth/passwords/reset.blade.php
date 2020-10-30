{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}

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
            <div class="container my-3 py-3">
               <!--Section: Content-->
               <section class="px-md-3 mx-md-3 text-center text-lg-left dark-grey-text">
                  <!--Grid row-->
                  <div class="row d-flex justify-content-center">
                     <!--Grid column-->
                     <div class="card col-md-6 my-4 py-4">
                        <!-- Default form login -->
                        <form class="text-center col-md-10 offset-md-1" method="POST" action="{{ route('password.update') }}">
                           <div class="col-md-4 mx-auto">
                              <div class="view mb-4 pb-2">
                                 <img src="{{ asset('img/300cp.png')}}" class="img-fluid" alt="smaple image">
                              </div>
                           </div>
                           <p class="h4 mb-4">{{ __('Reset Password') }}</p>
                           @csrf

                           <input type="hidden" name="token" value="{{ $token }}">

                           <!-- Email -->
                           <div class="md-form">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <label for="email">Correo Electrónico*</label>
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
                           <button class="btn btn-sm btn-info btn-rounded btn-block my-4 col-md-8 mx-auto" type="submit">{{ __('Reset Password') }}</button>
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
