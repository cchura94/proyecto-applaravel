<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;

class ProductoController extends Controller
{
    public function __construct() {
        $this->middleware('can:listar-producto', ['only' => 'index']);
        $this->middleware('can:crear-producto', ['only' => 'create','store']);
        $this->middleware('can:editar-producto', ['only' => 'edit','update']);
        $this->middleware('can:eliminar-producto', ['only' => 'destroy']);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();
        return view("admin.producto.index", compact("categorias", "productos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required|max:200",
            "categoria_id" => "required"
        ]);
        // subir img
        $nombre_img = "";
        if($file = $request->file("imagen")){
            $nombre_img = time(). "-" . $file->getClientOriginalName();
            $file->move("imagenes", $nombre_img);
            $nombre_img = '/imagenes/' . $nombre_img;
        }
        // guardar
        $prod = new Producto;
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->umedida = $request->umedida;
        $prod->categoria_id = $request->categoria_id;
        $prod->descripcion = $request->descripcion;
        $prod->imagen = $nombre_img;
        $prod->save();
        // redireccionar
        return redirect("/admin/producto");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registro_ingresos($id)
    {
        $productos = producto::paginate(3);
        $proveedor = Proveedor::find($id);
        return view("admin.producto.ingresos_productos", compact("proveedor", "productos"));
    }

    public function asignar_cantidad(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        $proveedor = Proveedor::find($request->proveedor_id);

        $proveedor->productos()->attach($producto->id, ["cantidad" => $request->cantidad]);

        return redirect()->back();
    }
}
