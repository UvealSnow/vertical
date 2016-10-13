<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model {
    
	public function diet () {
		return $this->belongsTo('App\Diet', 'diet_id');
	}

}
