<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatlistas extends Model
{
	protected $table= 'chatlistas';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}


	public function chatmensaje(){
	    return $this->hasMany('App\Models\Chatmensajes','chatlista_id');
	}


	public function chatmensajeultimo(){
	    return $this->hasMany('App\Models\Chatmensajes','chatlista_id')->orderBy('id', 'desc');
	}

}
