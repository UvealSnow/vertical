@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $lecture->name }} con {{ $lecture->teacher->name }} de {{ $agenda->begins }}hrs a {{ $agenda->ends }}hrs</div>
            </div>
            <div class="panel panel-body" ng-controller="lessonCtrl">
                
                <form action="{{ url("/lecture/$lecture->id/agenda/$agenda->id") }}" method="POST" class="form-horizontal">
                    
                    {{ csrf_field() }}
                    <input type="hidden" name="agenda_id" id="agenda_id" value="{{ $agenda->id }}">
                    @if ($lecture->is_pole)
                        <input type="hidden" id="is_pole" value="true">
                    @else
                        <input type="hidden" id="is_pole" value="false">
                    @endif

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Escoje tu día</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="date" name="date" ng-model="date">
                                @for ($i = 0; $i < 4; $i++)
                                    <option value="{{ urlencode(date('o-m-d', strtotime('next Monday +'.($i*7).' days'))) }}">
                                        {{ $agenda->day }}, {{ date('d M', strtotime('next Monday +'.($i*7).' days')) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- if $lecture->is_pole: coose pole --}}

                    @if ($lecture->is_pole)
                        <div class="form-group">
                            <label ng-if="!enrolled" class="col-sm-4 control-label">Escoje tu pole</label>
                            <label ng-if="enrolled" class="col4 col-sm-offset-1">Ya estás inscrita en esta clase</label>
                            <br><br>
                            <div class="mirror-space">Espejos</div>
                            <div class="pole-group col-sm-12">
                            <div class="col-sm-3 solo-pole" ng-repeat="pole in poles">
                                <label>
                                    <input ng-if="!pole.status && !enrolled" style="margin: 10px; background-color: green;" type="radio" name="pole_id" value="<% $index + 1 %>">
                                    <input ng-if="pole.status && !enrolled" style="margin: 10px;" type="radio" name="pole_id" value="<% $index + 1 %>" disabled><br>
                                    <span class="pole-number"><% $index + 1 %></span><br>
                                    <span ng-if="pole.user[0].name" class="pole-occupied"><% pole.user[0].name %></span>
                                    <span ng-if="!pole.status" class="pole-free">Libre</span>
                                </label>
                            </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <div class="col-sm-6  col-sm-offset-4">Alumnas inscritas en esta clase</div>

                            <div class="col-sm-6 col-sm-offset-4" ng-if="students.length > 0">
                                <ol>
                                    <li ng-repeat="student in students"><% student.name %></li>
                                </ol>
                            </div>

                            <div class="col-sm-6 col-sm-offset-4" ng-if="students.length < 1">
                                <p>No hay nadie inscrito en esta clase.</p>
                            </div>
                        </div>
                    @endif
                    <br><br>
                    <div class="form-group">
                        <div class="col-sm-offset-8 col-sm-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i>Incríbete</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>
@endsection