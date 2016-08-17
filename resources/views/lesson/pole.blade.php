@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Selecciona tu lugar</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/lesson/signup') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                        @for ($i = 1; $i <= 7; $i++)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="pole_id" id="optionsRadios1" value="{{ $i }}">
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