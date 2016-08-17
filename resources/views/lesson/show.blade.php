@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clase: {{ $lesson->name.' - '.$lesson->desc }} </div>
                <div class="panel-body">
                    <p>Maestro: {{ $lesson->teacher }} </p>
                    <p>Días: <br>
                        @foreach ($lesson->days as $day)
                            {{ $day->name.' de '.$day->pivot->lesson_begins.':00 a '.$day->pivot->lesson_ends.':00' }}<br>
                        @endforeach
                    </p>
                    {{-- to do: pole position --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection