@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medallas</div>
                <div class="panel-body">
                    @if ($user->privilege === 'admin')
                        <a href="{{ url('/medal/create') }}">+ Medalla</a><br>
                    @endif
                	@if (count($medals) > 0)
                        @foreach ($medals as $medal)
                            <a href="{{ url('/medal/'.$medal->id) }}">{{ $medal->name }}</a>
                            <a class="btn btn-xs btn-primary" href="{{ url('/medal/'.$medal->id).'/edit' }}">Editar</a>
                            <form action="{{ url('/medal/'.$medal->id) }}" method="POST" style="display:inline-block;">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-xs btn-danger" on-click="form.submit()">Eliminar</button>
                            </form>
                            <br><br>
                        @endforeach
                    @else
                        <p>No hay medallas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection