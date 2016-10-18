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
                <div class="panel-heading">Editar clase {{ $lecture->name }}</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $i => $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="post" action="{{ url("/lecture/$lecture->id") }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="put">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre de la clase" value="{{ $lecture->name }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Maestra</label>
                            <div class="col-md-6">
                                <select class="form-control" name="teacher_id">
                                    @foreach ($teachers as $teacher)
                                        @if ($teacher->id == $lecture->teacher_id)
                                            <option value="{{ $teacher->id }}" selected="selected">
                                                @if ($teacher->id == Auth::user()->id)
                                                    Yo
                                                @else
                                                    {{ $teacher->name }}
                                                @endif
                                            </option>
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
                                <input id="max_num" type="number" class="form-control" name="max_num" min="1" placeholder="Máximo número de estudiantes" value="{{ $lecture->max_students }}" required>
                            </div>
                        </div>

                        <div class="radio">
                            <label class="col-md-4 control-label">Tipo de clase</label>
                            <div class="col-md-6">
                                <label> <input type="radio" name="type" value="pole" @if ($lecture->is_pole) checked @endif> Usa poles </label> <br>
                                <label> <input type="radio" name="type" value="other" @if (!$lecture->is_pole) checked @endif> Otro tipo </label>
                            </div>
                        </div>
                        <br><br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Editar
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
