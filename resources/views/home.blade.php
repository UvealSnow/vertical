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

    .panel-btn{
        width: 100%;
        background-color: #FFE000;
        margin: 10px 0;
        padding: 10px;
        border-radius: 3px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .panel-btn:hover{
        transform: translateY(-3px);
        box-shadow: 0px 3px 3px rgba(0,0,0,0.1);
    }

    .panel-btn a{
        color: white;
        text-transform: uppercase;
        font-family: NexaBlack;
        font-size: 20px;
    }

    .panel-btn a:hover{
        text-decoration: none;
    }

    .combo-box{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .addnew-btn{
        background-color: #511B73;
        padding: 16px;
        color: white;
        font-size: 20px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-family: NexaBold;
        transition: all 0.2s ease;
    }

    .addnew-btn:hover{
        transform: translateY(-3px);
        box-shadow: 0px 3px 3px rgba(0,0,0,0.1);
    }

    .addnew-btn a{
        color: white;
    }

    .addnew-btn a:hover{
        text-decoration: none;
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
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Hola {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                <hr class="block-spacer">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="combo-box">
                        <div class="addnew-btn">
                            <a href="{{ url('/user/create') }}">+</a>
                        </div>
                        <div class="panel-btn">
                            <a href="{{ url('/user') }}">Usuarios</a>
                        </div>
                    </div>
                    <div class="combo-box">
                        <div class="addnew-btn">
                            <a href="{{ url('/package/create') }}">+</a>
                        </div>
                        <div class="panel-btn">
                            <a href="{{ url('/package') }}">Paquetes</a>
                        </div>
                    </div>
                    <div class="combo-box">
                        <div class="addnew-btn">
                            <a href="{{ url('/lesson/create') }}">+</a>
                        </div>
                        <div class="panel-btn">
                            <a href="{{ url('/lesson') }}">Clases</a>
                        </div>
                    </div>
                    <div class="combo-box">
                        <div class="addnew-btn">
                            <a href="{{ url('/medal/create') }}">+</a>
                        </div>
                        <div class="panel-btn">
                            <a href="{{ url('/medal') }}">Medallas</a>
                        </div>
                    </div>
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
