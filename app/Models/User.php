<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function school() {
        return $this->belongsTo(School::class,"school_id","id");
    }
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
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(ClassRegister::class,"class_user","user_id","class_id")->withPivot(['status','is_email','contract_id','file_contract','created_at','updated_at']);
    }
    public function scopeWithWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
        ->with([$relation => $constraint]);
    }
    public function getCreatedAtAssignAttribute()
    {
        return Carbon::parse(optional($this->pivot)->created_at)->format("d-m-Y H:i:s");
    }
    public function card() {
        return $this->hasOne(Card::class,"user_id","id");
    }

    protected $appends = ['created_at_assign'];

}
