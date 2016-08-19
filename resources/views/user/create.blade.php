@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo usuario</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Nombre(s)</label>
                            <div class="col-md-6">
                                <input id="text" type="first_name" class="form-control" name="first_name" placeholder="Nombres" value="{{ old('first_name') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Apellido(s)</label>
                            <div class="col-md-6">
                                <input id="text" type="last_name" class="form-control" name="last_name" placeholder="Apellidos" value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="text" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Teléfono celular</label>
                            <div class="col-md-6">
                                <input id="text" type="tel" class="form-control" name="phone" placeholder="Teléfono celular" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>
                            <div class="col-md-6">
                                <input id="text" type="password" class="form-control" name="password" placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Confirmar contraseña</label>
                            <div class="col-md-6">
                                <input id="text" type="password" class="form-control" name="confirm_password" placeholder="Confirmar contraseña">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Tipo de usuario</label>
                            <div class="col-md-6">
                                <select name="privilege" class="form-control">
                                    <option value="Alumna">Alumna</option>
                                    <option value="Maestra">Maestra</option>
                                    <option value="Nutriologa">Nutrióloga</option>
                                    <option value="admin">Admin</option>
                                </select>
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