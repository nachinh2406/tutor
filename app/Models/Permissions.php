<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $table = "permissions";
    protected $guarded = [];
    public function users() {
        return $this->belongsToMany(Roles::class,"role_permissions","permission_id","role_id");
    }
    public function childPermission() {
        return $this->hasMany(Permissions::class, "parent_id","id");
    }
}
