@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>
                <div class="panel-body">
                	<a href="{{ url('/user/create') }}">+ Usuario</a><br><br>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <a href="{{ url('/user/'.$user->id) }}">{{ $user->first_name.' '.$user->last_name }}</a>
                            <span> {{ $user->privilege }} </span>
                            @if ($user->privilege != 'admin' || $user->id != Auth::user()->id)
                                <a class="btn btn-xs btn-primary" href="{{ url('/user/'.$user->id).'/edit' }}">Editar</a>
                                <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button class="btn btn-xs btn-danger" on-click="form.submit()">Eliminar</button>
                                </form>
                            @endif
                            <br><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection