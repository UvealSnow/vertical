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

    .lesson-box{
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 14px;
    }
        
    .lesson-dtl{
        display: flex;
        flex-direction: column;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default section-header">
                <div class="panel-heading">Clases
                <hr class="block-spacer"> 
                @if ($user->privilege === 'Maestra' || $user->privilege === 'admin')  
                    <a href="{{ url('/lesson/create') }}" class="new-btn"> Nueva Clase</a>
                @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Clases
                </div>
                <div class="panel-body">
                	@if (count($lessons) > 0)
                        @if (Auth::user()->privilege === 'Alumna')
                        <a href="{{ url('/lesson/signup') }}" class="new-btn">Incríbete a una clase</a>
                        @endif
                        <br>
                        @foreach ($lessons as $lesson)
                            <span class="lesson-box">

                            <span class="lesson-dtl">
                            <span>
                            <a href="{{ url('/lesson/'.$lesson->id) }}">{{ $lesson->name }}</a> con: 
                            <a href="{{ url('/lesson/'.$lesson->id) }}">{{ $lesson->teacher }}</a>
                            </span>
                            <span>
                            @foreach ($lesson->days as $day)
                                <span>{{ $day->name }} -</span>
                            @endforeach
                            </span>
                            </span>
                            @if ($user->privilege === 'Maestra' || $user->privilege === 'admin')
                            <span class="btn-cont">
                                <a class="btn btn-s btn-primary" href="{{ url('/lesson/'.$lesson->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                <form action="{{ url('/lesson/'.$lesson->id) }}" method="POST" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                </form>
                            </span>
                            @endif
                            </span>
                        @endforeach
                    @else
                        <p>No tienes clases programadas</p>
                    @endif
                </div>
            </div>
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