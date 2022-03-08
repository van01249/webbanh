<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'product_type';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function Product()
    {
        return $this->hasMany('App\products','id_type','id');
    }
}
