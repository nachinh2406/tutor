<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
     /**
     * Get the user's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function saveAttactment($model, $fileName, $clear = false) {
        if($clear == true) {
            $model->image()->delete();
        }
        Image::create([
            'imageable_type' => get_class($model),
            'imageable_id' => $model->id,
            'url' => $fileName["filepath"],
        ]);
    }
    public function roles() {
        return $this->belongsToMany(Roles::class,"admin_roles","admin_id","role_id");
    }
    public function hasPermissionTo($middlewareNeed) {
        $roles = $this->roles()->with("permissions:middleware")->get();
        $middlewares = [];
        foreach($roles as $role) {
            if($role->permissions) {
                $middlewares =  [...$role->permissions->pluck("middleware"), ...$middlewares];
            }
        }
        return in_array($middlewareNeed,$middlewares);
    }
}
