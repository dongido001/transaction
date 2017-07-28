<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    //

    public function bankAccount(){

    	return $this->hasMany('App\bankAccount');
    }
}
