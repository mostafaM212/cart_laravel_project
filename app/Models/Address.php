<?php

namespace App\Models;

use App\Models\Traits\CanBeDefault;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable =[
        'name','address_1','city','postal_code','country_id','default'
    ];
    use CanBeDefault ;
    public function user(){

        return $this->belongsTo(User::class) ;
    }

    public function country(){

        return $this->hasOne(Country::class,'id','country_id') ;
    }
}
