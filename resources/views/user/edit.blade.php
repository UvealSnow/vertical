@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo usuario</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/'.$user->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Nombre(s)</label>
                            <div class="col-md-6">
                                <input id="text" type="first_name" class="form-control" name="first_name" placeholder="Nombres" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="text" type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Teléfono</label>
                            <div class="col-md-6">
                                <input id="text" type="tel" class="form-control" name="phone" placeholder="Teléfono celular" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Clases regulares</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="regular_lessons" min="0" value="{{ $user->regular_lessons }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Clases de Pole</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="pole_lessons" min="0" value="{{ $user->pole_lessons }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Tipo de usuario</label>
                            <div class="col-md-6">
                                <select name="privilege" class="form-control">
                                    <option value="Alumna" @if ($user->privilege === 'Alumna') selected="selected" @endif>Alumna</option>
                                    <option value="Maestra" @if ($user->privilege === 'Maestra') selected="selected" @endif>Maestra</option>
                                    <option value="Nutriologa" @if ($user->privilege === 'Nutrióloga') selected="selected" @endif>Nutrióloga</option>
                                    <option value="admin" @if ($user->privilege === 'admin') selected="selected" @endif>Admin</option>
                                </select>
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
