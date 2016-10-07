@extends('layouts.app')

@section('content')
<style type="text/css">
    .panel-heading{
        background-color: #511B73 !important;
        color: white !important;
        font-size: 18px !important;
    }
    .btn-primary{
        background-color: #FFE000 !important;
        border:none !important;
        transition: all 0.2s ease;
    }
    .btn-primary:hover{
        background-color: #FBC02D !important;
    }
    .logo-vertical{
        display: flex;
        align-items: center;
        justify-content: center;
        border: none !important;
        box-shadow: none !important;
    }

    .dir-vertical{
        border: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: none !important;
    }

    .dir-vertical p{
        text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nueva Clase</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/lesson/'.$lesson->id) }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre de la clase" value="{{ $lesson->name }}" required>
                            </div>
                        </div>

                        @if (Auth::user()->privilege != 'Maestra')
                            <div class="form-group">
                                <label class="col-md-4 control-label">Maestra</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="teacher">
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->id == $lesson->teacher_id)
                                                <option value=" {{ $teacher->id }} " selected="selected">{{ $teacher->first_name.' '.$teacher->last_name }}</option>
                                            @else
                                                <option value=" {{ $teacher->id }} ">{{ $teacher->first_name.' '.$teacher->last_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif  

                        <div class="form-group">
                            <label for="max_num" class="col-md-4 control-label">Max. alumnas</label>
                            <div class="col-md-6">
                                <input id="max_num" type="number" class="form-control" name="max_num" min="1" placeholder="Máximo número de estudiantes" value="{{ $lesson->max_students }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Días</label>
                            <div class="col-md-6">

                                <label><input type="checkbox" name="days[1]" value="1" @if (in_array(1, $days)) checked @endif> Lunes </label> <br>
                                <label><input type="checkbox" name="days[2]" value="2" @if (in_array(2, $days)) checked @endif> Martes </label> <br>
                                <label><input type="checkbox" name="days[3]" value="3" @if (in_array(3, $days)) checked @endif> Miércoles </label> <br>
                                <label><input type="checkbox" name="days[4]" value="4" @if (in_array(4, $days)) checked @endif> Jueves </label> <br>
                                <label><input type="checkbox" name="days[5]" value="5" @if (in_array(5, $days)) checked @endif> Viernes </label> <br>
                                <label><input type="checkbox" name="days[6]" value="6" @if (in_array(6, $days)) checked @endif> Sábado </label> <br>
                                <label><input type="checkbox" name="days[7]" value="7" @if (in_array(7, $days)) checked @endif> Domingo </label>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Horario</label>
                            <div class="col-md-6">
                                <p>Inicia</p> <br>
                                <input class="form-control" type="time" name="starts" value="{{ $lesson->begins }}" required> <br>
                                <p>Termina</p> <br>
                                <input class="form-control" type="time" name="ends" value="{{ $lesson->ends }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tipo de clase</label>
                            <div class="col-md-6">
                                <label> <input type="radio" name="type" value="pole" @if ($lesson->use_poles) checked @endif> Pole </label> <br>
                                <label> <input type="radio" name="type" value="other" @if (!$lesson->use_poles) checked @endif> Otras </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Modificar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default logo-vertical">
                <img src="/assets/Verticalc.svg" alt="Vertical Pole & Fitness">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default dir-vertical">
                <p>
                    Av. Tercer Milenio #385<br>
                    San Luis Potosí, 78211
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
