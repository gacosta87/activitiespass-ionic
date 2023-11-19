<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historialpushusuarios extends Model
{
	protected $table= 'historialpushusuarios';


	public function usuario(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

	public function usuariolink(){
	    return $this->belongsTo('App\Models\Usuarios','usuariomycar_id');
	}

	public function mycars(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}


}
