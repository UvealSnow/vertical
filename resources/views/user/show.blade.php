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
    .new-btn{
        background-color: #FFE000;
        font-size: 16px;
        font-family: Lato;
        padding: 7px;
        color: #212121;
        border-radius: 3px;
        margin-right: 0;
    }

    .new-btn:hover{
        text-decoration: none;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default ">
                <div class="panel-heading"> Perfil </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"> {{ $user->first_name.' '.$user->last_name }} </div>
                <div class="panel-body">
                    @if (Auth::user()->privilege === 'admin')
                        <a href="{{ url('/user/'.$user->id.'/package') }}" class="new-btn">Agregar paquetes</a><br><br>
                    @endif
                    <p>Email: {{ $user->email }} </p>
                    <p>Teléfono: {{ $user->phone }} </p>
                    <p>Clases disponibles: {{ $user->available_lessons }} </p>
                    @if (Auth::user()->privilege === 'admin')
                    <p>Privilegios: {{ $user->privilege }} </p>
                    @endif
                    <h3>Clases</h3>
                    <hr>
                    @if (count($user->lessons) > 0)
                        @foreach ($user->lessons as $i => $lesson)
                            <p>Clase {{ $i.': '.$lesson->desc }}</p>
                            <p>Profesor: {{ $lesson->teacher }}</p> 
                            <p>Horario: </p>
                            @foreach ($lesson->days as $day)
                                <p> {{ $day->name.': '.$day->pivot->lesson_begins.':00 - '.$day->pivot->lesson_ends.':00' }} </p>
                            @endforeach
                            <hr>
                        @endforeach
                    @else
                        <p>No hay clases inscritas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default logo-vertical">
                <img src="assets/Verticalc.svg" alt="Vertical Pole & Fitness">
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
