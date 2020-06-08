<?php


namespace App\Scoping\Contructs;


use Illuminate\Database\Eloquent\Builder;

interface Scope
{
    public function apply(Builder $builder,array $scopes) ;
}
