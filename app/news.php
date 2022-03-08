<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    //
    protected $table = "news";
     public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}
