<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class PerfilController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('verified');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index() {
      try {
        $user = User::find(\Auth::user()->id);
        $uppr = $user->updated_profile;
        if (!(is_null($uppr))) {
          $start = new \DateTime(date("Y-m-d"));
          $end   = new \DateTime($user->updated_profile);
          $diff  = $start->diff($end);
          $month = $diff->format('%y') * 12 + $diff->format('%m');

          return view('perfil.index', ['diff' => $month]);
        } else {
          return view('perfil.index', ['diff' => 1]);
        }
      } catch (\Exception $ex) {
        session()->flash('error_exception_perfil', $ex->getMessage());
        return redirect('/perfil');
      }
  }

  public function cambiar() {
      try {
        return view('perfil.cambiar_contrasena');
      } catch (\Exception $ex) {
        session()->flash('error_exception_perfil', $ex->getMessage());
        return redirect('/perfil');
      }
  }

  protected function validarFormulario(Request $request) {
      try {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //Se valida el formulario
        if($validator->fails()){
            //Se retorna el objeto a la vista con errores
            return redirect('/cambiar_contrasena')->withErrors($validator)->withInput();
        } else {
          //Se actualiza contraseña
          $user = User::find(\Auth::user()->id);
          $user->password = Hash::make(\Request::input('password'));
          $user->update();
          session()->flash('update_password_success', 'Se actualizo la contraseña exitosamente');
          return redirect('/perfil');
        }
      } catch (\Exception $ex) {
        session()->flash('error_exception_perfil', $ex->getMessage());
        return redirect('/perfil');
      }
  }

  public function editar() {
      try {
        $user = User::find(\Auth::user()->id);
        $start = new \DateTime(date("Y-m-d"));
      	$end = new \DateTime($user->updated_profile);
      	$diff = $start->diff($end);

        $uppr = $user->updated_profile;
        if (!(is_null($uppr))) {
          $month = $diff->format('%y') * 12 + $diff->format('%m');
        } else {
          $month = 1;
        }

        if ($month >= 1) {
          return view('perfil.editar');
        } else {
          return redirect('/perfil');
        }
      } catch (\Exception $ex) {
        session()->flash('error_exception_perfil', $ex->getMessage());
        return redirect('/perfil');
      }
  }

  protected function validarEditarPerfil(Request $request) {
      try {
        if (\Auth::user()->role == 1) {
          $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\User,email,'.\Auth::user()->id],
            'telephone' => ['required', 'string', 'max:10', 'unique:App\USer,telephone,'.\Auth::user()->id],
            'gender' => ['required'],
            'birthdate' => ['required', 'string'],
            'photography' => ['image', 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100', 'mimes:jpeg,jpg,bmp,png'],
          ]);
        } elseif (\Auth::user()->role > 1) {
          $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\User,email,'.\Auth::user()->id],
            'telephone' => ['required', 'string', 'max:10', 'unique:App\USer,telephone,'.\Auth::user()->id],
            'gender' => ['required'],
            'birthdate' => ['required', 'string'],
            'identification' => ['image', 'mimes:jpeg,jpg,bmp,png'],
            'voucher' => ['image', 'mimes:jpeg,jpg,bmp,png'],
            'photography' => ['image', 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100', 'mimes:jpeg,jpg,bmp,png'],
          ]);
        }

        //Se valida el formulario
        if($validator->fails()){
            //Se retorna el objeto a la vista con errores
            return redirect('/editar_perfil')->withErrors($validator)->withInput();
        } else {
          //Se actualiza contraseña
          $user = User::find(\Auth::user()->id);

          $newDate = date("Y-m-d", strtotime($request->input('birthdate')));

          $user->name = $request->input('name');
          $user->lastname = $request->input('lastname');
          $user->gender = $request->input('gender');

          if ($user->email != $request->input('email')) {
            $user->email = $request->input('email');
            $user->email_verified_at = null;
          } elseif ($user->email != $request->input('email')) {
            $user->email = $request->input('email');
          }

          $user->telephone = $request->input('telephone');
          $user->birthdate = $newDate;
          $user->updated_profile = date("Y-m-d");

          if (\Auth::user()->role > 1) {
            if($request->hasFile('identification')){
              $nomimg1 = basename($user->identification);
              \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg1);

              $user->identification = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('identification')->storePublicly('vendedores', 's3');
            }
            if($request->hasFile('voucher')){
              $nomimg2 = basename($user->voucher);
              \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg2);

              $user->voucher = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('voucher')->storePublicly('vendedores', 's3');
            }
            if($request->hasFile('photography')){
              $nomimg3 = basename($user->photography);
              \Storage::disk('s3')->delete('vendedores', 'vendedores/'.$nomimg3);

              $user->photography = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('photography')->storePublicly('vendedores', 's3');
            }
          } else {
            if($request->hasFile('photography')){
              $nomimg = basename($user->photography);
              \Storage::disk('s3')->delete('administradores', 'administradores/'.$nomimg);

              $user->photography = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $request->file('photography')->storePublicly('administradores', 's3');
            }
          }

          $user->update();

          session()->flash('update_profile_success', 'Se actualizo el perfil exitosamente');

          return redirect('/perfil');
        }
      } catch (\Exception $ex) {
        session()->flash('error_exception_perfil', $ex->getMessage());
        return redirect('/perfil');
      }
  }
}
