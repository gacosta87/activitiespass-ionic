<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycartagsbusqueda extends Model
{
	protected $table= 'mycartagsbusqueda';

	public function mycar(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}

}
