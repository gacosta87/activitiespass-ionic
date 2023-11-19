<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
	protected $table= 'reservas';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

	public function reservausuarios(){
	    return $this->belongsTo('App\Models\Usuarios','reservausuario_id');
	}

	

}
