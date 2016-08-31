<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Package;
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
    public function create()
    {
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
    public function show($id)
    {
        $user = User::find($id);

        foreach ($user->lessons as $lesson) {
            $teacher = User::find($lesson->creator_id);
            $lesson->teacher = $teacher->first_name.' '.$teacher->last_name;
        }

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
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->email = $request->email;
        $user->password = bcrypt($request->email);
        $user->privilege = $request->privilege;
        $user->available_lessons = 0;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
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
        $user->available_lessons += $package->lessons;
        $user->save();
        return redirect('/user/'.$user->id);
    }

    public function listUsers () {
        $users = DB::table('users')->whereNotIn('privilege', ['admin'])->get();
        return response()->json($users);
    }

    public function userProfile (Request $req) {
        $user = User::find($req->user_id);
        return view('user.show', [
            'user' => $user,
        ]);
    }

}
