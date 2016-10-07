<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Medal;

class MedalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        if (Auth::user()->role_id == 1) $medals = Medal::all();
        else $medals = $user->medals;
        
        return view('medal.index', [
            'medals' => $medals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        return view('medal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request) {
        
        $this->validate($request, [
            'name' => 'required|max:50',
            'desc' => 'required',
            'img' => 'required|image'
        ]);

        if (Auth::user()->role_id == 1) {
            $medal = new Medal;

            $imgName = $this->generateKey().'.'.$request->file('img')->getClientOriginalExtension();

            $medal->name = $request->name;
            $medal->desc = $request->desc;
            $medal->img = $imgName;

            $request->file('img')->move(base_path().'/public/assets/images/medals', $imgName);

            $medal->save();

            return redirect("/medal/$medal->id");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $medal = Medal::find($id);
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
    public function edit($id) {
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

    public function generateKey ($length = 32, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

}
