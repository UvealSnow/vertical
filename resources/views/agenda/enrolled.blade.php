@extends('layouts.app')

@section('content')
<style type="text/css">
    .panel-heading{
        background-color: #511B73 !important;
        color: white !important;
        font-size: 18px !important;
    }
    .btn-primary{
        background-color: #FFE000 !important;
        border:none !important;
        transition: all 0.2s ease;
    }
    .btn-primary:hover{
        background-color: #FBC02D !important;
    }
    .logo-vertical{
        display: flex;
        align-items: center;
        justify-content: center;
        border: none !important;
        box-shadow: none !important;
    }

    .dir-vertical{
        border: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: none !important;
    }

    .dir-vertical p{
        text-align: center;
    }

    .front-place{
         width: 100%;
         background-color: #e1bee7;
         text-align: center;
     }
 
     .poles{
         text-align: center;
     }
 
     .pole-cont{
         width: 20%;
         display: inline-block;
         text-align: center;
     }
 
     .pole-cont input[type="radio"]{
     }
 
     .cont-ball{
         text-align: center;
         padding: 0 !important;
         position: relative;
         margin: 0 auto;
     }
 
     .pole{
         margin: 0 auto;
     }
 
 /* style label */
 input.radio:empty ~ label {
     position: relative;
     line-height: 2.5em;
     text-indent: 3.25em;
     margin: 2em;
     cursor: pointer;
     -webkit-user-select: none;
     -moz-user-select: none;
     -ms-user-select: none;
     user-select: none;
 }
 
 input.busy:empty ~ label:before {
     position: absolute;
     display: block;
     top: 0;
     bottom: 0;
     left: 0;
     right: 0;
     content: '';
     width: 2.5em;
     margin: 0 auto;
     background: #F44336 !important;
     border-radius: 50%;
 }
 
 input.radio:empty ~ label:before {
     position: absolute;
     display: block;
     top: 0;
     bottom: 0;
     left: 0;
     right: 0;
     content: '';
     width: 2.5em;
     margin: 0 auto;
     background: #D1D3D4;
     border-radius: 50%;
 }
 
 /* toggle hover */
 input.radio:hover:not(:checked) ~ label:before {
     content:'';
     text-indent: .9em;
     color: #C2C2C2;
 }
 
 input.radio:hover:not(:checked) ~ label {
     color: #888;
 }
 
 /* toggle on */
 input.radio:checked ~ label:before {
     content:'';
     text-indent: .9em;
     color: #9CE2AE;
     background-color: #4DCB6D;
 }
 
 input.radio:checked ~ label {
     color: #777;
 }
 
 /* radio focus */
 input.radio:focus ~ label:before {
     box-shadow: 0 0 0 3px #999;
 }
     
     .pole{
         display: inline-block;
     }
 
     .poles-label{
         text-align: left;
     }
 
     .info div{
         display: inline-block;
     }
 
     .green{
         width: 12px;
         height: 12px;
         background-color: #4CAF50;
         border-radius: 50%;
     }
 
     .red{
         width: 12px;
         height: 12px;
         background-color: #F44336;
         border-radius: 50%;
     }
 
     .gray{
         width: 12px;
         height: 12px;
         background-color: #BDBDBD;
         border-radius: 50%;
     }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Alumnas inscritas en {{ $lecture->name }} con {{ $lecture->teacher->name }} de {{ $agenda->begins }}hrs a {{ $agenda->ends }}hrs</div>
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
                        <label class="col-sm-4 control-label">Escoje el día</label>
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
                            <label class="col-sm-4 control-label">Alumnas incritas en esta clase</label>

                            <div class="col-sm-6 col-sm-offset-4" ng-repeat="pole in poles">
                                <label>
                                    <input ng-if="!pole.status" style="margin: 10px;" type="radio" name="pole_id" value="<% $index %>">
                                    <input ng-if="pole.status" style="margin: 10px;" type="radio" name="pole_id" value="<% $index %>" disabled>
                                    <span>Pole <% $index + 1 %></span> - 
                                    <span ng-if="pole.user[0].name"><% pole.user[0].name %></span>
                                    <span ng-if="!pole.status">Libre</span>
                                </label>
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
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default logo-vertical">
                <img src="/assets/Verticalc.svg" alt="Vertical Pole & Fitness">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default dir-vertical">
                <p>
                    Av. Tercer Milenio #385<br>
                    San Luis Potosí, 78211
                </p>
            </div>
        </div>
    </div>
</div>
@endsection