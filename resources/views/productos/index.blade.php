@extends('layouts.app')
@section('titulo', 'Nuestros Productos')
@section('cabecera', 'Nuestros Productos')
@section('contenido')
{{-- si el usuario es admin muestra crear producto --}}
@if (auth()->user()->rol == 'admin')
<div class="flex justify-end m-4">
<a href="{{ route('productos.create') }}" class="btn btn-outline btn-sm">Crear Producto</a>
</div>
@endif
<div class="flex justify-center mx-6">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
@foreach ($productos as $producto)
{{-- No muestra a los clientes productos que tengan stock 0 --}}
@if (auth()->user()->rol == 'admin' || $producto->stock > 0)
<div class="card w-72 bg-base-100 shadow-xl">
<figure>
@if(file_exists('images/productos/producto_' . $producto->id . '.jpg'))
<img src="{{ asset('images/productos/producto_' . $producto->id . '.jpg') }}" alt="{{$producto->nombre}}" class="rounded-t-lg h-40 w-full object-cover">
@else
<img src="{{ asset('images/productos/default.jpg') }}" alt="{{$producto->nombre}}" class="rounded-t-lg">
@endif
</figure>
<div class="card-body">
<h2 class="card-title">{{$producto->nombre}}</h2>
<div class="badge badge-success badge-outline">Categoría: {{$producto->categoria->nombre}}</div>
<p>{{Str::limit($producto->descripcion, 80)}}</p>
{{-- precio y stock--}}
<div class="flex space-x-4">
<div class="badge badge-neutral">${{number_format($producto->precio, 0, ',', '.')}}</div>
<div class="badge badge-ghost">{{$producto->stock}} en stock</div>
</div>
<div class="card-actions justify-end mt-5">
{{-- si el usuario es admin muestra editar o eliminar --}}
@if (auth()->user()->rol == 'admin')
{{-- Editar --}}
<a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-xs">Editar</a>
{{-- Eliminar --}}
{{-- Si existen pedidos con este producto no se puede eliminar --}}
@if ($producto->pedidos->count() == 0)
<form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" onclick="return confirm('¿Desea eliminar el producto {{ $producto->nombre }}?')" class="btn btn-error btn-xs">Eliminar</button>
</form>
@endif
@else
{{-- si el usuario es cliente muestra realizar una orden --}}
<a href="{{ route('pedidos.create', $producto->id) }}" class="btn btn-primary btn-xs">Ordenar</a>
@endif
</div>
</div>
</div>
@endif
@endforeach
</div>
</div>
@endsection