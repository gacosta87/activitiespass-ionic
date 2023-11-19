<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasconfigs extends Model
{
	protected $table= 'reservasconfigs';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

}
