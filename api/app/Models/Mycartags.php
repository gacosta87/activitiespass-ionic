<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycartags extends Model
{
	protected $table= 'mycartags';

	public function mycar(){
	    return $this->belongsTo('App\Models\Mycars','mycar_id');
	}

}
