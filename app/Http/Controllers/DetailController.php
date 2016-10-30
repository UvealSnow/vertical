<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\User;
use App\Detail;

class DetailController extends Controller {

    public function __construct () {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ($user_id) {
        
        $user = User::find($user_id);

        return view ('detail.create', [
            'user' => $user,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id) {
        
        if (Auth::user() && in_array(Auth::user()->role_id, [1, 2])) {

            $this->validate($request, [
                'bone_injury' => 'required|boolean',
                'muscle_injury' => 'required|boolean',
                'heart_problems' => 'required|boolean',
                'breathing_problems' => 'required|boolean',
                'alergy_problems' => 'required|boolean',
                'medicine_intake' => 'required|boolean',
                'recent_activity' => 'required|boolean',
                'referer' => 'string',
            ]);

            $details = new Detail;

            $details->user_id = $user_id;
            $details->bone_injury = $request->bone_injury;
            $details->muscle_injury = $request->muscle_injury;
            $details->heart_problems = $request->heart_problems;
            $details->breathing_problems = $request->breathing_problems;
            $details->alergy_problems = $request->alergy_problems;
            $details->medicine_intake = $request->medicine_intake;
            $details->recent_activity = $request->recent_activity;
            $details->referer = $request->referer;

            $details->save();

            return redirect ("/user/$user_id")->with('success', 'Detalles agregados!');

        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($user_id, $id) {
        
        $user = User::find($user_id);

        return view ('detail.show', [
            'user' => $user,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $id) {
        
        $user = User::find($user_id);

        return view ('detail.edit', [
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
    public function update(Request $request, $user_id, $id) {
        
        if (Auth::user() && in_array(Auth::user()->role_id, [1, 2])) {

            $this->validate($request, [
                'bone_injury' => 'required|boolean',
                'muscle_injury' => 'required|boolean',
                'heart_problems' => 'required|boolean',
                'breathing_problems' => 'required|boolean',
                'alergy_problems' => 'required|boolean',
                'medicine_intake' => 'required|boolean',
                'recent_activity' => 'required|boolean',
                'referer' => 'string',
            ]);

            $details = Detail::find($id);

            $details->bone_injury = $request->bone_injury;
            $details->muscle_injury = $request->muscle_injury;
            $details->heart_problems = $request->heart_problems;
            $details->breathing_problems = $request->breathing_problems;
            $details->alergy_problems = $request->alergy_problems;
            $details->medicine_intake = $request->medicine_intake;
            $details->recent_activity = $request->recent_activity;
            $details->referer = $request->referer;

            $details->save();

            return redirect ("/user/$user_id/details/$id")->with('success', 'Detalles editados!');

        }
        return back();

    }

}
