<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  角色
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // 权限管理，如果非某个角色，则不能进行某些操作
        if(!$request->user()->hasRole($role))
        {


        }
        return $next($request);
    }
}
