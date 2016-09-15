@extends('layouts.app')

@section('content')
<style type="text/css">
    .panel-heading{
        background-color: transparent !important;
        font-family: NexaBold;
        font-size: 24px;
        color: #511B73 !important;
    }

    .block-spacer{
        background-color: #FFE000;
        height: 3px;
        width: 100%;
        margin-top: 5px;
        margin-bottom: 5px;
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

    .btn-s{
        font-size: 20px !important;
        padding: 0px;
        background-color: white !important;
        border: none !important;
    }

    .icon-btn{
        font-size: 24px;
    }

    .icon-edit{
        color: #FFE000;
    }

    .icon-delete{
        color: #F44336;
    }

    .user{
        display: flex;
        width: 100%;
        justify-content: space-between;
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

    .section-header{
        border:none !important;
        box-shadow: none !important; 
        border-bottom: 0px !important;
    }

    .minor-header{
        background-color: #511B73 !important;
        color: white !important;
        font-size: 18px !important;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default section-header">
                <div class="panel-heading">Usuarios
                <hr class="block-spacer">   
                @if (Auth::user()->privilege === 'admin')
                <a href="{{ url('/user/create') }}" class="new-btn"> Nuevo Usuario</a>
                @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Alumnas
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->privilege === 'Alumna')
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->first_name.' '.$user->last_name }}</a>
                                @if (Auth::user()->privilege === 'admin' || Auth::user()->privilege === 'Maestra')
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            @if (Auth::user()->privilege === 'admin')
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Maestras
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->privilege === 'Maestra')
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->first_name.' '.$user->last_name }}</a>
                                @if (Auth::user()->privilege === 'admin' || Auth::user()->privilege === 'Maestra')
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Nutrióloga  
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->privilege === 'Nutriologa')
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->first_name.' '.$user->last_name }}</a>
                                @if (Auth::user()->privilege === 'admin' || Auth::user()->privilege === 'Maestra')
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Administradores
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->privilege === 'admin')
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->first_name.' '.$user->last_name }}</a>
                                @if (Auth::user()->privilege === 'super')
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif
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