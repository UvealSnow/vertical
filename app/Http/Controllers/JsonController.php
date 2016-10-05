<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class JsonController extends Controller {
    
	public function __construct () {
		$this->middleware('auth');
	}

	public function usedPoles ($day_id) {

		$used_poles = DB::table('lesson_user')
						->where('day_id', $day_id)
						->select('pole_id')
						->orderBy('pole_id')
						->get();

		$j = 0;
		$poles = [];
		for ($i=0; $i <= 6; $i++) { 
			$poles[$i]['id'] = $i;
			if (($i + 1) == $used_poles[$j]->pole_id) {
				$poles[$i]['status'] = true;
				if (($j + 1) < count($used_poles)) $j++;
			}
			else $poles[$i]['status'] = false;
		}

		return response()->json($poles);

	}

}
