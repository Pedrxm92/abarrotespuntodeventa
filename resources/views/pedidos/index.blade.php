@extends('layouts.app')
@section('titulo', 'Listar Pedidos')
@section('cabecera', 'Listar Pedidos')
@section('contenido')
<div class="flex justify-center">
<div class="overflow-x-auto">
<table class="table table-zebra">
<thead>
<tr>
<th># Pedido</th>
<th>Fecha y hora</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio Unit.</th>
<th>Valor total</th>
<th>Estado</th>
@if(auth()->user()->rol == 'admin')
<th>Cliente</th>
<th>Direccion</th>
<th>Email</th>
<th>Acciones</th>
@endif
</tr>
</thead>
<tbody>
@foreach ($pedidos as $pedido)
<tr>
<td>{{ $pedido->id }}</td>
<td>{{ $pedido->fecha }}</td>
<td>{{ $pedido->productos[0]->nombre }}</td>
<td>{{ $pedido->productos[0]->pivot->cantidad }}</td>
<td>{{ '$'.number_format($pedido->productos[0]->pivot->precio, 0, ',', '.') }}</td>
<td>{{ '$'.number_format($pedido->productos[0]->pivot->precio * $pedido->productos[0]->pivot->cantidad, 0, ',', '.') }}</td>
<td>
@if ($pedido->estado == 'pendiente')
<span class="badge badge-warning">{{ $pedido->estado }}</span>
@elseif ($pedido->estado == 'enviado')
<span class="badge badge-primary">{{ $pedido->estado }}</span>
@else
<span class="badge badge-success">{{ $pedido->estado }}</span>
@endif
</td>
{{-- Si el usuario es administrador, se muestran los datos del cliente --}}
@if(auth()->user()->rol == 'admin')
<td>{{ $pedido->user->name }}</td>
<td>{{ $pedido->user->address }}</td>
<td>{{ $pedido->user->email }}</td>
{{-- Botones para editar o eliminar pedido para el administrador --}}
<td class="flex space-x-2">
<a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-xs normal-case">Estado</a>
<form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" onclick="return confirm('¿Desea eliminar el pedido {{ $pedido->id }}?')" class="btn btn-error btn-xs normal-case">Eliminar</button>
</form>
</td>
@endif
</tr>
@endforeach
</tbody>
</table>
{{-- Paginacion --}}
<div class="flex justify-center mt-4">
{{ $pedidos->links() }}
</div>
</div>
</div>
@endsection