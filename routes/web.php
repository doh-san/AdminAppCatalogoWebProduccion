<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

//Rutas Perfil
Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::get('/cambiar_contrasena', 'PerfilController@cambiar')->name('cambiarContrasena');
Route::post('/validarFormulario', 'PerfilController@validarFormulario')->name('validarCambiarContrasena');
Route::get('/editar_perfil', 'PerfilController@editar')->name('editarPerfil');
Route::post('/validarEditarPeril', 'PerfilController@validarEditarPerfil')->name('validarEditarPerfil');

//Rutas Administradores
Route::resource('administradores', 'AdministradorController');

//Rutas Categorias
Route::resource('categorias', 'CategoriaController');

//Rutas Catalogos
Route::resource('clasificacion', 'ClasificacionController');

//Rutas Vendedores
Route::resource('vendedores', 'VendedorController');

//Rutas Productos
Route::resource('productos', 'ProductoController');

//Rutas Forma de Pago
Route::resource('forma_pago', 'FormaPagoController');

//Rutas Ventas
Route::get('ventas', 'VentaController@index')->name('ventas');
Route::get('ventas/ver_detalle/{pedido}/{producto}', 'VentaController@verDetalle');
Route::get('ventas/historico', 'VentaController@historico')->name('historico');
Route::post('ventas/export', 'VentaController@export');
//Route::resource('ventas', 'VentaController');
