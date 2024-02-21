<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";
    protected $guarded = [];
    public function getStatusCustomAttribute($status)
    {
        if($status == ACTIVE) return  "<span class='badge rounded-pill badge-light-primary me-1'>Đang kích hoạt</span>";
        if($status == INACTIVE) return "<span class='badge rounded-pill badge-light-danger me-1'>Chưa kích hoạt</span>";
    }
    public function category() {
        return $this->belongsTo(SubjectCategory::class, "category_subject_id", "id");
    }
}
