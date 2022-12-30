<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getJWTCustomClaims(){
        return [];
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }


    protected $fillable = [
        'role_id',
        'first_name',
        'second_name',
        'personal_phone',
        'email',
        'password',
        'address',
        'birthdate',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Relación de uno a muchos
    // Un usuario le pertenece un rola
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación de uno a muchos
    // Un usuario puede realizar muchos feedback
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Relación polimórfica uno a uno
    // Un usuario puede tener una imagen
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }       

    public function commerces()
    {
        return $this->hasOne(Commerce::class);
    }   

    public function products()
    {
        return $this->hasMany(Product::class);
    }    
 
    public function getFullName(): string
    {
        return "$this->first_name $this->second_name";
    }
 
    public function getBirthdateAttribute($value): ?string
    {
        return isset($value) ? Carbon::parse($value)->format('d/m/Y') : null;
    }    
}
