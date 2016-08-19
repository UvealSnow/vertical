@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ $user->first_name.' '.$user->last_name }} </div>
                <div class="panel-body">
                    @if (Auth::user()->privilege === 'admin')
                        <a href="{{ url('/user/'.$user->id.'/package') }}">+ Agregar paquetes</a>
                    @endif
                    <p>Email: {{ $user->email }} </p>
                    <p>Teléfono: {{ $user->phone }} </p>
                    <p>Clases disponibles: {{ $user->available_lessons }} </p>
                    <p>Privilegios: {{ $user->privilege }} </p>
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
</div>
@endsection
