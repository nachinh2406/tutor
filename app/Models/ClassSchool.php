<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchool extends Model
{
    use HasFactory;
    protected $table = "classes";
    protected $guarded = [];
    public function getLevelClassCustomAttribute($levelGetter)
    {
        foreach(LEVEL_SCHOOL as $level => $title) {
            if($levelGetter == $level) return $title;
        }
    }
}
