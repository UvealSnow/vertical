@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Paquete</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $i => $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/package') }}">
                        
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cost" class="col-md-4 control-label">Costo</label>
                            <div class="col-md-6">
                                <input id="cost" type="number" class="form-control" name="cost" placeholder="Costo" min="1" value="{{ old('cost') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lessons" class="col-md-4 control-label">Clases regulares incluidas</label>
                            <div class="col-md-6">
                                <input id="lessons" type="number" class="form-control" min="0" value="0" placeholder="Clases incluidas" name="regular_lessons">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lessons" class="col-md-4 control-label">Clases de Pole incluidas</label>
                            <div class="col-md-6">
                                <input id="lessons" type="number" class="form-control" min="0" value="0" placeholder="Clases incluidas" name="pole_lessons">
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
