<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model {
    
	public function meals () {
		return $this->hasMany('App\Meal', 'diet_id');
	}

	public function nutriologist () {
		return $this->belongsTo('App\User', 'nutriologist_id');
	}

	public function student () {
		return $this->belongsTo('App\User', 'user_id');
	}

}
