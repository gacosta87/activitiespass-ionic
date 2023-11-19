<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
	protected $table= 'publicaciones';

	public function mycars(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

	public function comentarios(){
	    return $this->hasMany('App\Models\Mycarscomentarios','publicacione_id');
	}

	public function likes(){
	    return $this->hasMany('App\Models\Publicaciones_like','publicacione_id');
	}


}
