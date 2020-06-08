<?php
namespace App\Models\Traits ;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

trait HasChild
{
    public function scopeParent(Builder $builder){
        $builder->whereNull('parent_id') ;
    }


}
