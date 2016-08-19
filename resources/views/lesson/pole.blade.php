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
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Selecciona tu lugar</div>
                <div class="panel-body">
                    <p>Elige el lugar donde quieres practicar:</p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/lesson/signup') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                        @for ($i = 1; $i <= 7; $i++)
                            <div class="radio">
                                <label>
                                    @if (in_array($i, $used))
                                        <input type="radio" name="pole_id" id="optionsRadios1" value="{{ $i }}" disabled>
                                    @else
                                        <input type="radio" name="pole_id" id="optionsRadios1" value="{{ $i }}">
                                    @endif
                                        Pole: {{ $i }}
                                </label>
                            </div>
                        @endfor

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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