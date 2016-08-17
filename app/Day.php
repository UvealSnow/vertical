<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function lessons () {
    	return $this->belongsToMany('App\Lessons')->withPivot('lesson_begins', 'lesson_ends');
    }
}
