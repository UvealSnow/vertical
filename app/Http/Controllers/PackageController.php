<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Package;

class PackageController extends Controller
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
        $packages = Package::all();
        return view('package.index', [
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        # var_dump($request->input()['name']);
        $package = new Package;

        $package->name = $request->input('name');
        $package->cost = $request->input('cost');
        $package->lessons = $request->input('lessons');
        $package->is_pole = $request->input('is_pole');

        $package->save();

        return redirect('/package');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $package = Package::find($id);
        # var_dump($package);
        return view('package.show', [
            'package' => $package,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $package = Package::find($id);
        return view('package.edit', [
            'package' => $package,
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
        $package = Package::find($id);

        $package->name = $request->input('name');
        $package->cost = $request->input('cost');
        $package->lessons = $request->input('lessons');
        if (null !== $request->input('is_pole'))$package->is_pole = true;
        else $package->is_pole = false;

        $package->save();

        return redirect('/package');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
        return redirect('/package');
    }
}
