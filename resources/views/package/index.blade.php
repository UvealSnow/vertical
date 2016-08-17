@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Paquetes</div>
                <div class="panel-body">
                	<a href="{{ url('/package/create') }}">+ Paquete</a><br>
                    @if (count($packages) > 0)
                        @foreach ($packages as $package)
                            <a href="{{ url('/package/'.$package->id) }}">{{ $package->name }}</a>
                            <a class="btn btn-xs btn-primary" href="{{ url('/package/'.$package->id).'/edit' }}">Editar</a>
                            <form action="{{ url('/package/'.$package->id) }}" method="POST" style="display:inline-block;">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-xs btn-danger" on-click="form.submit()">Eliminar</button>
                            </form>
                            <br><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection