<div class="navbar bg-orange-200">
    <div class="flex-1 ml-2">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
   stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9
   15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-
   4.5l5.25 5.25" />
    </svg>
   
    <a href="{{route('inicio')}}" class="btn btn-ghost btn-sm normal-case text-sm">Abarrotes punto de Venta</a>
    </div>
    <div class="flex-none">
    @auth
    <ul class="menu menu-horizontal px-1 mr-6 space-x-2">
    <li><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
    <li><a href="{{ route('productos.index') }}">Productos</a></li>
    @if (auth()->user()->rol == 'admin')
    <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
    @endif
    </ul>
    {{-- Menú del usuario --}}
    <div class="dropdown dropdown-end mr-4">
    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
    <div class="w-10 rounded-full">
    <img src="https://source.unsplash.com/random/100x100/?face" />
    </div>
    </label>
    <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100
   rounded-box w-52">
    <li class="font-semibold">
    {{ auth()->user()->name }}
    </li>
    @if (auth()->user()->rol == 'admin')
    <li><a href="#" class="link link-hover">Usuarios del sistema</a></li>
    @endif
    <li><a href="{{ route('perfil') }}" class="link link-hover">Mi perfil</a></li>
    <li>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="link link-hover">Cerrar sesión</button>
    </form>
    </li>
    </ul>
    </div>
    @else
    <ul class="menu menu-horizontal px-1 mr-6 space-x-4">
    <li><a href="{{ route('login') }}" class="btn btn-sm btn-outline normal-case">Iniciar sesión</a></li>
    <li><a href="{{ route('registro') }}" class="btn btn-sm btn-outline normal-case">Registrarse</a></li>
    </ul>
    @endauth
    </div>
   </div>