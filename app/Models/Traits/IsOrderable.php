<?php
namespace App\Models\Traits ;


use Illuminate\Database\Eloquent\Builder;

trait IsOrderable{

    public static function scopeOrdered(Builder $query,$directin='asc'){
        return $query->orderBy('order',$directin);
    }


}
