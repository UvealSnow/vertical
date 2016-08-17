@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medallas</div>
                <div class="panel-body">
                	{{ $package->name }}<br>
                    {{ $package->cost }}<br>
                	{{ $package->lessons }}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection