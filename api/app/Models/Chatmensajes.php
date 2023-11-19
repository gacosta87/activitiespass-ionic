<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatmensajes extends Model
{
	protected $table= 'chatmensajes';


	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}


	public function chatlista(){
	    return $this->belongsTo('App\Models\Chatlistas','chatlista_id');
	}

}
