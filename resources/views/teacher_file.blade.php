@extends('layouts.master')
@section('title', 'Profesor')
@section('content')
	<div id="teacherFile" class="container">
		<h2>Ficha del profesor</h2>

		<div class="row">
			<div class="col-md-2">
				<img src="{{ asset('images/home/logo.png') }}" alt="" />
			</div>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-4">
						<label id="nameTitle">Nombre</label>
					</div>

					<div class="col-md-8">
						<label id="nameLabel">{{ $teacher -> name }} {{ $teacher -> surnames }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="addressTitle">Dirección</label>
					</div>

					<div class="col-md-8">
						<label id="addressLabel">{{ $teacher -> address }}, {{ $teacher -> location }} ( {{ $teacher -> province }})</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="phoneTitle">Teléfono</label>
					</div>

					<div class="col-md-8">
						<label id="phoneLabel">{{ $teacher -> phone }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="mailTitle">Correo Electrónico</label>
					</div>

					<div class="col-md-8">
						<label id="mailLabel">{{ $teacher -> email }}</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<h5>Asignaturas</h5>

			<div class="row">
				<div class="col-md-1">
				</div>

				<div class="col-md-4">
					<label id="subjectTitle">Nombre</label>
				</div>

				<div class="col-md-3">
					<div class="row">
						<div class="col-md-4">
							<label id="courseTitle">Curso</label>
						</div>

						<div class="col-md-4">
							<label id="degreeTitle">Grado</label>
						</div>

						<div class="col-md-4">
							<label id="groupTitle">Grupo</label>
						</div>
					</div>
				</div>
			</div>

			@foreach($subjects as $subject)
				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-4">
						<label>{{ $subject['name'] }}</label>
					</div>

					<div class="col-md-3">
						<div class="row">
							<div class="col-md-4">
								<label>{{ $subject['course'] }}</label>
							</div>

							<div class="col-md-4">
								<label>{{ $subject['degree'] }}</label>
							</div>

							<div class="col-md-4">
								<label>{{ $subject['group'] }}</label>
							</div>
						</div>
					</div>
				</div>
			@endforeach
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