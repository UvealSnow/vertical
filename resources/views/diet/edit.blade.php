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
                <div class="panel-heading">Nueva Dieta</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $i => $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url("/diet/$diet->id") }}" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre de la dieta" value="{{ $diet->name }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Alumna</label>
                            <div class="col-md-6">
                                <select class="form-control" name="student_id">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-md-offset-4">
                                <h1>Comidas</h1> <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Desayuno</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="meals[breakfast]" placeholder="Describe el desayuno">@if (isset($diet->meals[0])) {{ $diet->meals[0]->body }} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Media mañana</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="meals[mid_day]" placeholder="Describe la comida de media mañana">@if (isset($diet->meals[1])) {{ $diet->meals[1]->body }} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Comida</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="meals[lunch]" placeholder="Describe la comida">@if (isset($diet->meals[2])) {{ $diet->meals[2]->body }} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Merienda</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="meals[snack]" placeholder="Describe la merienda">@if (isset($diet->meals[3])) {{ $diet->meals[3]->body }} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Cena</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="meals[dinner]" placeholder="Describe la cena">@if (isset($diet->meals[4])) {{ $diet->meals[4]->body }} @endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Archivo de la dieta (pdf)</label>
                            <div class="col-md-6">
                                @if ($diet->file)
                                    <p class="small"><a target="_blank" href="{{ Storage::url($diet->file) }}">descargar</a></p>
                                @endif
                                <input class="form-control" type="file" name="diet_file">
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
