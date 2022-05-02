@extends('layouts.master')
@section('title', 'Alumnos')
@section('content')
	<div id="studentsList" class="container">
		<h2>Listado de alumnos</h2>

		@if ($type_user === 'Manager')
			<div id="formSearch">
				<div class="row">
					<div class="col-md-3">
					</div>

					<div class="col-md-1">
						<label>Curso</label>
					</div>

					<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<option disabled="disabled" selected="selected">Seleccione una curso</option>

						@foreach($courses as $course)
							<option value="{{ $course -> id }}">{{ $course -> number }} {{ $course -> degree }}</option>
						@endforeach
					</select>

					<div class="col-md-1">
						<label>Grupo</label>
					</div>

					<select id="group" onchange="validateGroup('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<option disabled="disabled" selected="selected">Seleccione un grupo</option>
					</select>
				</div>
			</div>

			<div id="studentsTable" style="display: none">
		@else
			<div id="studentsTable">
		@endif
			<div class="row">
				<div class="col-md-1">
				</div>

				<div class="col-md-3">
					<label>Nombre</label>
				</div>

				<div class="col-md-8">
					<div class="row">
						<div class="col-md-4">
							<label>Nota media del primer trimestre</label>
						</div>

						<div class="col-md-4">
							<label>Nota media del segundo trimestre</label>
						</div>

						<div class="col-md-4">
							<label>Nota media del tercer trimestre</label>
						</div>
					</div>
				</div>
			</div>

			<div id="studentsTableContent">
				@foreach($evaluations as $student)
					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-3">
							<a href="{{ URL::asset('/students/' . $school . '/person/' . $person -> id . '/student/' . $student['id'] . '?type_user=' . $type_user) }}">{{ $student['name'] }}</a>
						</div>

						<div class="col-md-8">
							<div class="row">
								<div class="col-md-4">
									<label>{{ $student['noteFirstTrimester'] }}</label>
								</div>

								<div class="col-md-4">
									<label>{{ $student['noteSecondTrimester'] }}</label>
								</div>

								<div class="col-md-4">
									<label>{{ $student['noteThirdTrimester'] }}</label>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
				<button id="back" class="btn btn-primary" onclick="window.history.back()">
					Volver
				</button>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/student.js') }}"></script>
@endsection