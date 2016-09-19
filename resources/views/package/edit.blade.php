@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nueva medalla</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/package/'.$package->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="text" type="name" class="form-control" name="name" placeholder="Nombre" value="{{ $package->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cost" class="col-md-4 control-label">Costo</label>
                            <div class="col-md-6">
                                <input id="cost" type="number" class="form-control" name="cost" placeholder="Costo" min="0" value="{{ $package->cost }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lessons" class="col-md-4 control-label">Clases regulares</label>
                            <div class="col-md-6">
                                <input id="lessons" type="number" class="form-control" min="0" placeholder="Lecciones incluidas" name="regular_lessons" value="{{ $package->regular_lessons }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lessons" class="col-md-4 control-label">Clases pole</label>
                            <div class="col-md-6">
                                <input id="lessons" type="number" class="form-control" min="0" placeholder="Lecciones incluidas" name="pole_lessons" value="{{ $package->pole_lessons }}">
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
</div>
@endsection
