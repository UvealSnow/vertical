@extends('layouts.app')

@section('content')
<style type="text/css">
    .panel-heading{
        background-color: #511B73 !important;
        color: white !important;
        font-size: 18px !important;
    }
    .btn-primary{
        background-color: #FBC02D !important;
        border:none !important;
        transition: all 0.2s ease;
    }
    .btn-primary:hover{
        background-color: #FFE000 !important;
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

    .front-place{
        width: 100%;
        background-color: #e1bee7;
        text-align: center;
    }

    .poles{
        text-align: center;
    }

    .pole-cont{
        width: 20%;
        display: inline-block;
        text-align: center;
    }

    .pole-cont input[type="radio"]{
        visibility: hidden;
    }

    .cont-ball{
        text-align: center;
        padding: 0 !important;
        position: relative;
    }

    .pole{
        margin: 0 auto;
    }

/* style label */
input.radio:empty ~ label {
    position: relative;
    line-height: 2.5em;
    text-indent: 3.25em;
    margin: 2em;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

input.busy:empty ~ label:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    content: '';
    width: 2.5em;
    margin: 0 auto;
    background: #F44336 !important;
    border-radius: 50%;
}

input.radio:empty ~ label:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    content: '';
    width: 2.5em;
    margin: 0 auto;
    background: #D1D3D4;
    border-radius: 50%;
}

/* toggle hover */
input.radio:hover:not(:checked) ~ label:before {
    content:'';
    text-indent: .9em;
    color: #C2C2C2;
}

input.radio:hover:not(:checked) ~ label {
    color: #888;
}

/* toggle on */
input.radio:checked ~ label:before {
    content:'';
    text-indent: .9em;
    color: #9CE2AE;
    background-color: #4DCB6D;
}

input.radio:checked ~ label {
    color: #777;
}

/* radio focus */
input.radio:focus ~ label:before {
    box-shadow: 0 0 0 3px #999;
}
    
    .pole{
        display: inline-block;
    }

    .poles-label{
        text-align: left;
    }

    .info div{
        display: inline-block;
    }

    .green{
        width: 12px;
        height: 12px;
        background-color: #4CAF50;
        border-radius: 50%;
    }

    .red{
        width: 12px;
        height: 12px;
        background-color: #F44336;
        border-radius: 50%;
    }

    .gray{
        width: 12px;
        height: 12px;
        background-color: #BDBDBD;
        border-radius: 50%;
    }    

</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Selecciona tu lugar</div>
                <div class="panel-body">
                    <p>Elige el lugar donde quieres practicar:</p>
                    <div class="front-place">Espejos</div>
                    <form class="form-horizontal poles" role="form" method="POST" action="{{ url('/lesson/signup') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                        @for ($i = 1; $i <= 7; $i++)

                            <div class="radio pole-cont">
                                <label class="cont-ball">
                                    @if (in_array($i, $used))
                                        <input type="radio" class="pole busy radio" name="pole_id" id="optionsRadios1" value="{{ $i }}" disabled>
                                    @else
                                        <input type="radio" class="pole free radio" name="pole_id" id="optionsRadios1" value="{{ $i }}">
                                    @endif
                                        <label for="optionsRadios1">&nbsp</label>
                                </label>
                            </div>
                        @endfor
                        </input>
                        <div class="poles-label col-md-12">
                            <div class="info">
                                <div class="gray"></div>
                                <div>Lugar Disponible</div>
                            </div>
                            <div class="info">
                                <div class="green"></div>
                                <div>Lugar Seleccionado</div>
                            </div>
                            <div class="info">
                                <div class="red"></div>
                                <div>Lugar Ocupado</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Seleccionar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection