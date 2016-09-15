<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model {

    public function lessons () {
    	return $this->belongsToMany('App\Lesson')->withPivot('id', 'enrolled', 'date');
    }
    
}
