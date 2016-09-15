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
                <div class="panel-heading">{{ $lesson->name.' - '.$lesson->desc }} </div>
            </div>
            <div class="panel panel-body">
                <h4>Maestra: {{ $lesson->teacher->first_name.' '.$lesson->teacher->last_name }}</h4> <br>
                
                @if (($lesson->use_poles && $user->pole_lessons > 0) || (!$lesson->use_poles && $user->available_lessons > 0))
                    <p>Selecciona las clases a las cuales quieras inscribirte</p><br>
                    <h4>Classes disponibles:</h4><br>
                    <form class="form-horizontal" action=" {{ url('lesson/'.$lesson->id.'/enroll') }} " method="POST">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label class="col-md-2 control-label">Días</label>
                            <div class="col-md-8">
                                @foreach ($lesson->days as $i => $day)
                                    {{-- If not currently enrolled and lesson has space --}}
                                    @if (!$user->lessons->contains($day->pivot->id) && $day->pivot->enrolled < $lesson->max_students) 
                                        <label> <input type="checkbox" name="days[{{ $i }}][day]" value="{{ $day->pivot->id }}"> {{ date('d-m-Y', strtotime($day->pivot->date)).' ('.$lesson->begins.' - '.$lesson->ends.') '.$day->pivot->enrolled.'/'.$lesson->max_students }} </label> <br>
                                        {{-- display a way to choose the pole --}}
                                        @if ($lesson->use_poles)
                                            @for ($j = 1; $j <= 7; $j++)
                                                {{-- if pole is not busy --}}
                                                    <label> <input type="radio" name="days[{{ $i }}][pole]" value="{{ $j }}"> Pole {{ $j }} </label>
                                                {{-- else --}}
                                                {{-- endif --}}
                                            @endfor
                                            <br><br>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-8">
                                <button class="btn btn-primary">Inscríbete</button>
                            </div>
                        </div>
                    </form>
                @else
                    <p>Necesitas más créditos para inscribirte. <a href="#">Compra más.</a></p>
                @endif
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default logo-vertical">
                <img src="/assets/Verticalc.svg" alt="Vertical Pole & Fitness">
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