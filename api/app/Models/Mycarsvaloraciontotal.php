<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycarsvaloraciontotal extends Model
{
	protected $table= 'mycars_valoracion_total';

	public function usuarios(){
	    return $this->hasMany('App\Models\Usuarios','mycar_id');
	}

	public function mycartags(){
	    return $this->hasMany('App\Models\Mycartags','mycar_id');
	}

	public function publicaciones(){
	    return $this->hasMany('App\Models\Publicaciones','mycar_id');
	}


	

}
