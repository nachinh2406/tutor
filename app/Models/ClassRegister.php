<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class ClassRegister extends Model
{
    use HasFactory;
    protected $table = "class_register";
    protected $guarded = [];
    const STATUS=[
        "1"=>"Trạng thái chờ",
        "2"=>"Trạng thái đã giao",
        "0"=>"Trạng thái hủy",
    ];
    public function class() {
        return $this->belongsTo(ClassSchool::class, "class_id", "id");
    }
    public function subject() {
        return $this->belongsTo(Subject::class, "subject_id", "id");
    }
    public function ward() {
        return $this->belongsTo(Ward::class, "ward_id", "id");
    }
    public function district() {
        return $this->belongsTo(District::class, "district_id", "id");
    }
    public function province() {
        return $this->belongsTo(Province::class, "province_id", "id");
    }
    public function getPriceClassAttribute($value)
    {
        return number_format($value, 0, '', ',');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,"class_user","class_id","user_id")->withPivot(['status','is_email','contract_id','file_contract','created_at','updated_at']);
    }
    public function getCreatedAtAssignAttribute()
    {
        return Carbon::parse(optional($this->pivot)->updated_at)->format("d-m-Y h:i:s");
    }
    public function scopeWithWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
        ->with([$relation => $constraint]);
    }
    protected $appends = ['created_at_assign'];
}
