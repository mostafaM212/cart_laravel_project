<?php

namespace App\Models\Traits ;

trait CanBeDefault {

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($address){

            if ($address->default){
                $address->default =true ;
                $address->newQuery()->where('user_id',$address->user->id)->update([
                    'default'=>false
                ]);

            }
        });
    }
    /*
     * to make sure that data will store in database is bool
     */
    public function setDefaultAttribute($value){

        return $this->attributes['default'] =($value ==='true'|| $value ? true :false);
    }



}
