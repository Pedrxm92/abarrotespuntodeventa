<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class CheckAdmin
{
/**
* Handle an incoming request.
*
* @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
*/
public function handle(Request $request, Closure $next): Response
{
//verificar que el rol del usuario sea admin
if(auth()->user()->rol !== 'admin'){
abort(403);
}
return $next($request);
}
}