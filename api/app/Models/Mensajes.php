<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensajes extends Model
{
	protected $table= 'mensajes';

	public function usuariosfrom(){
	    return $this->belongsTo('App\Models\Usuarios','usuarioid_from');
	}

	public function usuariosdesty(){
	    return $this->belongsTo('App\Models\Usuarios','usuarioid_desty');
	}

	

}
