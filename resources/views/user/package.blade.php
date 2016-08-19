@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar paquete a: {{ $user->first_name.' '.$user->last_name }} </div>
                <div class="panel-body">
                    <form action="{{ url('/user/package') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        @foreach ($packages as $package)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="package_id" value="{{ $package->id }}">
                                    {{ $package->name }}
                                </label>
                            </div>
                        @endforeach
                        <hr>
                        <button class="btn btn-primary">Agregar</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
