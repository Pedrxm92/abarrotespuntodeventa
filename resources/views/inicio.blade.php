@extends('layouts.app')
@section('titulo', 'Abarrotespuntodeventa')
@section('cabecera', 'Abarrotes punto de venta - Tu mejor aliado')

@section('contenido')
<div class="hero min-h-screen" style="background-image: url(https://s3.us-west-2.amazonaws.com/images.unsplash.com/application-1701622670745-04860c39053dimage);">
 <div class="hero-overlay bg-opacity-60"></div>
 <div class="hero-content text-center text-neutral-content">
 <div class="max-w-md">
 <h1 class="mb-5 text-5xl font-bold text-white">Tenemos lo que necesitas!</h1>
 <p class="mb-5 text-gray-300">Nuestra responsabilidad con nuestros aliados nos impulsa a seguir cada dia</p>
 <a href="{{route('productos.index')}}" class="btn btn-primary">Clic aqui y te ayudamos</a>
 </div>
 </div>
 </div>
@endsection