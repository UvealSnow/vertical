@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nueva Clase</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $i => $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/lecture') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre de la clase" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Maestra</label>
                            <div class="col-md-6">
                                <select class="form-control" name="teacher_id">
                                    @foreach ($teachers as $teacher)
                                        @if ($teacher->id == Auth::user()->id)
                                            <option value="{{ $teacher->id }}" selected="selected">Yo</option>
                                        @else
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="max_num" class="col-md-4 control-label">Max. alumnas</label>
                            <div class="col-md-6">
                                <input id="max_num" type="number" class="form-control" name="max_num" min="1" placeholder="Máximo número de estudiantes" value="{{ old('max_num') }}" required>
                            </div>
                        </div>

                        {{--
                        <div class="form-group">
                            <label class="col-md-4 control-label">Días</label>
                            <div class="col-md-6">
                                <label><input type="checkbox" name="days[1]" value="1"> Lunes </label> <br>
                                <label><input type="checkbox" name="days[2]" value="2"> Martes </label> <br>
                                <label><input type="checkbox" name="days[3]" value="3"> Miércoles </label> <br>
                                <label><input type="checkbox" name="days[4]" value="4"> Jueves </label> <br>
                                <label><input type="checkbox" name="days[5]" value="5"> Viernes </label> <br>
                                <label><input type="checkbox" name="days[6]" value="6"> Sábado </label> <br>
                                <label><input type="checkbox" name="days[7]" value="7"> Domingo </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Horario</label>
                            <div class="col-md-6">
                                <p>Inicia</p> <br>
                                <input class="form-control" type="time" name="starts" required> <br>
                                <p>Termina</p> <br>
                                <input class="form-control" type="time" name="ends" required>
                            </div>
                        </div>
                        --}}

                        <div class="radio">
                            <label class="col-md-4 control-label">Tipo de clase</label>
                            <div class="col-md-6">
                                <label> <input type="radio" name="type" value="pole" checked> Usa poles </label> <br>
                                <label> <input type="radio" name="type" value="other"> Otro tipo </label>
                            </div>
                        </div>
                        <br><br>

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
