<?php

namespace App\Models;

use App\Cart\Money;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const PENDING='pending';
    const PROCESSING='processing';
    const PAYMENT_FAILD='payment_failed';
    const COMPELETED='completed';

    protected $fillable =[
        'status','address_id','shipping_method_id','subtotal','payment_method_id'
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($order){
            $order->status=self::PENDING ;
        });
    }

    public function getSubtotalAttribute($value){
        return new Money($value) ;
    }

    public function total(){
        return $this->subtotal->add($this->shipping_method->price) ;
    }

    public function productVariations(){
        return $this->belongsToMany(ProductVariation::class ,'product_variation_order') ;
    }

    public function products(){
        return $this->belongsToMany(ProductVariation::class,'product_variation_order')
            ->withPivot('quantity')->withTimestamps() ;
    }

    public function address(){
        return $this->belongsTo(Address::class) ;
    }

    public function shipping_method(){
        return $this->belongsTo(ShippingMethod::class) ;
    }
}
