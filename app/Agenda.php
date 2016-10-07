<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {
    
	public function lessons () {
		return $this->hasMany('App\Lesson');
	}

	public function lecture () {
		return $this->belongsTo('App\Lecture');
	}

}
