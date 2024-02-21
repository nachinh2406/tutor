<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = auth()->guard("admin")->user();
        if ($user && ($user->hasPermissionTo($permission) || $user->is_admin) ) {
            return $next($request);
        }
        abort(403, 'Bạn không có quyền thực hiện chức năng này');
    }
}
