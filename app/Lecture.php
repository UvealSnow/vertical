<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model {
    
	public function teacher () {
		return $this->belongsTo('App\User', 'teacher_id');
	}

	public function schedule () {
		return $this->hasMany('App\Agenda');
	}

}
