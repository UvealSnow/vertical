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

    .class-set{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Paquete</div>
                <div class="panel-body">
                    <span class="class-set">
                	   <b>Nombre del Paquete:</b> {{ $package->name }}<br><br>
                    </span>
                    <span class="class-set">
                        <b>Precio del Paquete:</b>$ {{ money_format('%i', $package->amount) }}<br><br>
                    </span>
                    @if ($package->pole_lessons > 0)
                        <span class="class-set">
                    	   <b>Clases de pole incluidas: </b>{{ $package->pole_lessons }} <br><br>
                        </span>
                    @endif
                    @if ($package->regular_lessons > 0)
                        <span class="class-set">
                            <b>Clases incluidas: </b>{{ $package->regular_lessons }} <br><br>
                        </span>
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