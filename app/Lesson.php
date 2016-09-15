<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {

    public function days () {
    	return $this->belongsToMany('App\Day')->withPivot('id', 'enrolled', 'date');
    }

    public function poles () {
    	return $this->hasMany('App\Pole');
    }

    public function users () {
    	return $this->belongsToMany('App\User')->withPivot('id', 'pole_id', 'day_id');
    }

    public function teacher () {
    	return $this->belongsTo('App\User', 'teacher_id');
    }
    
}
