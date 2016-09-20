@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Otorgar Medalla a: {{ $alumn->first_name.' '.$alumn->last_name }} </div>
                <div class="panel-body">
                    @if (count($medals) > 0)
                        <form action="{{ url('/user/'.$alumn->id.'/medal') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $alumn->id }}">
                            
                            @foreach ($medals as $medal)
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="medal_id" value="{{ $medal->id }}">
                                        {{ $medal->name }} - {{ $medal->desc }}
                                    </label>
                                </div>
                            @endforeach
                            <hr>
                            <button class="btn btn-primary">Otorgar</button>
                            
                        </form>
                    @else
                        <p>No hay medallas creadas. @if (Auth::user()->privilege === 'admin') <a href=" {{ url('/medal/create') }} ">+ Crear medalla</a> @endif </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
