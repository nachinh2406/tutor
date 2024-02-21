<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassUser extends Model
{
    use HasFactory;
    protected $table = "class_user";
    protected $guarded = [];


}
