<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model {

    public function schedule () {
        return $this->belongsTo('App\Agenda', 'agenda_id');
    }

    public function user () {
        return $this->belongsTo('App\User');
    }
    
}
