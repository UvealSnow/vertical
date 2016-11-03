<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Requests;

use App\Lecture;
use DB;

class LectureController extends Controller {

    public function __construct () {
        $this->middleware('auth');
    }

    /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function index() {
        $lectures = Lecture::all();
        return view ('lecture.index', [
            'lectures' => $lectures,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        if (in_array(Auth::user()->role_id, [1, 2])) {
            $teachers = $this->getTeachers();
            return view ('lecture.create', [
                'teachers' => $teachers,
            ]);
        }
        else return redirect ("/lecture");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request) {

        $this->validate($request, [
            'name' => 'required|max:255',
            'teacher_id' => 'required|numeric',
            'max_num' => 'required|numeric',
            'type' => 'required|in:pole,other'
        ]);

        if (in_array(Auth::user()->role_id, [1, 2])) {
            $lecture = new Lecture;
            
            $lecture->name = $request->name;
            $lecture->teacher_id = $request->teacher_id;
            $lecture->max_students = $request->max_num;
            if ($request->type == 'pole') $lecture->is_pole = true;
            else $lecture->is_pole = false;

            $lecture->save();

            return redirect ("/lecture/$lecture->id");
        }
        else return redirect ("/lecture");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id) {

        $lecture = Lecture::find($id);

        $calendar = $this->showCalendar($lecture);

        return view ('lecture.show', [
            'calendar' => $calendar,
            'lecture' => $lecture,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $lecture = Lecture::find($id);
        $teachers = $this->getTeachers();

        return view ('lecture.edit', [
            'teachers' => $teachers,
            'lecture' => $lecture
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|numeric',
            'max_num' => 'required|numeric',
            'type' => 'required|string|in:pole,other'
        ]);

        $lecture = Lecture::findOrFail($id);

        $lecture->name = $request->name;
        $lecture->teacher_id = $request->teacher_id;
        $lecture->max_students = $request->max_num;
        $lecture->is_pole = false;
        if ($request->type == 'pole') $lecture->is_pole = true;
        $lecture->save();

        return redirect ("/lecture/$lecture->id");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $lecture = Lecture::findOrFail($id);

        $schedule = DB::table('agendas')
                    ->where('lecture_id', $lecture->id)
                    ->pluck('id');

        DB::table('agendas')->where('lecture_id', $lecture->id)->delete();
        DB::table('lessons')->whereIn('agenda_id', $schedule)->delete();
        $lecture->delete();

        return redirect ("/lecture");

    }

    public function getTeachers () {
        $teachers = DB::table('users')->where('role_id', 2)->get();
        return $teachers;
    }

    public function showCalendar (Lecture $lecture) {

        $events =  []; # Iniciar arreglo vació de eventos con los cuales llenar el calendario

        # $lectures = Lecture::all(); # Obtener todas las clases que se están dando en Vertical

        #foreach ($lectures as $lecture) { # Ir clase por clase
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
        #}

        $calendar = Calendar::addEvents($events)->setOptions([ # Inicializamos el calndario con los eventos que generamos
            'firstDay' => 1, # Lunes = primer día
            'header' => [ # Eliminamos el UI con esto
                'left' => '', 
                'center' => '',
                'right' => '',
            ],
            'defaultView' => 'agendaWeek', # cambiamos vista inicial
            'hiddenDays' => [6, 0],
            'businessHours' => [
                'dow' => [1, 2, 3, 4, 5],
                'start' => '07:00',
                'end' => '23:00',
            ],
            'minTime' => '07:00:00',
            'maxTime' => '23:00:00'
        ]); 

        return $calendar;
        # return view ('calendar', compact('calendar')); # regresamos la vista calendar.blade.php con la variabe $calendar como parámetro

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
