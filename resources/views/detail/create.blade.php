@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detalles - {{ $user->name }}</div>
                <div class="panel-body">

                    @if (count($errors->all()) > 0)
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/'.$user->id.'/details') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Ha tenido alguna lesión ósea?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="bone_injury">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Ha tenido alguna lesión muscular?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="muscle_injury">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Sufre de alguna enfermedad cardiovascular?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="heart_problems">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Se asfixia con facilidad durante el ejercicio?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="breathing_problems">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Sufre algún tipo de alergia?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="alergy_problems">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Toma medicamentos recurrentemente?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="medicine_intake">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Ha estado inscrito en alguna actividad deportiva en los últimos 3 meses?
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="recent_activity">
                                    <option value="1">Si</option>
                                    <option value="0" selected="selected">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                ¿Como te enteraste de nosotros?
                            </label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="referer" value="{{ old('referer') }}" placeholder="Internet/Radio/Amistades">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Guardar
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
