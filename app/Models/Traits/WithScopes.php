<?php

namespace  App\Models\Traits ;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;

trait WithScopes{
    public function scopeWithScopes(Builder $builder,$scopes=[]){
//        dd((new Scoper(\request()))->apply($builder,$scopes));
        return (new Scoper(\request()))->apply($builder,$scopes) ;
    }
}
