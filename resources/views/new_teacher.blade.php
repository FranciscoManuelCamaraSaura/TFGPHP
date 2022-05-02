@extends('layouts.master')
@section('title', 'Nuevo estudiante')
@section('content')
	<div id="newTeacher" class="container">
		<h2>Nuevo estudiante</h2>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div class="row">
			<h5>Datos del profesor</h5>

			<div id="teacherFields" class="row">
				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-2">
						<label>DNI</label>
					</div>

					<div class="col-md-3">
						<input type="text" id="teacherDNI" class="" placeholder="DNI" value="{{ old('teacherDNI') }}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Nombre</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="teacherName" class="" placeholder="Nombre" value="{{ old('teacherName') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Apellidos</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="teacherSurnames" class="" placeholder="Apellidos" value="{{ old('teacherSurnames') }}">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="col-md-3">
								<label>Teléfono</label>
							</div>

							<div class="col-md-6">
								<input type="text" id="teacherPhone" class="" placeholder="Teléfono" value="{{ old('teacherPhone') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-4">
								<label>Correo electrónico</label>
							</div>

							<div class="col-md-6">
								<input type="text" id="teacherEmail" class="" placeholder="Correco electrónico" value="{{ old('teacherEmail') }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5>Datos del domicilio</h5>

			<div id="residenceFields" class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Dirección</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="teacherAddress" class="" placeholder="Dirección" value="{{ old('teacherAddress') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Ciudad</label>
							</div>

							<div class="col-md-4">
								<input type="text" id="teacherLocation" class="" placeholder="Ciudad" value="{{ old('teacherLocation') }}">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="col-md-3">
								<label>Provincia</label>
							</div>

							<div class="col-md-6">
								<input type="text" id="teacherProvince" class="" placeholder="Provincia" value="{{ old('teacherProvince') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Código postal</label>
							</div>

							<div class="col-md-4">
								<input type="text" id="teacherPostalCode" class="" placeholder="Código postal" value="{{ old('teacherPostalCode') }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5>Datos del curso</h5>

			<div id="courseFields" class="row">
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="col-md-3">
								<label>Curso</label>
							</div>

							<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', 2)">
								<option disabled="disabled" selected="selected">Seleccione un curso</option>

								@foreach($courses as $course)
									<option value="{{ $course -> id }}">{{ $course -> number }} {{ $course -> degree }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Grupo</label>
							</div>

							<select id="group" onchange="addSubject('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', 1)">
								<option disabled="disabled" selected="selected">Seleccione un grupo</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="form-check col-md-9">
								<input id="preceptor" class="form-check-input" type="checkbox" value="">
								<label class="form-check-label" for="massive">
									Asignar como tutor del curso
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5 id="h5subjectsFields" style="display: none">Datos de las asignaturas</h5>

			<div id="subjectsFields" class="row" style="display: none">
				<div id="selectsSubjects" class="row">
				</div>

				<!--<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-2">
						<a id="addSubject" class="enlace" onclick="addSubject('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', 2)">
							<i class="fas fa-plus-circle"></i> Añadir asignatura
						</a>
					</div>
				</div>-->
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<button id="save" class="btn btn-primary" onclick="save('', '{{ $type_user }}')">
					Guardar
				</button>
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