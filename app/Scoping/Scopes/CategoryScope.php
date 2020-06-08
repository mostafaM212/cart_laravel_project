<?php
namespace App\Scoping\Scopes ;

use \App\Scoping\Contructs\Scope ;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope  implements Scope
{


    public function apply(Builder $builder,$value){
//        dd($value);
        $builder->whereHas('categories',function ($builder) use ($value){
            $builder->where('slug',$value) ;
        });
    }
}
