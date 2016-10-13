<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\Lecture;
use App\Agenda;
use App\Lesson;
use App\User;
use DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ($lecture_id) {
     
        return view ('agenda.index', [
            'lecture_id' => $lecture_id,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lecture_id) {
        
        $this->validate($request, [
            'day.*.id' => 'required|numeric|max:7',
            'day.*.starts' => 'required',
            'day.*.ends' => 'required'
        ]);

        $schedule = Agenda::where('lecture_id', $lecture_id)->get();

        if (count($schedule) > 0) {
            foreach ($schedule as $dead) {
                $dead->delete();
            }
        }

        foreach ($request->day as $day) {
            $lecture = new Agenda;

            if ($day['id'] == 1) $day_str = 'Lunes';
            elseif ($day['id'] == 2) $day_str = 'Martes';
            elseif ($day['id'] == 3) $day_str = 'Miércoles';
            elseif ($day['id'] == 4) $day_str = 'Jueves';
            elseif ($day['id'] == 5) $day_str = 'Viernes';
            elseif ($day['id'] == 6) $day_str = 'Sábado';
            elseif ($day['id'] == 7) $day_str = 'Domingo';

            $lecture->lecture_id = $lecture_id;
            $lecture->day = $day_str;
            $lecture->begins = $day['starts'];
            $lecture->ends = $day['ends'];
            $lecture->timestamps = false;

            $lecture->save();
        }

        return redirect ("/lecture/$lecture_id");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lecture_id, $agenda_id) {
        $agenda = Agenda::find($agenda_id);
        if ($agenda) {
            $agenda->delete();
            DB::table('lessons')->where('agenda_id', $agenda_id)->delete();    
        }
        return redirect ("/lecture/$lecture_id");
    }

    public function enroll ($lecture_id, $agenda_id) {

        $lecture = Lecture::find($lecture_id);
        $agenda = Agenda::find($agenda_id);

        return view ('agenda.enroll', [
            'lecture' => $lecture,
            'agenda' => $agenda,
        ]); 

    }

    public function enrollUser (Request $request, $lecture_id, $agenda_id) {

        $this->validate($request, [
            'date' => 'required',
            'pole_id' => 'numeric|max:7'
        ]);

        $user = Auth::user();
        $lecture = Lecture::find($lecture_id);
        $agenda = Agenda::find($agenda_id);

        if (count($this->enrolledUsers($agenda_id, $request->date)) < $lecture->max_students) {
            if ($lecture->is_pole && $user->pole_lessons > 0) $user->pole_lessons -= 1;
            elseif (!$lecture->is_pole && $user->regular_lessons > 0) $user->regular_lessons -= 1;
            else return redirect ("/lecture/$lecture_id");

            $lesson = new Lesson;
            $lesson->agenda_id = $agenda_id;
            $lesson->user_id = $user->id;
            $lesson->date = $request->date;
            if ($request->pole_id != NULL) $lesson->pole_id = $request->pole_id;

            $lesson->save();
            $user->save();

            return redirect ("/user/profile");

        }
        else return redirect ("/lecture/$lecture_id");

    }

    public function poleStatus ($agenda_id, $date) {

        $used_poles = $this->getUsedPoles($agenda_id, $date);

        $pole = [];
        $j = 0;

        for ($i = 1; $i <= 7; $i++) { 

            if (count($used_poles) > 0) {
                if ($used_poles[($j)]->pole_id == $i) {
                    $pole[$i]['status'] = true;
                    $pole[$i]['user'] = DB::table('users')->select('id', 'name')->where('id', $used_poles[$j]->user_id)->get();
                    if (($j + 1) < count($used_poles)) $j++;
                }
                else {
                    $pole[$i]['status'] = false;
                    $pole[$i]['user'] = null; 
                }
            }
            else {
                $pole[$i]['status'] = false;
                $pole[$i]['user'] = null; 
            }
        }

        return response()->json($pole);

    }

    public function getUsedPoles ($agenda_id, $date) {

        $used_poles = DB::table('lessons')
                    ->select('pole_id', 'user_id')
                    ->where('agenda_id', $agenda_id)
                    ->where('date', urldecode($date))
                    ->get();

        return $used_poles;

    }

    public function enrolledUsers ($agenda_id, $date) {

        $enrolled_users = DB::table('lessons')
                            ->join('users', 'users.id', '=', 'lessons.user_id')
                            ->select('users.id', 'users.name')
                            ->where('lessons.agenda_id', $agenda_id)
                            ->where('lessons.date', urldecode($date))
                            ->get();

        return $enrolled_users;

    }

    public function seeEnrolled ($lecture_id, $agenda_id) {
        if (in_array(Auth::user()->role_id, [1, 2])) {
            $lecture = Lecture::find($lecture_id);
            $agenda = Agenda::find($agenda_id);
            return view ('agenda.enrolled', [
                'lecture' => $lecture,
                'agenda' => $agenda,
            ]);
        }
        else return redirect ("/lecture/$lecture->id");
    }

}
