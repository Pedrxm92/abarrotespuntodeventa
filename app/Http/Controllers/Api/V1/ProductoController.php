<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
return response()->json(Producto::all(), 200); //200: OK
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
//Validar los datos de entrada
$datos = $request->validate([
'nombre' => ['required', 'string', 'max:100'],
'descripcion' => ['nullable', 'string', 'max:255'],
'precio' => ['required', 'integer', 'min:0'],
'stock' => ['required', 'integer', 'min:0'],
'categoria_id' => ['required', 'integer', 'exists:categorias,id'] //exists valida que el id exista en la tabla categorias
]);
//Crear el producto
$producto = Producto::create($datos);
return response()->json(['success' => true, 'message' => 'Producto creado'], 201); //201: Created
}

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
{
return response()->json($producto, 200); //200: OK
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
    //Validar los datos de entrada
    $datos = $request->validate([
    'nombre' => ['required', 'string', 'max:100'],
    'descripcion' => ['nullable', 'string', 'max:255'],
    'precio' => ['required', 'integer', 'min:0'],
    'stock' => ['required', 'integer', 'min:0'],
    'categoria_id' => ['required', 'integer', 'exists:categorias,id']
    ]);
    //Actualizar el producto
    $producto->update($datos);
    return response()->json(['success' => true, 'message' => 'Producto actualizado'], 200); //200: OK
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
{
$producto->delete();
return response()->json(['success' => true, 'message' => 'Producto eliminado'], 204); //204: No content
}
}
