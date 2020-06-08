<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Namshi\JOSE\JWT;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table ='users' ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(){
        parent::boot();

        static::creating(function ($user){
            $user->password =Hash::make($user->password) ;
        });
    }

    /**
     * @inheritDoc to identify the user
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.

        return $this->id ;
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [] ;
    }

    public function carts(){
        return $this->belongsToMany(ProductVariation::class,'cart_user')
            ->withPivot('quantity')->withTimestamps() ;
    }

    public function addresses(){

        return $this->hasMany(Address::class) ;
    }

    public function orders(){
        return $this->hasMany(Order::class) ;
    }

    public function paymentMethods(){
        return $this->hasMany(PaymentMethod::class) ;
    }
}
