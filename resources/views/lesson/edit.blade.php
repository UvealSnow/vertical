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
                <div class="panel-heading">Editar clase - {{ $lesson->name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/lesson') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre" value="{{ $lesson->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="max_num" class="col-md-4 control-label">Max. alumnas</label>
                            <div class="col-md-6">
                                <input id="max_num" type="number" class="form-control" name="max_num" min="1" placeholder="Máximo número de estudiantes" value="{{ $lesson->max_students }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Días</label>
                            <div class="col-md-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="days[]" value="1"> Lunes
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" name="days[]" value="2"> Martes
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" name="days[]" value="3"> Miércoles
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox4" name="days[]" value="4"> Jueves
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox5" name="days[]" value="5"> Viernes
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start" class="col-md-4 control-label">Hora inicio</label>
                            <div class="col-md-6">
                                <input id="start" type="time" class="form-control" name="start" value="10:00:PM">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="finish" class="col-md-4 control-label">Hora final</label>
                            <div class="col-md-6">
                                <input id="finish" type="time" class="form-control" name="finish">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start" class="col-md-4 control-label">Usar Poles</label>
                            <div class="col-md-6">
                                @if ($lesson->use_poles)
                                    <input type="checkbox" value="true" name="use_pole" checked>
                                @else
                                    <input type="checkbox" value="true" name="use_pole">
                                @endif
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
