<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycarstipcalificaciones extends Model
{
	protected $table= 'mycarstipcalificaciones';

	public function usuarios(){
	    return $this->belongsTo('App\Models\Usuarios','usuario_id');
	}

	public function tips(){
	    return $this->belongsTo('App\Models\Mycarstips','mycarstip_id');
	}

}
