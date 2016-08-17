<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function days () {
    	return $this->belongsToMany('App\Day')->withPivot('lesson_begins', 'lesson_ends');
    }

    public function poles () {
    	return $this->hasMany('App\Pole');
    }
}
