<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
	protected $table= 'usuarios';


	public function mycars(){
	    return $this->hasMany('App\Models\Mycars','usuario_id');
	}

}
