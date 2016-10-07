@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $medal->name }}</div>
                <div class="panel-body">
                	<p>{{ $medal->desc }}</p>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <img src="/assets/images/medals/{{ $medal->img }}" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection