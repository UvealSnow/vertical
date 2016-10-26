@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>¡Hola {{ Auth::user()->name }}!</h2>
            <hr class="block-spacer">
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <div class="combo-box">
                        @if (in_array(Auth::user()->role_id, [1, 2, 3]))
                        <div class="panel-btn col-md-6">
                            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                            <a href="{{ url('/user') }}">Ver Usuarios</a>
                        </div>
                        @endif
                        @if (Auth::user()->role_id == 1)
                        <div class="addnew-btn col-md-5 ">
                            <a href="{{ url('/user/create') }}">Nuevo Usuario</a>
                        </div>
                        @endif
                    </div>
                    
                    @if (Auth::user()->role_id == 1)
                        <div class="combo-box">
                            <div class="panel-btn col-md-6">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;
                                <a href="{{ url('/package') }}">Ver Paquetes</a>
                            </div>
                            <div class="addnew-btn col-md-5">
                                <a href="{{ url('/package/create') }}">Nuevo Paquete</a>
                            </div>
                        </div>
                    @endif

                    <div class="combo-box">
                        <div class="panel-btn col-md-6">
                            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;
                            <a href="{{ url('/lecture') }}">Ver Clases</a>
                        </div>
                        @if (in_array(Auth::user()->role_id, [1, 2]))
                        <div class="addnew-btn col-md-5">
                            <a href="{{ url('/lecture/create') }}">Nueva Clase</a>
                        </div>
                        @endif
                    </div>

                    @if (Auth::user()->role_id == 3)
                        <div class="combo-box">
                            <div class="panel-btn">
                                <i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp;  
                                <a href="{{ url('/diet') }}">Ver Dietas</a>
                            </div>
                            <div class="addnew-btn">
                                <a href="{{ url('/diet/create') }}">Nueva Dieta</a>
                            </div>
                        </div>
                    @endif

                    <div class="combo-box">
                        <div class="panel-btn col-md-6">
                            <i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;
                            <a href="{{ url('/user/profile') }}">Ver Medallas</a>
                        </div>
                        @if (Auth::user()->role_id == 1)
                        <div class="addnew-btn col-md-5">
                            <a href="{{ url('/medal/create') }}">Nueva Medalla</a>
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
