@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detalles de {{ $user->name }}</div>
                <div class="panel-body">

                    <a class="btn btn-primary" href="{{ url("/user/$user->id") }}">< Regresar</a>
                    <a class="btn btn-primary" href="{{ url("/user/$user->id/details/".$user->details->id."/edit") }}">Editar</a> <br><hr>
                    
                    <p>
                        Lesiones óseas: 
                        @if ($user->details->bone_injury)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Lesiones musculares: 
                        @if ($user->details->muscle_injury)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Problemas cardiacos: 
                        @if ($user->details->heart_problems)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Problemas respiratorios: 
                        @if ($user->details->breathing_problems)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Alergias: 
                        @if ($user->details->alergy_problems)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Toma medicinas: 
                        @if ($user->details->medicine_intake)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Actividad física reciente (al inscribirse): 
                        @if ($user->details->recent_activity)
                            Si
                        @else
                            No
                        @endif
                    </p>
                    <p>
                        Como nos encontró: 
                        @if ($user->details->referer)
                            {{ $user->details->referer }}
                        @else
                            No
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
