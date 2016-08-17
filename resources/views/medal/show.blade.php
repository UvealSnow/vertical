@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medallas</div>
                <div class="panel-body">
                	{{ $medal->name }}<br>
                	{{ $medal->desc }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection