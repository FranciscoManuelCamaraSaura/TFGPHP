@extends('layouts.master')
@section('title', 'Asignaturas')
@section('content')
	<div id="subjectsList" class="container">
		<h2>Asignaturas</h2>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-3">
				<label id="subjectTitle">Asignatura</label>
			</div>

			<div class="col-md-1">
			</div>

			<div class="col-md-2">
				<div class="row">
					<div class="col-md-4">
						<label id="coruseTitle">Curso</label>
					</div>

					<div class="col-md-4">
						<label id="degreeTitle">Grado</label>
					</div>

					<div class="col-md-4">
						<label id="groupTitle">Grupo</label>
					</div>
				</div>
			</div>

			<div class="col-md-1">
			</div>

			<div class="col-md-4">
				<label id="studentsNumber">Número de alumnos</label>
			</div>
		</div>

		@foreach($subjects as $subject)
			<div class="row">
				<div class="col-md-1">
				</div>

				<div class="col-md-3">
					<a href="{{ URL::asset('/subjects/' . $school . '/person/' . $person -> id . '/subject/' . $subject -> code . '?type_user=' . $type_user) }}">{{ $subject -> name }}</a>
				</div>

				<div class="col-md-1">
				</div>

				<div class="col-md-2">
					<div class="row">
						<div class="col-md-4">
							<label id="courseNumber">{{ $courses[$loop -> index] -> number }}</label>
						</div>

						<div class="col-md-4">
							<label id="courseDegree">{{ $courses[$loop -> index] -> degree }}</label>
						</div>

						<div class="col-md-4">
							<label id="courseGroup">{{ $groups[$loop -> index] }}</label>
						</div>
					</div>
				</div>

				<div class="col-md-1">
				</div>

				<div class="col-md-4">
					<label id="students">{{ $students[$loop -> index] }}</label>
				</div>
			</div>
		@endforeach

		<div class="row">
			<div class="col-md-1">
				<button id="back" class="btn btn-primary" onclick="window.history.back()">
					Volver
				</button>
			</div>
		</div>
	</div>
@endsection