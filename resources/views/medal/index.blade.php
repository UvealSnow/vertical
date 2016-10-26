@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h2>Medallas</h2>
                <hr class="block-spacer"> 
                @if (Auth::user()->role_id == 1)
                    <a href="{{ url('/medal/create') }}" class="new-btn">Nueva Medalla</a>
                @endif
                <br><br>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Medallas
                </div>
                <div class="panel-body">
                	@if (count($medals) > 0)
                        @foreach ($medals as $medal)
                            <span class="user">
                            <a href="{{ url('/medal/'.$medal->id) }}">{{ $medal->name }}</a>
                            <span class="btn-cont">
                            <a class="btn btn-s btn-primary" href="{{ url('/medal/'.$medal->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                            <form action="{{ url('/medal/'.$medal->id) }}" method="POST" style="display:inline-block;">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                            </form>
                            </span>
                            </span>
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