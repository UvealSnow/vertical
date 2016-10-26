@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Paquetes</h2>
            <hr class="block-spacer">
            <br>
            <a href="{{ url('/package/create') }}" class="new-btn">Nuevo Paquete</a>
            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading minor-header">Paquetes
                </div>
                <div class="panel-body">
                    @if (count($packages) > 0)
                        @foreach ($packages as $package)
                            <span class="user">
                            <a href="{{ url('/package/'.$package->id) }}">{{ $package->name }}</a>
                            <span class="btn-cont">
                            <a class="btn btn-s btn-primary" href="{{ url('/package/'.$package->id).'/edit' }}"><i class="fa fa-pencil-square icon-btn icon-edit" aria-hidden="true"></i></a>
                            <form action="{{ url('/package/'.$package->id) }}" method="POST" style="display:inline-block;">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-s btn-danger" on-click="form.submit()"><i class="fa fa-minus-square icon-btn icon-delete" aria-hidden="true"></i></button>
                            </form>
                            </span>
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection