@extends('layouts.app')

@section('content')
<style type="text/css">


    .lesson-box{
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 14px;
    }
        
    .lesson-dtl{
        display: flex;
        flex-direction: column;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h2>Clases</h2>
                <hr class="block-spacer"> 
                <br>
                @if (in_array(Auth::user()->role_id, [1, 2]))  
                    <a href="{{ url('/lecture/create') }}" class="new-btn"> Nueva Clase</a>
                @endif
                <br><br>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Clases</div>
                <div class="panel-body">
                        
                    @if (count($lectures) > 0)
                        <br>
                        @foreach ($lectures as $lecture)
                            <span class="lesson-box">
                                <span class="lesson-dtl">
                                    <span>
                                        <a href="{{ url('/lecture/'.trim($lecture->id)) }}">{{ $lecture->name }}</a> con: 
                                        <a href="{{ url('/user/'.trim($lecture->teacher_id)) }}">{{ $lecture->teacher->name }}</a>
                                    </span>
                                </span>
                                @if (in_array(Auth::user()->role_id, [1, 2]))
                                    <span class="btn-cont">
                                        <a class="btn btn-s btn-primary" href="{{ url('/lecture/'.$lecture->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                                        <form action="{{ url('/lecture/'.$lecture->id) }}" method="POST" style="display:inline-block;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                                        </form>
                                    </span>
                                @endif
                            </span>
                        @endforeach
                    @else
                        <p>No existen clases</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection