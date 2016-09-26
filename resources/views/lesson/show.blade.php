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
                <div class="panel-heading">{{ $lesson->name }} </div>
            </div>
            <div class="panel panel-body">
                @if ($user->privilege === 'admin' || $user->privilege === 'Maestra')
                    <div class="col-md-12">
                        <h4>Renovar clase</h4>

                        <form action=" {{ url('/lesson/'.$lesson->id.'/renew') }} " method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tiempo</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="time">
                                        <option value="1">+1 Mes</option>
                                        <option value="2">+2 Mes</option>
                                        <option value="3">+3 Mes</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-8">
                                    <button class="btn btn-primary"> Renovar </button>    
                                </div>
                            </div>
                            
                        </form>

                    </div>
                    <hr>
                @endif

                <h4>Maestra: {{ $lesson->teacher->first_name.' '.$lesson->teacher->last_name }}</h4> <br>
                
                {{-- to do: filtrado de días¿ --}}

                @if (($lesson->use_poles && $user->pole_lessons > 0) || (!$lesson->use_poles && $user->available_lessons > 0))
                    <p>Selecciona las clases a las cuales quieras inscribirte</p><br>
                    <h4>Classes disponibles:</h4><br>
                    <form class="form-horizontal" action=" {{ url('lesson/'.$lesson->id.'/enroll') }} " method="POST">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label class="col-md-2 control-label">Días</label>
                            <div class="col-md-8">
                                <select name="day" class="form-control">
                                    @foreach ($lesson->days as $day)
                                        <option value="{{ $day->pivot->id }}">
                                            {{ date('l d, F', strtotime($day->pivot->date)).' ('.$lesson->begins.'hrs - '.$lesson->ends.'hrs) '.$day->pivot->enrolled.'/'.$lesson->max_students }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                @if ($lesson->use_poles)
                                    @for ($j = 1; $j <= 7; $j++)
                                        <label> <input type="radio" name="pole_id" value="{{ $j }}"> Pole {{ $j }} </label> <br><br>
                                    @endfor
                                    <br><br>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-8">
                                <button class="btn btn-primary">Inscríbete</button>
                            </div>
                        </div>
                    </form>
                @else
                    <p>Necesitas más créditos para inscribirte. <a href=" {{ url('/package') }} ">Compra más.</a></p>
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