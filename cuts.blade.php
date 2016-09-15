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