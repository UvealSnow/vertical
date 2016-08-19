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
                <div class="panel-heading">Clase: {{ $lesson->name.' - '.$lesson->desc }} </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p><b>Maestro: </b>{{ $lesson->teacher }} </p>
                    <p><b>Horario:</b>
                        @foreach ($lesson->days as $i => $day)
                            @if($i==0)
                            {{ $day->pivot->lesson_begins.':00 a '.$day->pivot->lesson_ends.':00' }}
                            @endif
                        @endforeach
                    </p>
                    <p><b>Días:</b> <br>
                        @foreach ($lesson->days as $day)
                            {{ $day->name.' de '.$day->pivot->lesson_begins.':00 a '.$day->pivot->lesson_ends.':00' }}<br>
                        @endforeach
                    </p>
                    {{-- to do: pole position --}}
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