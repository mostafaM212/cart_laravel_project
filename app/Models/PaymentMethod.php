<?php

namespace App\Models;

use App\Models\Traits\CanBeDefault;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use CanBeDefault ;
    //

    protected $fillable =[
        'cart_type','last_four','provider_id','default'
    ];



    public function user(){
        return $this->belongsTo(User::class) ;
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
