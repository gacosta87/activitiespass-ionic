<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocionesdist extends Model
{
	protected $table= 'promocionesdist';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

	public function mycars(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}


}
