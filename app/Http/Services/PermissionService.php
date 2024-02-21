<?php

namespace App\Http\Services;
class PermissionService
{
    public static function getPermissions() {
        $admin = auth()->guard("admin")->user();
        $roles = $admin->roles()->with("permissions:middleware")->get();
        $middlewares = [];
        foreach($roles as $role) {
            if($role->permissions) {
                $middlewares =  [...$role->permissions->pluck("middleware"), ...$middlewares];
            }
        }
        return $middlewares;
    }

    public static function checkRole($middlewareNeed) {
        $admin = auth()->guard("admin")->user();
        $middleware = self::getPermissions();
        return in_array($middlewareNeed,$middleware) || $admin->is_admin;
    }
}

?>
