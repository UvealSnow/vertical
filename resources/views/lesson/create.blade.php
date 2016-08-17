@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nueva clase</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/lesson') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="col-md-4 control-label">Descripción</label>
                            <div class="col-md-6">
                                <input id="desc" type="text" class="form-control" name="desc" placeholder="Descripción" value="{{ old('desc') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="max_num" class="col-md-4 control-label">Max. alumnas</label>
                            <div class="col-md-6">
                                <input id="max_num" type="number" class="form-control" name="max_num" min="1" placeholder="Máximo número de estudiantes" value="{{ old('max_num') }}">
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
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox6" name="days[]" value="6"> Sábado
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox7" name="days[]" value="7"> Domingo
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start" class="col-md-4 control-label">Hora inicio</label>
                            <div class="col-md-6">
                                <input id="start" type="time" class="form-control" name="start" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="finish" class="col-md-4 control-label">Hora final</label>
                            <div class="col-md-6">
                                <input id="finish" type="time" class="form-control" name="finish" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox col-md-offset-8">
                                <label>
                                    <input type="checkbox" value="true" name="use_pole">
                                    Usar poles
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Agregar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
