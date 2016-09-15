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

    .pp-image{
        margin: 1em auto;
        text-align: center;
    }

    .pp-name{
        text-align: center;
        font-family: OstrichB;
        font-size: 20px;
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading"> Mi Perfil</div>

                <div class="pp-image">
                    @if (Auth::user()->privilege === 'admin')
                        <img src="/assets/admin.svg" alt="Administrador">
                    @endif
                    @if (Auth::user()->privilege === 'Maestra')
                        <img src="/assets/ruler.svg" alt="Instructora">
                    @endif
                    @if (Auth::user()->privilege === 'Nutriologa')
                        <img src="/assets/orange.svg" alt="Nutrióloga">
                    @endif
                    @if (Auth::user()->privilege === 'Alumna')
                        <img src="/assets/student.svg" alt="Alumna">
                    @endif
                </div>

                <h3 class="pp-name"> {{ $user->first_name.' '.$user->last_name }} </h3>
                <hr>
                <div class="panel-body">
                    @if (Auth::user()->privilege === 'admin')
                        <a href="{{ url('/user/'.$user->id.'/package') }}" class="new-btn">Agregar paquetes</a><br><br>
                    @endif
                    <p><b>Email:</b> {{ $user->email }} </p>
                    <p><b>Teléfono:</b> {{ $user->phone }} </p>
                    <p><b>Clases disponibles:</b> {{ $user->available_lessons }} </p>
                    @if (Auth::user()->privilege === 'admin')
                    <p><b>Privilegios:</b> {{ $user->privilege }} </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading"> Mis Clases</div>
                <div class="panel-body">
                    @if (count($user->lessons) > 0)
                        @foreach ($user->lessons as $i => $lesson)
                            <p class="section__title">{{ $lesson[0]->name.': '.$lesson[0]->desc }}</p><br>
                            <p>Profesor: {{ $lesson[0]->teacher->first_name }}</p> <br>
                            <p>Horario: </p><br>
                            @foreach ($lesson[0]->schedule as $schedule)
                                <p>{{ $schedule->name.' '.$schedule->date.' de '.$lesson[0]->begins.' a '.$lesson[0]->ends }}</p>
                                @if ($lesson[0]->use_poles)
                                    <p>Pole: {{ $schedule->pole_id }}</p><br><br>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        <p>No hay clases inscritas</p><hr>
                    @endif
                    </div>
                    </div>
                </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading"> Mis Medallas</div>
                    <div class="panel-body">
                    @if (count($user->medals) > 0)
                        @foreach ($user->medals as $medal)
                            <div class="medal">
                                <p class="section__title">{{ $medal->name }}</p>
                                <p>{{ $medal->desc }}</p>
                            </div>
                        @endforeach
                    @else 
                        <p>Este usuario no ha obtenido medallas aún</p>
                    @endif
                    </div>
                </div>
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
