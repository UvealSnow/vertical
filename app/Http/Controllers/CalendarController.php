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
					
					if ($start_date = $this->translateDay($agenda)) { # si pudimos obtener una fecha inicial de la función

						$name = $lecture->name.' con '.$lecture->teacher->name; # Un poco de edición al nombre
						$end_date = $this->translateDay($agenda, false); # el segundo parámetro opcional false nos dice que buscamos la hora a la que termina
						$url = "/lecture/$lecture->id/agenda/$agenda->id/enroll"; # Creamos la liga para el enroll

						$events[] = Calendar::event($name, false, $start_date, $end_date, null, ['url' => $url]); # Agregar evento al arreglo eventos

					}

				}
			}
		}

		$calendar = Calendar::addEvents($events)->setOptions([
			'firstDay' => 1,
			'header' => [
			 	'left' => '',
			 	'center' => '',
			 	'right' => '',
			 ],
			 'defaultView' => 'agendaWeek'
		]); # Inicializamos el calndario con los eventos que generamos

		return view ('calendar', compact('calendar')); # regresamos la vista calendar.blade.php con la variabe $calendar como parámetro

	}

	public function translateDay (\App\Agenda $agenda, $start = true) {

		if ($agenda->day == 'Lunes') $day = 'Monday';
		elseif ($agenda->day == 'Martes') $day = 'Tuesday';
		elseif ($agenda->day == 'Miércoles') $day = 'Wednesday';
		elseif ($agenda->day == 'Jueves') $day = 'Thursday';
		elseif ($agenda->day == 'Viernes') $day = 'Friday';
		elseif ($agenda->day == 'Sábado') $day = 'Saturday';
		elseif ($agenda->day == 'Domingo') $day = 'Sunday';
		else return false;

		if ($start) $hour = str_replace(':', '', $agenda->begins);
		else $hour = str_replace(':', '', $agenda->ends);

		$date = date('Y-m-').date('d', strtotime('this '.$day));

		return $date.'T'.$hour;

	}

}
