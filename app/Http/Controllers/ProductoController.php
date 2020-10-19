<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Marca;
use App\Categoria;
use App\Producto_Marca;
use App\Producto_Imagen;

class ProductoController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == '1') {
          try {
            $productos = \DB::select("select p.*, m.nombre as marca, pm.fecha, c.nombre as categoria  from producto p inner join clasificacion_categoria pc on p.id_producto = pc.id_producto inner join categoria c on c.id_categoria = pc.id_categoria inner join producto_marca pm on pm.id_producto_marca = pc.id_producto_marca inner join marca m on m.id_marca = pm.id_marca");
            return view('productos.index', ['productos' => $productos]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } else {
          return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            $marcas = Marca::all();
            $categorias = Categoria::all();
            return view('productos.create', ['marcas' => $marcas, 'categorias' => $categorias]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/productos');
        } else {
          return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1' ||  Auth::user()->level == '2') {
          try {
            $validator = Validator::make($request->all(), [
              'nombre' => ['required', 'string', 'max:255', 'unique:producto'],
              'cantidad' => ['required', 'numeric'],
              'descuento' => ['required', 'numeric'],
              'precio_venta' => ['required', 'numeric'],
              'precio_vendedor' => ['required', 'numeric'],
              'marca' => ['required'],
              'categoria' => ['required'],
              'descripcion' => ['required', 'string', 'max:255'],
              'puntos' => ['required', 'numeric'],
              'imagen.*' => 'mimes:jpg,jpeg,bmp,png',
              'imagen' => ['required', 'max:5'],
              'prioridad' => ['required'],
            ],[
              'imagen.*.mimes' => 'Los archivos subidos en el campo imagenes deben solo imagenes',
              'imagen.required' => 'El campo imagenes es obligatorio',
              'imagen.max' => 'No se pueden subir mas de 5 imagenes',
            ]);

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/productos/create')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $con = 0;
              $ex = 0;
              $producto = new Producto();

              $prioridad = $request->input('prioridad');
              $marcas = $request->input('marca');
              $categorias = $request->input('categoria');

              $producto->nombre = $request->input('nombre');
              $producto->cantidad = $request->input('cantidad');
              $producto->descuento = $request->input('descuento');
              $producto->precio_venta = $request->input('precio_venta');
              $producto->precio_vendedor = $request->input('precio_vendedor');
              $producto->puntos = $request->input('puntos');
              $producto->descripcion = $request->input('descripcion');
              if($request->hasFile('imagen')){
                foreach($request->file('imagen') as $file){
                  $con = $con + 1;

                  if ($prioridad == $con) {
                    $producto->imagen = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $file->storePublicly('productos', 's3');
                    $ex = $con;
                  }
                }
              }
              $producto->estatus = 1;

              $con = 0;

              $producto->save();

              if($request->hasFile('imagen')){
                foreach($request->file('imagen') as $file){
                  $con = $con + 1;

                  $pi = new Producto_Imagen();
                  $pi->producto()->associate($producto);
                  if ($ex != $con) {
                    $pi->ruta = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $file->storePublicly('productos', 's3');
                  } else {
                    $pi->ruta = $producto->imagen;
                  }
                  $pi->fecha_registro = date("Y-m-d H:i:s");

                  if ($prioridad == $con) {
                    $pi->principal = 1;
                  }

                  $pi->save();

                }
              }

              $producto_marca = Producto_Marca::where('id_marca', '=', $marcas)->firstOrFail();

              $producto->categorias()->attach($categorias, ['id_producto_marca' => $producto_marca->id_producto_marca]);

              session()->flash('create_success', 'Se guardo exitosamente');

              return redirect('/productos');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '3') {
          return redirect('/productos');
        } else {
          return redirect('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role == '1') {
          try {
            $producto = \DB::select("select p.*, m.nombre as marca, pm.fecha, c.nombre as categoria  from producto p inner join clasificacion_categoria pc on p.id_producto = pc.id_producto inner join categoria c on c.id_categoria = pc.id_categoria inner join producto_marca pm on pm.id_producto_marca = pc.id_producto_marca inner join marca m on m.id_marca = pm.id_marca where p.id_producto = :id", ['id' => $id]);
            $prod = "";
            foreach ($producto as $p) {
              $prod = $p->id_producto;
            }
            $producto_imagen = Producto_Imagen::where('id_producto', '=', $prod)->get();
            return view('productos.show', ['producto' => $producto, 'pi' => $producto_imagen]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } else {
          return redirect('/home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1') {
          try {
            $marcas = Marca::all();
            $categorias = Categoria::all();
            $producto = \DB::select("select p.*, m.id_marca, pm.fecha, c.id_categoria from producto p inner join clasificacion_categoria pc on p.id_producto = pc.id_producto inner join categoria c on c.id_categoria = pc.id_categoria inner join producto_marca pm on pm.id_producto_marca = pc.id_producto_marca inner join marca m on m.id_marca = pm.id_marca where p.id_producto = :id", ['id' => $id]);
            $prod = "";
            foreach ($producto as $p) {
              $prod = $p->id_producto;
            }
            $producto_imagen = Producto_Imagen::where('id_producto', '=', $prod)->get();
            return view('productos.edit', ['producto' => $producto, 'marcas' => $marcas, 'categorias' => $categorias, 'pi' => $producto_imagen]);
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/productos');
        } else {
          return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1') {
          try {
            $producto = Producto::findOrFail($id);
            if($request->hasFile('imagen')){
              $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string', 'max:255', 'unique:App\Producto,nombre,'.$producto->id_producto],
                'cantidad' => ['required', 'numeric'],
                'descuento' => ['required', 'numeric'],
                'precio_venta' => ['required', 'numeric'],
                'precio_vendedor' => ['required', 'numeric'],
                'marca' => ['required'],
                'categoria' => ['required'],
                'descripcion' => ['required', 'string', 'max:255'],
                'puntos' => ['required', 'numeric'],
                'imagen.*' => 'mimes:jpg,jpeg,bmp,png',
                'imagen' => ['max:5'],
                'prioridad' => ['required'],
              ],[
                'imagen.*.mimes' => 'Los archivos subidos en el campo deben solo imagenes',
                'imagen.max' => 'No se pueden subir mas de 5 imagenes',
              ]);
            } else {
              $validator = Validator::make($request->all(), [
                'nombre' => ['required', 'string', 'max:255', 'unique:App\Producto,nombre,'.$producto->id_producto],
                'cantidad' => ['required', 'numeric'],
                'descuento' => ['required', 'numeric'],
                'precio_venta' => ['required', 'numeric'],
                'precio_vendedor' => ['required', 'numeric'],
                'marca' => ['required'],
                'categoria' => ['required'],
                'descripcion' => ['required', 'string', 'max:255'],
                'puntos' => ['required', 'numeric'],
                'imagen.*' => 'mimes:jpg,jpeg,bmp,png',
                'imagen' => ['max:5'],
                'prioridade' => ['required'],
              ],[
                'imagen.*.mimes' => 'Los archivos subidos en el campo deben solo imagenes',
                'imagen.max' => 'No se pueden subir mas de 5 imagenes',
              ]);
            }

            //Se valida el formulario
            if($validator->fails()){
                //Se retorna el objeto a la vista con errores
                return redirect('/productos/'.$id.'/edit')->withErrors($validator)->withInput();
            } else {
              //Se actualiza contraseña
              $con = 0;
              $ex = 0;
              $producto = Producto::findOrFail($id);

              foreach ($producto->categorias as $ct) {
                $producto->categorias()->detach($ct);
              }

              if($request->hasFile('imagen')){
                $prioridad = $request->input('prioridad');
              } else {
                $prioridad = $request->input('prioridade');
              }
              $marcas = $request->input('marca');
              $categorias = $request->input('categoria');

              $producto->nombre = $request->input('nombre');
              $producto->cantidad = $request->input('cantidad');
              $producto->descuento = $request->input('descuento');
              $producto->precio_venta = $request->input('precio_venta');
              $producto->precio_vendedor = $request->input('precio_vendedor');
              $producto->puntos = $request->input('puntos');
              $producto->descripcion = $request->input('descripcion');
              if($request->hasFile('imagen')){

                $nomimg = basename($producto->imagen);
                \Storage::disk('s3')->delete('productos', 'productos/'.$nomimg);

                foreach($request->file('imagen') as $file){
                  $con = $con + 1;

                  if ($prioridad == $con) {
                    $producto->imagen = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $file->storePublicly('productos', 's3');
                    $ex = $con;
                  }
                }
              }

              $con = 0;

              $producto->update();

              if($request->hasFile('imagen')){

                $producto_imagen = Producto_Imagen::where('id_producto', '=', $producto->id_producto)->get();

                foreach($producto_imagen as $pi) {
                  $nomimg2 = basename($pi->ruta);
                  \Storage::disk('s3')->delete('productos', 'productos/'.$nomimg2);

                  $pi->delete();
                }

                foreach($request->file('imagen') as $file){
                  $con = $con + 1;

                  $pi = new Producto_Imagen();
                  $pi->producto()->associate($producto);
                  if ($ex != $con) {
                    $pi->ruta = "https://appcatalogo.s3-us-west-1.amazonaws.com/" . $file->storePublicly('productos', 's3');
                  } else {
                    $pi->ruta = $producto->imagen;
                  }
                  $pi->fecha_registro = date("Y-m-d H:i:s");

                  if ($prioridad == $con) {
                    $pi->principal = 1;
                  }

                  $pi->save();

                }
              } else {
                $pi = Producto_Imagen::where('id_producto', '=', $producto->id_producto)->get();
                $cpi = 0;

                foreach ($pi as $pimg) {
                  $cpi = $cpi + 1;

                  if ($cpi == $prioridad) {
                    $pimg->principal = 1;
                  } else {
                    $pimg->principal = 0;
                  }

                  $pimg->update();
                }
              }

              $producto_marca = Producto_Marca::where('id_marca', '=', $marcas)->firstOrFail();

              $producto->categorias()->attach($categorias, ['id_producto_marca' => $producto_marca->id_producto_marca]);

              session()->flash('update_success', 'Se actualizo exitosamente');

              return redirect('/productos');
            }
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/productos');
        } else {
          return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role == '1' && Auth::user()->level == '1') {
          try {
            $producto = Producto::findOrFail($id);
            $producto_imagen = Producto_Imagen::where('id_producto', '=', $producto->id_producto)->get();

            foreach ($producto->categorias as $cl) {
              $producto->categorias()->detach($cl);
            }

            foreach($producto_imagen as $pi) {
              $nomimg = basename($pi->ruta);
              \Storage::disk('s3')->delete('productos', 'productos/'.$nomimg);

              $pi->delete();
            }

            $producto->delete();

            $nomimg2 = basename($producto->imagen);
            \Storage::disk('s3')->delete('productos', 'productos/'.$nomimg2);

            session()->flash('delete_success', 'Se elimino exitosamente');

            return redirect('/productos');
          } catch (\Exception $ex) {
            session()->flash('error_exception_producto', $ex->getMessage());
            return redirect('/productos');
          }
        } elseif (Auth::user()->role == '1' && Auth::user()->level == '2' || Auth::user()->level == '3') {
          return redirect('/productos');
        } else {
          return redirect('/home');
        }
    }
}
