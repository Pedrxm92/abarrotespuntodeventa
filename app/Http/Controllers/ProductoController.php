<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('productos.index', ['productos' => $productos]);
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        if ($categorias->isEmpty()) {
            return redirect()->route('categorias.create')->with('info', 'Primero debes crear una categoría');
        }

        return view('productos.create', ['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'image|mimes:jpg,png,jpeg,gif|max:2048', // Ajusta las extensiones y el tamaño según tus necesidades
            // Agrega otras reglas de validación según tus necesidades
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $producto = Producto::create($request->all());

        if ($request->has('imagen')) {
            $imageName = 'producto_' . $producto->id . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images/productos'), $imageName);
        }

        return redirect()->route('productos.index')->with('info', 'Producto creado con éxito');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', ['producto' => $producto]);
    }

    public function edit(Producto $producto)
    {
        $this->authorize('update', $producto);
        $categorias = Categoria::orderBy('nombre')->get();
        return view('productos.edit', ['producto' => $producto, 'categorias' => $categorias]);
    }

    public function update(Request $request, Producto $producto)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'image|mimes:jpg,png,jpeg,gif|max:2048', // Ajusta las extensiones y el tamaño según tus necesidades
            // Agrega otras reglas de validación según tus necesidades
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $producto->update($request->all());

        if ($request->has('imagen')) {
            $imageName = 'producto_' . $producto->id . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images/productos'), $imageName);
        }

        return redirect()->route('productos.index')->with('info', 'Producto actualizado con éxito');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('info', 'Producto eliminado con éxito');
    }
}