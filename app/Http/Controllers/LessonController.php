<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Lecture;
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

        $teachers = DB::table('users')->where('role_id', 2)->get();

        return view ('lesson.create', [
            'teachers' => $teachers,
        ]);
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
            'teacher' => 'required|numeric',
            'max_num' => 'required|numeric',
            'type' => 'required|in:pole,other',
        ]);

        if (Auth::user()->role_id == 1) {

            $lesson = new Lesson;


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, $id) {

        $user = $request->user();
        $user->lessons = $user->lessons()->where('lesson_id', $id)->get();
        $lesson = Lesson::find($id);
        $enrolled = array();

        foreach ($user->lessons as $lesson) {
            $enrolled[] = $lesson->pivot->day_id;
        }

        return view('lesson.show', [
            'user' => $user,
            'lesson' => $lesson,
            'enrolled' => $enrolled,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, $id) {
        $user =  $request->user();
        if ($user->privilege != 'admin' && $user->privilege != 'Maestra') { # user does not have privilege to modify
            return redirect('/lesson')->withErrors(['msg', 'No tienes privilegios para modificar esta clase']);
        }
        else { # user is either admin or teacher
            $teachers = User::where('privilege', 'Maestra')->get();
            $lesson = Lesson::find($id);

            $days_query = DB::table('lessons')
                    ->join('day_lesson', 'day_lesson.lesson_id', '=', 'lessons.id')
                    ->join('days', 'days.id', '=', 'day_lesson.day_id')
                    ->select('days.id')
                    ->where('lessons.id', $lesson->id)
                    ->distinct()
                    ->orderBy('days.id')
                    ->get();

            $days = [];
            foreach ($days_query as $day) {
                $days[] = $day->id;
            }

            # var_dump($days);

            if ($user->id == $lesson->creator_id || $user->privilege === 'admin') {
                return view('lesson.edit', [
                    'days' => $days,
                    'teachers' => $teachers,
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
    public function update (Request $request, $id) {

        $user = Auth::user();

        if (in_array($user->privilege, ['admin', 'Maestra'])) {
            
            $lesson = Lesson::find($id);

            $lesson->name = $request->name;
            $lesson->teacher_id = $request->teacher;
            $lesson->begins = $request->starts;
            $lesson->ends = $request->ends;
            if ($request->type != 'pole') $lesson->use_poles = false;
            else $lesson->use_poles = true;

            #$lesson->save();

            # gets users that were affected by the change and gives them back the credits
            $users = DB::table('lessons') 
                        ->join('lesson_user', 'lesson_user.lesson_id', '=', 'lessons.id')
                        ->join('users', 'users.id', '=', 'lesson_user.user_id')
                        ->select('users.id')
                        ->where('lessons.id', $id)
                        ->get();

            # var_dump($users);

            if (count($users) > 0) {
                foreach ($users as $affected) {
                    $usr = User::find($affected->id);

                    if ($usr != NULL) {
                        if ($lesson->use_poles) $usr->pole_lessons++;
                        else $usr->available_lessons++;
                        $usr->save();
                    }

                }
            }

            DB::table('day_lesson')->where('lesson_id', $lesson->id)->delete();

            
            foreach ($request->days as $day) {
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

            return redirect ('/lesson/'.$id);

        }
        else return redirect ('/lesson/'.$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id) {
        $lesson = Lesson::find($id);

        # gets users that were affected by the change and gives them back the credits
        $users = DB::table('lessons') 
                    ->join('lesson_user', 'lesson_user.lesson_id', '=', 'lessons.id')
                    ->join('users', 'users.id', '=', 'lesson_user.user_id')
                    ->select('users.id')
                    ->where('lessons.id', $id)
                    ->get();

        # var_dump($users);

        if (count($users) > 0) {
            foreach ($users as $affected) {
                $usr = User::find($affected->id);

                if ($usr != NULL) {
                    if ($lesson->use_poles) $usr->pole_lessons++;
                    else $usr->available_lessons++;
                    $usr->save();
                }

            }
        }

        DB::table('lesson_user')->where('lesson_id', $lesson->id)->delete();
        DB::table('day_lesson')->where('lesson_id', $lesson->id)->delete();

        $lesson->delete();
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
        $day = $request->day;

        if ($lesson->use_poles) $user->lessons()->attach($id, ['pole_id' => $request->pole_id, 'day_id' => $request->day]);
        else $user->lessons()->attach($id, ['pole_id' => 0, 'day_id' => $request->day]);
        
        if ($lesson->use_poles) $user->pole_lessons--;
        else $user->available_lessons--;
        $user->save();

        $enrolled = $lesson->days($day)->first()->pivot->enrolled + 1;
        DB::table('day_lesson')->where('id', $day)->update(['enrolled' => $enrolled]);

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

    public function renewLesson (Request $request, $id) {

        $user = $request->user();
        $lesson = Lesson::find($id);

        if ($user->privilege === 'admin' || $user->privilege === 'Maestra') {

            $lesson->unique = DB::table('day_lesson')->select('day_id')->distinct()->get(); # get unique day ids

            for ($i=0; $i < $request->time ; $i++) { # repeat for each month
                $lesson->max = date('d-m-Y', strtotime($lesson->days()->max('date'))); # get max date

                foreach ($lesson->unique as $j => $day) {

                    # create 1 month of classes starting from closest day next week
                    if (intval($day->day_id) == 1)     $start = date('d-m-Y', strtotime('next monday', strtotime($lesson->max)));
                    elseif (intval($day->day_id) == 2) $start = date('d-m-Y', strtotime('next tuesday', strtotime($lesson->max)));
                    elseif (intval($day->day_id) == 3) $start = date('d-m-Y', strtotime('next wednesday', strtotime($lesson->max)));
                    elseif (intval($day->day_id) == 4) $start = date('d-m-Y', strtotime('next thursday', strtotime($lesson->max)));
                    elseif (intval($day->day_id) == 5) $start = date('d-m-Y', strtotime('next friday', strtotime($lesson->max)));
                    elseif (intval($day->day_id) == 6) $start = date('d-m-Y', strtotime('next saturday', strtotime($lesson->max)));
                    elseif (intval($day->day_id) == 7) $start = date('d-m-Y', strtotime('next sunday', strtotime($lesson->max)));

                    $lesson->days()->attach($day, ['enrolled' => 0, 'date' => $start]);
                    $lesson->days()->attach($day, ['enrolled' => 0, 'date' => date('d-m-Y', strtotime($start. ' +7 days'))]);
                    $lesson->days()->attach($day, ['enrolled' => 0, 'date' => date('d-m-Y', strtotime($start. ' +14 days'))]);
                    $lesson->days()->attach($day, ['enrolled' => 0, 'date' => date('d-m-Y', strtotime($start. ' +21 days'))]);

                    return redirect ('/lesson/'.$lesson->id);

                }
            }
            
           # var_dump($lesson->unique[0]->day_id);
        }
        else return redirect ('/lesson/'.$lesson->id);

    }



}
