<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Lesson;
use App\Pole;
use App\User;
use App\Day;
use DB;

class LessonController extends Controller
{
    public function __construct () {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = $request->user();
        $lessons = Lesson::all();

        foreach ($lessons as $lesson) {
            $lesson->teacher = User::find($lesson->teacher_id);
        }
        
        return view('lesson.index', [
            'user' => $user,
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $user = $request->user();
        $lesson = new Lesson;

        $lesson->name = $request->input('name');
        $lesson->desc = $request->input('desc');
        $lesson->max_students = $request->input('max_num');

        if ($request->input('type') === 'pole') $lesson->use_poles = true;
        else $lesson->use_poles = false;

        $lesson->begins = $request->input('starts');
        $lesson->ends = $request->input('ends');

        $lesson->teacher_id = $user->id;

        if ($lesson->save()) {
            foreach ($request->input('days') as $day) { 
                $today = date('d-m-Y');
                # create 1 month of classes starting from closest day next week
                if (intval($day) == 1) $start = date('d-m-Y', strtotime('next monday'));
                elseif (intval($day) == 2) $start = date('d-m-Y', strtotime('next tuesday'));
                elseif (intval($day) == 3) $start = date('d-m-Y', strtotime('next wednesday'));
                elseif (intval($day) == 4) $start = date('d-m-Y', strtotime('next thursday'));
                elseif (intval($day) == 5) $start = date('d-m-Y', strtotime('next friday'));
                elseif (intval($day) == 6) $start = date('d-m-Y', strtotime('next saturday'));
                elseif (intval($day) == 7) $start = date('d-m-Y', strtotime('next sunday'));

                $lesson->days()->attach($day, ['enrolled' => 0, 'date' => $start]);
                $lesson->days()->attach($day, ['enrolled' => 0, 'date' => date('d-m-Y', strtotime($start. ' +7 days'))]);
                $lesson->days()->attach($day, ['enrolled' => 0, 'date' => date('d-m-Y', strtotime($start. ' +14 days'))]);
                $lesson->days()->attach($day, ['enrolled' => 0, 'date' => date('d-m-Y', strtotime($start. ' +21 days'))]);

            }
        }

        return redirect('/lesson');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {

        $user = $request->user();
        $lesson = Lesson::find($id);

        return view('lesson.show', [
            'user' => $user,
            'lesson' => $lesson,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $user =  $request->user();
        if ($user->privilege != 'admin' && $user->privilege != 'Maestra') { # user does not have privilege to modify
            return redirect('/lesson')->withErrors(['msg', 'No tienes privilegios para modificar esta clase']);
        }
        else { # user is either admin or teacher
            $lesson = Lesson::find($id);
            if ($user->id == $lesson->creator_id || $user->privilege === 'admin') {
                return view('lesson.edit', [
                    'lesson' => $lesson,
                ]);
            }
            else {
                return redirect('/lesson')->withErrors(['msg', 'No tienes privilegios para modificar esta clase']);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->destroy();
        return redirect('/lesson');
    }

    /**
    * Enroll user form
    *
    * 
    * @return \Illuminate\Http\Response
    */
    public function signUp (Request $request, $id) {
        $user = $request->user();
        $lessons = Lesson::find($id);
        foreach ($lessons as $lesson) {
            $lesson->available = $lesson->max_students - $lesson->enrolled_students;
        }
        $user_lessons = array();
        foreach ($user->lessons as $i => $lesson) {
            $user_lessons[$i] = $lesson->id;
        }
        return view('lesson.enroll', [
            'user_lessons' => $user_lessons,
            'lessons' => $lessons,
        ]);
    }

    /**
    * Enroll user to class
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function enrollUser (Request $request, $id) {

        $user = $request->user();
        $lesson = Lesson::find($id);
        $days = $request->input('days');

        if (($lesson->use_poles && $user->pole_lessons >= count($days)) || 
            (!$lesson->use_poles && $user->available_lessons >= count($days))) {
            foreach ($days as $day) {
                if (isset($day['pole'])) $user->lessons()->attach($id, ['pole_id' => $day['pole'], 'day_id' => $day['day']]);
                else $user->lessons()->attach($id, ['pole_id' => 0, 'day_id' => $day['day']]);

                # take away one credit
                if ($lesson->use_poles) $user->pole_lessons--;
                else $user->available_lessons--;
                $user->save();

                # uodate day_lesson enrolled
                $enrolled = $lesson->days($day['day'])->first()->pivot->enrolled + 1;
                DB::table('day_lesson')->where('id', $day['day'])->update(['enrolled' => $enrolled]);
            }
        }
        

        return redirect('/lesson');
        
    }

    /**
    * Show place select form
    *
    * 
    * @return \Illuminate\Http\Response
    */
    public function placeForm () {
        $lesson = Lesson::find($_GET['id']);
        $used = array();

        foreach ($lesson->users as $i => $user) {
            $used[$i] = $user->pivot->pole_id;
        }

        return view('lesson.pole', [
            'lesson' => $lesson,
            'used' => $used,
        ]);
    }

}
