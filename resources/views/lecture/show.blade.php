@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('fail'))
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                {{ session('fail') }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $lecture->name }} </div>
            </div>
            <div class="panel panel-body" ng-controller="lessonCtrl">
                
                <p><b>Maestra:</b> {{ $lecture->teacher->name }}</p>
                <p><b>Alumnas por clase:</b> {{ $lecture->max_students }}</p>
            </div>
            <div class="panel panel-body" ng-controller="lessonCtrl">
                <div>
                <h2 class="col-8">Horario</h2>
                
                <span class="col-4">
                @if (Auth::user()->role_id == 1 || Auth::user()->id == $lecture->teacher_id)
                    <a class="btn btn-primary" href="{{ url("/lecture/$lecture->id/agenda") }}">Crear/Editar Horario</a>
                @endif
                </span>
                </div>

                <hr><br>

                @if (count($lecture->schedule) > 0)
                    {{-- 
                    @foreach ($lecture->schedule as $lesson)
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="col-md-6">{{ $lesson->day }} de {{ $lesson->begins }}hrs a {{ $lesson->ends }}hrs</p>
                                @if (Auth::user()->role_id == 4)
                                    <div class="col-md-6" style="text-align: right;">
                                    <a class="btn-lesson" href="{{ url("/lecture/$lecture->id/agenda/$lesson->id/enroll") }}" class="btn btn-primary">Incríbete</a>
                                    </div>
                                @elseif (in_array(Auth::user()->role_id, [1, 2]))
                                    <div class="col-md-6" style="text-align: right;">
                                    <a class="btn btn-xs btn-primary btn-lesson" href="{{ url("/lecture/$lecture->id/agenda/$lesson->id/enrolled") }}">Ver inscritas</a>
                                    <form action="{{ url("/lecture/$lecture->id/agenda/$lesson->id") }}" method="POST" style="display: inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-xs btn-danger">&times;</button>
                                    </form>
                                    </div>
                                @endif  
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    --}}
                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}
                @else
                    <br>
                    <p>No hay un horario definido para esta clase</p>
                @endif
            </div>
        </div>
    </div>
    
</div>

@endsection