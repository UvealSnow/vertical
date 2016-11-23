@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Añadir Horario</div>
            </div>
            <div class="panel panel-body">
                
                <form action="{{ url("/lecture/$lecture_id/agenda") }}" method="POST" class="form-horizontal">
                    
                    {{ csrf_field() }}

                    <div ng-controller="scheduleCtrl">
                        <div ng-repeat="day in days">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 style="position: relative; left: 100px;">
                                        Clase <% $index + 1 %>
                                        <a style="position: relative; left: 30px; top: -5px;" class="btn btn-xs btn-primary" href ng-click="addDay()">Agregar clase</a>    
                                        <a style="position: relative; left: 30px; top: -5px;" class="btn btn-xs btn-danger" href ng-click="removeDay($index)">Eliminar clase</a>    
                                    </h4>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Día de la semana</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="day[<% $index %>][id]">
                                        @for ($i = 0; $i < 7; $i++)
                                            <option value="{{ $i + 1}}">{{ date('l', strtotime("next Monday +$i days")) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Inicia</label>
                                <div class="col-sm-6">
                                    <input type="time" name="day[<% $index %>][starts]" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Termina</label>
                                <div class="col-sm-6">
                                    <input type="time" name="day[<% $index %>][ends]" class="form-control" required>
                                </div>
                            </div>

                            <hr>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-7 col-sm-2">
                            <button type="submit" class="btn btn-primary">Crear Horario</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>

</div>
@endsection