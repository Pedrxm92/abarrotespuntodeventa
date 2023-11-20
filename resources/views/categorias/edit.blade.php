@extends('layouts.app')
@section('titulo', 'Editar Categoría')
@section('cabecera', 'Editar Categoría ' . $categoria->nombre)
@section('contenido')
<div class="flex justify-center">
<div class="card w-96 shadow-2xl bg-base-100">
<div class="card-body">
<form action="{{route('categorias.update', $categoria->id)}}" method="POST">
@csrf
@method('PUT')
<div class="form-control">
<label class="label" for="nombre">
<span class="label-text">Nombre</span>
</label>
<input type="text" name="nombre" placeholder="Nombre categoría" class="input input-bordered" maxlength="100" value="{{$categoria->nombre}}" required />
</div>
<div class="form-control">
<label class="label" for="descripcion">
<span class="label-text">Descripción</span>
</label>
<input type="text" name="descripcion" placeholder="Escriba la descripción" class="input input-bordered" maxlength="255" value="{{$categoria->descripcion}}" />
</div>
<div class="form-control mt-6">
<button class="btn btn-primary">Actualizar Categoría</button>
<a href="{{ route('categorias.index') }}" class="btn btn-outline btn-primary mt-4">Cancelar</a>
</div>
</form>
</div>
</div>
</div>
@endsection