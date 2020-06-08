<?php

namespace App\Scoping ;

use App\Scoping\Constructs\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request ;

class Scoper{

    protected $request ;
    public function __construct(Request $request)
    {
        $this->request =$request ;
    }

    public function apply(Builder $builder,array $scopes){

//        dd($scopes);
        foreach ($scopes as $key=>$scope){

            if (  !$this->request->exists($key) ){
                continue ;
            }

            $scope->apply($builder,$this->request->get($key)) ;
        }

        return $builder ;

    }

}
