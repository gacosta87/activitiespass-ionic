<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacioneslike extends Model
{
	protected $table= 'publicacioneslike';


	public function mycars(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

}
