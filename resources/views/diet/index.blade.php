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
                <div class="panel-heading">Dietas creadas por {{ Auth::user()->name }}
                <hr class="block-spacer"> 
                @if (in_array(Auth::user()->role_id, [3]))  
                    <a href="{{ url('/diet/create') }}" class="new-btn"> Nueva Dieta</a>
                @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Dietas</div>
                <div class="panel-body">

                    @if (session('delete_success'))
                        <div class="row">
                            {{ session('delete_success') }}
                        </div>
                    @endif  
                        
                    @if (count($diets) > 0)
                        @foreach ($diets as $diet)
                            <div class="row">
                                <div class="col-md-3">
                                    <p><strong>Dieta</strong></p>
                                    <p><a href="{{ url("/diet/$diet->id") }}">{{ $diet->name }}</a></p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Nutrióloga</strong></p>
                                    <p>{{ $diet->nutriologist->name }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Alumnas</strong></p>
                                    <p>{{ $diet->student->name }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Opciones</strong></p>
                                    <a class="btn btn-xs btn-warning" href="{{ url("/diet/$diet->id/edit") }}">Editar</a>
                                    <form style="display: inline-block;" action="{{ url("/diet") }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-xs btn danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No has creado ninguna dieta.</p>
                    @endif

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