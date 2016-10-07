@if ($lesson->enrolled)
    <p>Ya estás inscrita en esta clase</p>

    @if ($lesson->use_poles)
        <p>Pole ID: {{ $user->id }}</p>
    @endif
@else
    @if ($lesson->use_poles) 
        <p>Créditos de Pole: {{ $user->pole_lessons }} </p>
        <p>Tus Créditos expiran el: {{ $user->pole_expire }}</p>
    @else
        <p>Créditos de clase: {{ $user->available_lessons }}</p>
        <p>Tus Créditos expiran el: {{ $user->lesson_expire }}</p>
    @endif 
    <hr>
    @if ($lesson->max_students > $lesson->enrolled_students)
        <form action="{{ url('/lesson/enroll') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
            <br>
            <div class="form-group">
                <div class="col-md-12">
                    <p>Escoje los días</p> <br>

                    @foreach ($lesson->days->sortBy('id') as $i => $day)
                        @if ($day->pivot->max_users > $day->pivot->enrolled_users)
                            <input type="checkbox" name="days[{{ $i }}]" value="{{ $i }}"> {{ $day->name }}<br><br>
                            
                            @if ($lesson->use_poles)
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <p>Escoje tu pole</p> <br>
                                        @for ($j = 1; $j <= 7; $j++)
                                            @if (!$lesson->users->contains('pole_id', $j)) 
                                                <input type="radio" name="days[{{ $i }}][pole]"> {{ $j }}
                                            @else {{-- if pole is reserved --}}
                                                <input type="radio" disabled> (R) {{ $j }}
                                            @endif
                                        @endfor
                                        <br><br>
                                    </div>
                                </div>
                            @endif

                        @else {{-- Disable days that are full --}}
                            <input type="checkbox" disabled> (Lleno) {{ $day->name }}<br><br>
                        @endif
                     @endforeach
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2 col-md-offset-10">
                    <button class="btn btn-primary">Inscíbete</button>
                </div>
            </div>
        </form>
    @endif
@endif


--------

<span>
    @foreach ($lesson->days as $i => $day)
        <span>{{ $day->name }}</span>
        @if (count($lesson->days) - 1  > $i) 
            <span> - </span>
        @endif
    @endforeach
</span>


--------



@if ($user->privilege === 'admin' || $user->privilege === 'Maestra')
    <div class="col-md-12">
        <h4>Renovar clase</h4>

        <form action=" {{ url('/lesson/'.$lesson->id.'/renew') }} " method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="col-md-2 control-label">Tiempo</label>
                <div class="col-md-8">
                    <select class="form-control" name="time">
                        <option value="1">+1 Mes</option>
                        <option value="2">+2 Mes</option>
                        <option value="3">+3 Mes</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2 col-md-offset-8">
                    <button class="btn btn-primary"> Renovar </button>    
                </div>
            </div>
            
        </form>

    </div>
    <hr>
@endif

<h4>Maestra: {{ $lesson->teacher->first_name.' '.$lesson->teacher->last_name }}</h4> <br>

{{-- to do: filtrado de días¿ --}}

@if (($lesson->use_poles && $user->pole_lessons > 0) || (!$lesson->use_poles && $user->available_lessons > 0))
    <p>Selecciona las clases a las cuales quieras inscribirte</p><br>
    <h4>Classes disponibles:</h4><br>
    <form class="form-horizontal" action=" {{ url('lesson/'.$lesson->id.'/enroll') }} " method="POST">
        <div class="form-group">
            {{ csrf_field() }}
            <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
            <label class="col-md-2 control-label">Días</label>
            <div class="col-md-8">
                <select name="day" class="form-control" id="day_id" ng-model="day_id">
                    @foreach ($lesson->days as $i => $day)
                        @if ($i == 0)
                            <option value="{{ $day->pivot->id }}" selected="selected">
                        @else
                            <option value="{{ $day->pivot->id }}">
                        @endif
                                {{ date('l d, F', strtotime($day->pivot->date)).' ('.$lesson->begins.'hrs - '.$lesson->ends.'hrs) '.$day->pivot->enrolled.'/'.$lesson->max_students }}
                            </option>
                    @endforeach
                </select>
                <br>
                <div class="row" ng-repeat="user in enrolled" ng-if="user.id == user_id">
                    <p>Ya estás inscrita en esta clase.</p>
                </div>
                @if ($lesson->use_poles)
                     <div class="front-place">Espejos</div>
                        
                        <div class="radio pole-cont" ng-repeat="pole in poles">
                            <label ng-if="pole.status"> 
                                <input type="radio" name="pole_id" value="<% $index %>" class="disabled" disabled> Pole <% $index %> 
                            </label>

                            <label ng-if="!pole.status"> 
                                <input type="radio" name="pole_id" value="<% $index %>"> Pole <% $index %> 
                            </label>
                        </div>
                        
                    <br><br>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 col-md-offset-8">
                <button class="btn btn-primary">Inscríbete</button>
            </div>
        </div>

        <h4>Alumnos inscritos</h4>
        <div class="row" ng-repeat="user in enrolled">
            <div class="col-sm-6">
                <p><% user.first_name+' '+ user.last_name %></p>
            </div>
        </div>

    </form>
@else
    <p>Necesitas más créditos para inscribirte. <a href=" {{ url('/package') }} ">Compra más.</a></p>
@endif
<hr>