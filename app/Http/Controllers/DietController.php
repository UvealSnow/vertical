<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\User;
use App\Diet;
use App\Meal;
use DB;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        if ($user->role_id == 3) {
            $diets = Diet::where('nutriologist_id', $user->id)->get();
            return view ('diet.index', [
                'diets' => $diets,
            ]);
        }
        else return redirect ("/home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = Auth::user();
        if ($user->role_id == 3)  {
            $students = User::where('role_id', 4)->get();
            return view ('diet.create', [
                'students' => $students,
            ]);
        }
        else return redirect ("/home");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'student_id' => 'required|numeric|exists:users,id',
            'meals.breakfast' => 'required|string',
            'meals.mid_day' => 'required|string',
            'meals.lunch' => 'required|string',
            'meals.snack' => 'required|string',
            'meals.dinner' => 'required|string',
            'diet_file' => 'file'
        ]);

        $diet = new Diet;

        if ($request->file('diet_file')) {
            $fileName = $this->generateKey().'.'.$request->file('diet_file')->getClientOriginalExtension();
            $diet->file = $fileName;
            $request->file('diet_file')->move(base_path().'/public/assets/files/diets', $fileName);
        }

        $diet->name = $request->name;
        $diet->nutriologist_id = Auth::user()->id;
        $diet->user_id = $request->student_id;

        $diet->save();

        $i = 0;
        foreach ($request->meals as $food) { 
            $meal = new Meal;

            $meal->diet_id = $diet->id;
            if ($i == 0) $meal->time = 'Desayuno';
            elseif ($i == 1) $meal->time = 'Medio Día';
            elseif ($i == 2) $meal->time = 'Comida';
            elseif ($i == 3) $meal->time = 'Merienda';
            elseif ($i == 4) $meal->time = 'Cena';

            $meal->body = $food;

            $meal->save();

            $i++;
        }

        return redirect ("/diet/$diet->id")->with('success', 'La dieta fue creada y asignada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id) {
        
        $diet = Diet::find($id);
        return view ('diet.show', [
            'diet' => $diet,
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
    public function destroy ($id) {
        
        $diet = Diet::find($id);

        foreach ($diet->meals as $meal) {
            $meal->delete();
        }

        $diet->delete();

        return redirect ("/diet")->with('delete_success', "La dieta due eliminada correctamente");

    }

    public function reAssignForm ($id) {

        if (Auth::user()->role_id == 3) {
            $students = User::where('role_id', 4)->get();
            $diet = Diet::find($id);
            return view ('diet.reasign', [
                'diet' => $diet,
                'students' => $students,
            ]);
        }
    }

    public function reAssignPost (Request $request, $id) {

        $this->validate($request, [
            'student_id' => 'required|numeric|exists:users,id',
        ]);

        $diet = Diet::find($id);
        $clone = new Diet;

        $already = DB::table('diets')->where('user_id', $request->student_id)->where('id', $id)->get();

        if (count($already) > 0) {
            return redirect ("/diet/re-assign/$diet->id")->with('fail', 'Este usuario ya tiene esta dieta asignada');
        }

        $clone->user_id = $request->student_id;
        $clone->nutriologist_id = $diet->nutriologist_id;
        $clone->name = $diet->name;
        $clone->file = $diet->file;

        $clone->save();

        foreach ($diet->meals as $food) {
            $meal = new Meal;

            $meal->diet_id = $clone->id;
            $meal->time = $food->time;
            $meal->body = $food->body;

            $meal->save();
        }

        return redirect ("/diet/$clone->id")->with('success', 'La dieta fue asignada correctamente');


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
