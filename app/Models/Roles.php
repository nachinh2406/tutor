<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $guarded = [];
    public function permissions() {
        return $this->belongsToMany(Permissions::class,"role_permissions","role_id","permission_id");
    }
    public function admins() {
        return $this->belongsToMany(Admin::class,"admin_roles","role_id","admin_id");
    }
}
