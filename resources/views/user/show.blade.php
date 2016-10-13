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
{{ Auth::user()->role_id }}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (Auth::user()->id != $user->id)
                    <div class="panel-heading">Perfil de usuario</div>
                @else
                    <div class="panel-heading">Mi Perfil</div>
                @endif
                <div class="pp-image">
                    @if (Auth::user()->role_id == 1)
                        <img src="/assets/admin.svg" alt="Administrador">
                    @endif
                    @if (Auth::user()->role_id == 2)
                        <img src="/assets/ruler.svg" alt="Instructora">
                    @endif
                    @if (Auth::user()->role_id == 3)
                        <img src="/assets/orange.svg" alt="Nutrióloga">
                    @endif
                    @if (Auth::user()->role_id == 4)
                        <img src="/assets/student.svg" alt="Alumna">
                    @endif
                </div>
                <h3 class="pp-name"> {{ $user->name }} </h3>
                <hr>
                <div class="panel-body">
                    @if (Auth::user()->role_id == 1)
                        <a href="{{ url('/user/'.$user->id.'/package') }}" class="new-btn">Agregar paquetes</a>
                        <a href="{{ url('/user/'.$user->id.'/medal') }}" class="new-btn">Otorgar medallas</a>
                        <a href="{{ url('/user/'.$user->id.'/edit') }}" class="new-btn">Editar usuario</a><br><br>
                    @endif
                    <p><b>Email:</b> {{ $user->email }} </p>
                    <p><b>Teléfono:</b> {{ $user->phone }} </p>
                    <p>
                        <b>Clases regulares disponibles:</b> {{ $user->regular_lessons }}. 
                        @if ($user->regular_lessons != 0)
                            Vencen el: {{ date('d M', strtotime($user->regular_expire)) }}
                        @endif
                    </p>
                    <p>
                        <b>Clases de pole disponibles:</b> {{ $user->pole_lessons }}. 
                        @if ($user->pole_lessons != 0) 
                            Vencen el: {{ date('d M', strtotime($user->pole_expire)) }}
                        @endif
                    </p>
                    @if (Auth::user()->role_id == 1)
                        <p>{{ $user->role->title }} </p>
                    @endif
                </div>
            </div>
        </div>
       
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Mis Medallas</div>
                <div class="panel-body">
                    @if (count($user->medals) > 0)

                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>

                        @foreach ($user->medals as $medal)
                            <div class="medal">
                                <img src="/assets/images/medals/{{ $medal->img }}" style="width: 50px; height: 50px; display: block; margin: 5px auto;">
                                <p class="section__title">{{ $medal->name }}</p>
                                <p>{{ $medal->desc }}</p>
                                <div style="display: block !important; text-align: center; margin-top: 15px;" class="fb-share-button" 
                                    data-href="http://www.verticalfit.mx/medal/{{ $medal->id }}" 
                                    data-layout="button">
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <p>Este usuario no ha obtenido medallas aún</p>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Mis clases</div>
                <div class="panel-body">
                    @if (count($user->lessons) > 0)
                        @if (Auth::user()->role_id == 2)
                            @foreach ($user->lessons as $lecture) 
                                <p>Clase de: <a href="{{ url("/lecture/$lecture->id") }}">{{ $lecture->name }}</a></p>
                            @endforeach
                        @else
                            @foreach ($user->lessons as $lesson)
                            @if (date('z') < date('z', strtotime($lesson->schedule->date)))
                                <p>
                                    {{ date('d M', strtotime($lesson->date)) }} - 
                                    {{ $lesson->schedule->lecture->name }}: 
                                    {{ $lesson->schedule->begins }}hrs a 
                                    {{ $lesson->schedule->ends }}hrs
                                    @if ($lesson->schedule->lecture->is_pole)
                                        (pole: {{ $lesson->pole_id }})
                                    @endif
                                </p>
                                <br>
                            @endif
                        @endforeach
                        @endif
                    @else 
                        <p>No hay clases registradas.</p>
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
