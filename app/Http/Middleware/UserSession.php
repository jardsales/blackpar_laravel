<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSession
{
    // Middleware para checar se usuário está logado e retornar as informações dele
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has("user_jwt")) {
            return redirect('/login');
        }
        $request->attributes->add(["user"=>json_decode(session()->get("user_info","{}")),"user_jwt"=>session()->get("user_jwt","")]);
        return $next($request);
    }
}
