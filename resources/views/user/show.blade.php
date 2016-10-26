@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (Auth::user()->id != $user->id)
                <h2>Perfil del Usuario</h2>
            @else
                <h2>Mi Perfil</h2>
            @endif
                <div class="pp-image">
                    @if ($user->role->title == 'Admin')
                        <img src="/assets/admin.svg" alt="Administrador">
                    @endif
                    @if ($user->role->title == 'Maestra')
                        <img src="/assets/teacher.svg" alt="Instructora">
                    @endif
                    @if ($user->role->title == 'Nutriologa')
                        <img src="/assets/nutri.svg" alt="Nutrióloga">
                    @endif
                    @if ( $user->role->title  == 'Alumna')
                        <img src="/assets/student.svg" alt="Alumna">
                    @endif
                </div>
                <h3 class="pp-name"> {{ $user->name }} </h3>
                <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (Auth::user()->role_id == 1)
                        <div style="margin: 0 auto; text-align: center;">
                        <a href="{{ url('/user/'.$user->id.'/package') }}" class="new-btn">Agregar paquetes</a>
                        <a href="{{ url('/user/'.$user->id.'/medal') }}" class="new-btn">Otorgar medallas</a>
                        <a href="{{ url('/user/'.$user->id.'/edit') }}" class="new-btn">Editar usuario</a><br><br>
                        </div>
                    @endif
                    <p><b>Email:</b> {{ $user->email }} </p>
                    @if ($user->phone) 
                        <p><b>Teléfono:</b> {{ $user->phone }} </p> 
                    @endif
                    @if ($user->role->title == 'Alumna')
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
                    @endif
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

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Mis clases</div>
                <div class="panel-body">
                    @if ($user->role_id == 2)
                       
                        @if (count($user->lectures) > 0)
                            <h1>Das clases de:</h1><br>
                            @foreach ($user->lectures as $lecture)
                                Clase de: <a href="{{ url("lecture/$lecture->id") }}">{{ $lecture->name }}</a> <br><br>
                            @endforeach
                        @else 
                            <p>No doy clases, <a href="{{ url("/lecture/create") }}">Crea una.</a></p>
                        @endif

                    @else
                        
                        @if (session('success'))
                            <div class="row">
                                <div class="col-md-9">
                                    {{ session('success') }} <br><br>
                                </div>
                            </div>
                        @endif

                        @if (count($user->lessons) > 0)
                            @foreach ($user->lessons as $lesson)
                                @if (intval(date('z')) < intval(date('z', strtotime($lesson->date))))
                                    <p>
                                        {{ date('d M', strtotime($lesson->date)) }} - 
                                        {{ $lesson->schedule->lecture->name }}, 
                                        con: {{ $lesson->schedule->lecture->teacher->name }}.
                                        de {{ $lesson->schedule->begins }}hrs a 
                                        {{ $lesson->schedule->ends }}hrs
                                        @if ($lesson->schedule->lecture->is_pole)
                                            (pole: {{ $lesson->pole_id }})
                                        @endif
                                    </p>
                                    <br>
                                @endif
                            @endforeach
                        @else
                            <p>No tienes clases próximas. <a href="{{ url("/lecture") }}">Registra algunas</a></p>
                        @endif

                    @endif
                </div>
            </div>
        </div>

        </div>
    </div>
    
</div>
@endsection
