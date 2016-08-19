@extends('layouts.app')

@section('content')
<style type="text/css">
    .panel-heading{
        background-color: #511B73 !important;
        color: white !important;
        font-size: 18px !important;
    }
    .btn-primary{
        background-color: #FBC02D !important;
        border:none !important;
        transition: all 0.2s ease;
    }
    .btn-primary:hover{
        background-color: #FFE000 !important;
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
    .lesson-box{
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 3px;
        margin-bottom: 10px;
        padding: 10px;
    }
    .lesson-title{
        color: #511B73;
        font-size: 18px;
        text-transform: uppercase;
        font-weight: bold;
    }
    .alert{
        color: #F44336;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inscribete a una clase</div>
                <div class="panel-body">
                    @if (session('error'))
                        <span class="alert">{{ session('error') }}</span>
                        <br><br>
                    @endif

                    @foreach ($lessons as $i => $lesson)
                        <div class="lesson-box">
                        <p class="lesson-title">{{ $lesson->name}}</p>
                        <p><b>Horario</b>
                            @foreach ($lesson->days as $i => $day)
                                @if($i==0)
                                {{ $day->pivot->lesson_begins.':00 a '.$day->pivot->lesson_ends.':00' }}
                                @endif
                            @endforeach
                        </p>
                        @if (in_array($lesson->id, $user_lessons))    
                            <p>
                                Ya estás inscrita en esta clase
                            </p>                            
                        @elseif ($lesson->max_students > $lesson->enrolled_students) 
                            @if ($lesson->use_poles)
                                <p>
                                     {{ $lesson->available }} lugares disponibles.<br>
                                    <a href="{{ url('/lesson/pole?id='.$lesson->id) }}" class="btn btn-xsm btn-primary">Inscríbete</a>
                                </p>
                            @else
                                <p>
                                    {{ $lesson->available }} lugares disponibles
                                    <form action="{{ url('/lesson/signup') }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                        <button class="btn btn-xsm btn-primary">Inscríbete</button>
                                    </form>
                                </p>
                            @endif
                        @else 
                            <p>Cupo Lleno</p>
                        @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection