<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use App\Package;
use App\Medal;
use DB;

class UserController extends Controller
{
    public function __construct () {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $user = new User;

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->privilege = $request->privilege;
        $user->available_lessons = 0;
        $user->pole_lessons = 0;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;

        $user->save();
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $user = User::find($id);
        #$user->lessons = $user->lessons->groupBy('name');

        /*
        foreach ($user->lessons as $lesson) {

            $lesson[0]['schedule'] = $lessons = DB::table('lessons')
            ->select('lessons.id', 'lessons.name', 'lesson_user.pole_id', 'day_lesson.date', 'lessons.begins', 'lessons.ends')
            ->groupBy('lessons.id', 'lessons.name', 'lesson_user.pole_id', 'day_lesson.date')
            ->join('lesson_user', 'lessons.id', '=', 'lesson_user.lesson_id')
            ->join('day_lesson', 'lesson_user.day_id', '=', 'day_lesson.id')
            ->where('lesson_user.user_id', $user->id)
            ->where('lesson_user.lesson_id', $lesson[0]['id'])
            ->get();

            /*echo '<pre>';
            var_dump($lesson[0]['schedule']);
            echo '</pre>';
        }
        */

        return view('user.show', [
            'user' => $user,
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
        $user = User::find($id);
        return view('user.edit', [
            'user' => $user,
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
        $user = User::find($id);

        $user->email = $request->email;
        $user->privilege = $request->privilege;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->available_lessons = $request->regular_lessons;
        if ($request->regular_lessons === 0) $user->lesson_expire = null;
        $user->pole_lessons = $request->pole_lessons;
        if ($request->pole_lessons === 0) $user->pole_expire = null;
        $user->phone = $request->phone;

        $user->save();
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }

    /**
     * Show add package to user form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAddForm ($id) {
        $user = User::find($id);
        $packages = Package::all();
        if ($user->privilege = 'admin') {
            return view('user.package', [
                'user' => $user,
                'packages' => $packages,
            ]);
        }
        else return redirect('/user/$id');
    }

    public function addPackage (Request $req) {
        $user = User::find($req->user_id);
        $package = Package::find($req->package_id);
        if ($package->regular_lessons != 0) {
            $user->available_lessons += $package->regular_lessons;
            $user->lesson_expire = date('d-m-Y', strtotime('+30 days'));
        }
        if ($package->pole_lessons) { 
            $user->pole_lessons += $package->pole_lessons;
            $user->pole_expire = date('d-m-Y', strtotime('+30 days'));
        }
        $user->save();
        return redirect('/user/'.$user->id);
    }

    public function listUsers () {
        $users = DB::table('users')
                    ->join('roles', 'roles.id', '=', 'users.role_id')
                    ->select('users.id', 'users.email', 'users.name', 'roles.title')
                    ->whereNotIn('role_id', [1])
                    ->get();
        return response()->json($users);
    }

    public function userProfile (Request $request) {

        $user = $request->user();
        #$user->lessons = $user->lessons->groupBy('name');

        /*
        foreach ($user->lessons as $lesson) {

            $lesson[0]['schedule'] = $lessons = DB::table('lessons')
            ->select('lessons.id', 'lessons.name', 'lesson_user.pole_id', 'day_lesson.date', 'lessons.begins', 'lessons.ends')
            ->groupBy('lessons.id', 'lessons.name', 'lesson_user.pole_id', 'day_lesson.date')
            ->join('lesson_user', 'lessons.id', '=', 'lesson_user.lesson_id')
            ->join('day_lesson', 'lesson_user.day_id', '=', 'day_lesson.id')
            ->where('lesson_user.user_id', $user->id)
            ->where('lesson_user.lesson_id', $lesson[0]['id'])
            ->get();

            /*echo '<pre>';
            var_dump($lesson[0]['schedule']);
            echo '</pre>';
        }
        */

        return view('user.show', [
            'user' => $user,
        ]);

    }

    public function userShow (Request $request) {
        return redirect ('/user/'.$request->user_id);
    }

    public function medalForm ($uid) {


        if (in_array(Auth::user()->role_id, [1, 2, 3])) {

            $alumn = User::find($uid);
            $medals = Medal::all();

            return view ('user.medals', [
                'alumn' => $alumn,
                'medals' => $medals,
            ]);

        }
        else return redirect ('/user/'.$uid);

    }

    public function giveMedal (Request $request, $uid) {

        $this->validate($request, [
            'medal_id' => 'required|numeric|exists:medals,id'
        ]);

        if (in_array(Auth::user()->role_id, [1, 2, 3])) {

            $alumn = User::find($uid);
            $alumn->medals()->attach($request->medal_id);

            return redirect ('/user/'.$uid);

        }
        else return redirect ('/user/'.$uid);

    }

}


















