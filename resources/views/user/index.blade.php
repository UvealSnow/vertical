@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Usuarios</h2>
            <hr class="block-spacer"><br>
            @if (Auth::user()->role_id == 1)
            <a href="{{ url('/user/create') }}" class="new-btn"> Nuevo Usuario</a>
            @endif

            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Alumnas
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->role_id == 4)
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->name }}</a>
                                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                                </span>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            @if (Auth::user()->role_id == 1)
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Maestras
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->role_id == 2)
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->name }}</a>
                                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Nutrióloga  
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->role_id == 3)
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->name }}</a>
                                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Administradores
                </div>
                <div class="panel-body">
                    @if (count($users) > 0)
                        @foreach ($users as $user )
                            @if ($user->role_id == 1)
                                <span class="user">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->name }}</a>
                                @if (Auth::user()->role_id == 1 && Auth::user()->id != $user->id)
                                    <span class="btn-cont">
                                    <a class="btn btn-s btn-primary " href="{{ url('/user/'.$user->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                    </form>
                                    </span>
                                @endif
                            @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection