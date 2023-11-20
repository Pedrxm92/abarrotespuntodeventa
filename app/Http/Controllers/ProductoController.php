<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $productos = Producto::orderBy('nombre')->get();
    return view('productos.index', ['productos' => $productos]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    // Obtiene todas las instancias de la clase "Categoria" ordenadas por el campo "nombre"
    $categorias = Categoria::orderBy('nombre')->get();
    //si no existen categorias, se redirige a la vista de creación de categorias
    if ($categorias->isEmpty()) {
    return redirect()->route('categorias.create')->with('info', 'Primero debes crear una categoría');
    }
    return view('productos.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
Producto::create($request->all());
//Guardar imagen
$producto = Producto::latest('id')->first();
$imageName= 'producto_'.$producto->id.'.'.$request->imagen->extension();
$request->imagen->move(public_path('images/productos'), $imageName);
return redirect()->route('productos.index')->with('info', 'Producto creado con éxito');
}

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
{
$categorias = Categoria::orderBy('nombre')->get();
return view('productos.edit', ['producto' => $producto, 'categorias' => $categorias]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
{
$producto->update($request->all());
return redirect()->route('productos.index')->with('info', 'Producto actualizado con éxito');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
{
$producto->delete();
return redirect()->route('productos.index')->with('info', 'Producto eliminado con éxito');
}
//Protegemos las rutas de este controlador con el middleware auth y admin (autenticado y rol de admin)
public function __construct()
{
//Sólo los usuarios autenticados y con rol de admin pueden acceder a todos los métodos de este controlador
$this->middleware('auth');
$this->middleware('admin');
}
}
