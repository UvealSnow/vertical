@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clases</div>
                <div class="panel-body">
                	@if (count($lessons) > 0)
                        @if ($user->privilege === 'Maestra' || $user->privilege === 'admin')
                            <a href="{{ url('/lesson/create') }}">+ Clase</a><br>
                        @endif
                        <a href="{{ url('/lesson/signup') }}">Incríbete a una clase</a><br><br>
                        @foreach ($lessons as $lesson)
                            <a href="{{ url('/lesson/'.$lesson->id) }}">{{ $lesson->name }}</a>
                            <a href="{{ url('/lesson/'.$lesson->id) }}">{{ $lesson->teacher }}</a>
                            @if ($user->privilege === 'Maestra' || $user->privilege === 'admin')
                                <a class="btn btn-xs btn-primary" href="{{ url('/lesson/'.$lesson->id).'/edit' }}">Editar</a>
                                <form action="{{ url('/lesson/'.$lesson->id) }}" method="POST" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button class="btn btn-xs btn-danger" on-click="form.submit()">Eliminar</button>
                                </form>
                            @endif
                            <br><br>
                        @endforeach
                    @else
                        <p>No tienes clases programadas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection