<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Lesson;
use App\Pole;
use App\User;
use App\Day;

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
    public function index(Request $req)
    {
        $user = User::find($req->user()['id']);
        if ($user->privilege === 'Maestra') $lessons = Lesson::all()->where('creator_id', $user->id);
        elseif ($user->privilege === 'admin') $lessons = Lesson::all();
        else $lessons = $user->lessons;

        foreach ($lessons as $lesson) {
            $teacher = User::find($lesson->creator_id);
            $lesson->teacher = $teacher->first_name.' '.$teacher->last_name;
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
    public function create()
    {
        return view('lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new Lesson;

        # to do validation
        
        $lesson->name = $request->name;
        $lesson->desc = $request->desc;
        if ($request->use_pole == 'true') $lesson->use_poles = true;
        else $lesson->use_poles = false;
        $lesson->enrolled_students = 0;
        $lesson->max_students = $request->max_num;
        $lesson->creator_id = $request->user()->id;
        $lesson->save();

        $start = intval(substr($request->start, 0,2));
        $ends = intval(substr($request->finish, 0,2));

        if (strpos($request->start, 'PM')) {
            $start += 12;
            $ends += 12;
        }

        # var_dump($start, $ends);

        foreach ($request->days as $day) {
            $tag = Day::find($day);
            $lesson->days()->attach($tag, ['lesson_begins' => $start, 'lesson_ends' => $ends]); 
            # The line above links lessons - day_lesson - days one day at a time, also sets the times
        }

        return redirect('/lesson');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        $user = User::find($lesson->creator_id);
        $lesson->teacher = $user->first_name.' '.$user->last_name;

        return view('lesson.show', [
            'lesson' => $lesson,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function signUp (Request $req) {
        $user = $req->user();
        $lessons = Lesson::all();
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
    public function enrollUser (Request $req) {
        $user = User::find($req->user()['id']);
        $lesson = Lesson::find($req->lesson_id);
        if ($user->available_lessons > 0) {
            if (!$lesson->use_poles) $user->lessons()->attach($lesson, ['pole_id' => 0]);
            else $user->lessons()->attach($lesson, ['pole_id' => $req->pole_id]);
            $lesson->enrolled_students += 1;
            $lesson->save();
            return redirect('/lesson')->with('good', 'Te inscribiste a la clase seleccionada');
        }
        else return redirect('/lesson/signup')->with('error', 'No tienes clases disponibles para utilizar. ¡Compra un nuevo paquete!');
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
