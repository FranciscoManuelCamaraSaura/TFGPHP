@extends('layouts.master')
@section('title', 'Profesores')
@section('content')
	<div id="teachersList" class="container">
		<h2>Profesores</h2>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<button id="newTeacherButton" class="btn btn-lg btn-primary" onclick="newTeacher('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-user-plus"></i>
						<p>Crear profesor</p>
					</div>
				</button>
			</div>
		</div>

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

				<select id="group" onchange="validateGroup('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', 1)">
					<option disabled="disabled" selected="selected">Seleccione un grupo</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div id="teachersTable" style="display: none">
			<div class="row">
				<div class="col-md-1">
				</div>

				<div class="col-md-3">
					<label>Nombre</label>
				</div>

				<div class="col-md-4">
					<label>Asignatura</label>
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-md-5">
							<label>Opciones</label>
						</div>
					</div>
				</div>
			</div>

			<div id="teachersTableContent">
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

	<script src="{{ asset('js/teachers.js') }}"></script>
@endsection