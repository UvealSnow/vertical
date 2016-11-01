<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Requests;

use App\Lecture;

class CalendarController extends Controller {
    
	public function showCalendar () {

		$events =  []; # Iniciar arreglo vació de eventos con los cuales llenar el calendario

		$lectures = Lecture::all(); # Obtener todas las clases que se están dando en Vertical

		foreach ($lectures as $lecture) { # Ir clase por clase
			if (count($lecture->schedule) > 0) { # sól si la clase tiene un horario definido
				foreach ($lecture->schedule as $agenda) { # ir horario por horario de cada clase
					
					if ($date = $this->translateDay($agenda->day)) { # si pudimos obtener una fecha de la función

						$events[] = Calendar::event($lecture->name, false, $date, $date, 0); # Agregar evento al arreglo eventos

					}

				}
			}
		}

		$calendar = Calendar::addEvents($events)->setOptions(['firstDay' => 1]); # Inicializamos el calndario con los eventos que generamos

		return view ('calendar', compact('calendar')); # regresamos la vista calendar.blade.php con la variabe $calendar como parámetro

	}

	public function translateDay ($day) {

		if ($day == 'Lunes') $day = 'Monday';
		elseif ($day == 'Martes') $day = 'Tuesday';
		elseif ($day == 'Miércoles') $day = 'Wednesday';
		elseif ($day == 'Jueves') $day = 'Thursday';
		elseif ($day == 'Viernes') $day = 'Friday';
		elseif ($day == 'Sábado') $day = 'Saturday';
		elseif ($day == 'Domingo') $day = 'Sunday';
		else return false;

		$date = date('Y-m-').date('d', strtotime('this '.$day));

		return $date;

	}

}
