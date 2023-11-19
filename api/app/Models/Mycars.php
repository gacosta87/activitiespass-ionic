<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycars extends Model
{
	protected $table= 'mycars';

	public function mycartipos(){
	    return $this->belongsTo('App\Models\Mycartipos','mycartipo_id');
	}

	public function usuarios(){
	    return $this->hasMany('App\Models\Usuarios','mycar_id');
	}

	public function mycartags(){
	    return $this->hasMany('App\Models\Mycartags','mycar_id');
	}

	

}
