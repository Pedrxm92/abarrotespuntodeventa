<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $categorias = Categoria::all(); //Se consultan todas las categorias
    return view('categorias.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
 {
 return view('categorias.create');
 }
    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
 {
 Categoria::create($request->all());
 return to_route('categorias.index')->with('info', 'Categoría creada con éxito');
 }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', ['categoria' => $categoria]);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update($request->all());
        return to_route('categorias.index')->with('info', 'Categoría actualizada con éxito');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
{
$categoria->delete();
return to_route('categorias.index')->with('info', 'Categoría eliminada con éxito');
}
//Protegemos las rutas de este controlador con el middleware auth y admin (autenticado y rol de admin)
public function __construct()
{
//Sólo los usuarios autenticados y con rol de admin pueden acceder a todos los métodos de este controlador
$this->middleware('auth');
$this->middleware('admin');

}

}
