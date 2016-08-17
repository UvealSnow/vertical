<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medal;

class MedalController extends Controller
{
    public function __contruct () {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $user = $req->user();
        if ($user->privilege === 'admin') $medals = Medal::all();
        else $medals = $user->medals;
        
        return view('medal.index', [
            'user' => $user,
            'medals' => $medals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # var_dump($request->input()['name']);
        $medal = new Medal;

        $medal->name = $request->name;
        $medal->desc = $request->desc;
        $medal->img = $request->img;

        $medal->save();

        return redirect('/medal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medal = Medal::find($id);
        # var_dump($medal);
        return view('medal.show', [
            'medal' => $medal,
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
        $medal = Medal::find($id);
        return view('medal.edit', [
            'medal' => $medal,
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
        $medal = Medal::find($id);

        $medal->name = $request->name;
        $medal->desc = $request->desc;
        $medal->img = $request->img;

        $medal->save();

        return redirect('/medal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medal = Medal::find($id);
        $medal->delete();
        return redirect('/medal');
    }
}
