<?php

namespace App\Models;

use App\Models\Traits\HasChild;
use App\Models\Traits\isOrderable;
use App\Scoping\Scopper;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //to do anny scope you should use builder class
    use  isOrderable,HasChild ;
    protected $fillable =[
        'name','slug','order'
    ];

    public function children(){
        return $this->hasMany(Category::class ,'parent_id','id') ;
    }

    public function products(){
        return $this->belongsToMany(Product::class) ;
    }


}
