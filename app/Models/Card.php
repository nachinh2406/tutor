<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = "info_identify_user";
    protected $guarded = [];
    public function getDateCardAttribute($value) {
        return Carbon::parse($value)->format("Y-m-d");
    }
    public function getExpireCardAttribute($value) {
        return Carbon::parse($value)->format("Y-m-d");
    }
}
