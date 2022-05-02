@extends('layouts.master')
@section('title', 'Calendario')
@section('content')
	<div id="calendar" class="container">
		<h2>Calendario</h2>

		<div class="row">
			<div class="col-md-12">
				<button id="addEventButton" class="btn btn-lg btn-primary" onclick="addEvent('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-envelope"></i>
						<p>Nuevo evento</p>
					</div>
				</button>
			</div>
		</div>

		<div class="row header-calendar">
			<div class="col">
				<a  href="{{ URL::asset('/events/' . $school . '/person/' . $person -> id . '/calendar?type_user=' . $type_user . '&month=' . $data['previous'] . '&page=' . $page) }}">
					<i class="fas fa-arrow-circle-left"></i>
				</a>

				<h5>{{ $full_month }} <small>{{ $data["year"] }}</small></h5>

				<a  href="{{ URL::asset('/events/' . $school . '/person/' . $person -> id . '/calendar?type_user=' . $type_user . '&month=' . $data['next'] . '&page=' . $page) }}">
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col header-col">Lunes</div>
			<div class="col header-col">Martes</div>
			<div class="col header-col">Miercoles</div>
			<div class="col header-col">Jueves</div>
			<div class="col header-col">Viernes</div>
			<div class="col header-col">Sabado</div>
			<div class="col header-col">Domingo</div>
		</div>

		@foreach($data['calendar'] as $week_data)
			<div class="row">
				@foreach($week_data['data'] as $day_data)
					@if($day_data['month'] == $month && $day_data['holidays'] != true)
						<div class="col box-day">
							{{ $day_data['day'] }}
							<br>

							@foreach($day_data['events'] as $events)
								@foreach($events as $event)
									<a href="{{ URL::asset('events/' . $school . '/person/' . $person -> id . '/editEvent?event=' . $event -> id . '&type_user=' . $type_user) }}">
										{{ $event -> name }}
									</a>
									<br>
								@endforeach
							@endforeach
						</div>
					@else
						<div class="col box-dayoff">
							{{ $day_data['day'] }}
						</div>
					@endif
				@endforeach
			</div>
		@endforeach

		<div class="row">
			<div class="col-md-1">
				<button id="back" class="btn btn-primary" onclick="back('{{ $page }}')">
					Volver
				</button>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/events.js') }}"></script>
@endsection