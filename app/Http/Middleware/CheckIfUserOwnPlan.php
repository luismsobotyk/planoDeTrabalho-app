<?php

namespace App\Http\Middleware;

use App\Models\Plano;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserOwnPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $plano_id = $request->route('plano_id');
        $plano = Plano::find($plano_id);
        if(!$plano || $plano->docente_id !== session('user.login')){
            abort(403, 'Acesso negado');
        }
        return $next($request);
    }
}
