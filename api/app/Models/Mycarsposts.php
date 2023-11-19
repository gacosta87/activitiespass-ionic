<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycarsposts extends Model
{
	protected $table= 'mycarsposts';

	public function mycars(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}

}
