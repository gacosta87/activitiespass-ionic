<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocionesusuarios extends Model
{
	protected $table= 'promocionesusuarios';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

}
