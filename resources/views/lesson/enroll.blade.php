@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inscribete a una clase</div>
                <div class="panel-body">
                    @if (session('error'))
                        {{ session('error') }}
                    @endif
                    @foreach ($lessons as $i => $lesson)
                        @if (in_array($lesson->id, $user_lessons))    
                            <p>
                                {{ $lesson->name.': '.$lesson->desc }}, ya estás inscrita en esta clase
                            </p>                            
                        @elseif ($lesson->max_students > $lesson->enrolled_students) 
                            @if ($lesson->use_poles)
                                <p>
                                    {{ $lesson->name.': '.$lesson->desc }}, tiene {{ $lesson->available }} lugares disponibles<br>
                                    <a href="{{ url('/lesson/pole?id='.$lesson->id) }}" class="btn btn-xsm btn-primary">Selecciona tu lugar</a>
                                </p>
                            @else
                                <p>
                                    {{ $lesson->name.': '.$lesson->desc }}, tiene {{ $lesson->available }} lugares disponibles
                                    <form action="{{ url('/lesson/signup') }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                        <button class="btn btn-xsm btn-primary">Inscríbete</button>
                                    </form>
                                </p>
                            @endif
                        @else 
                            <p>{{ $lesson->name.': '.$lesson->desc }}, está llena</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection