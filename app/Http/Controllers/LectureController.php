<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $teachers = DB::table('users')->where('role_id', 2)->get();
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
    public function show($id) {

        $lecture = Lecture::find($id);

        return view ('lecture.show', [
            'lecture' => $lecture,
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
        //
    }
}
