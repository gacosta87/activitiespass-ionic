<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasferiados extends Model
{
	protected $table= 'reservasferiados';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

}
