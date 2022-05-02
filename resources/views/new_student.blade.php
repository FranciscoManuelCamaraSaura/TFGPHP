@extends('layouts.master')
@section('title', 'Nuevo estudiante')
@section('content')
	<div id="newStudent" class="container">
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
			<h5>Datos del tutor</h5>

			<div id="legalGuardianFields" class="row">
				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-2">
						<label>DNI</label>
					</div>

					<div class="col-md-3">
						<input type="text" id="legalGuardianDNI" class="" placeholder="DNI" value="{{ old('legalGuardianDNI') }}">
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
								<input type="text" id="legalGuardianName" class="" placeholder="Nombre" value="{{ old('legalGuardianName') }}">
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
								<input type="text" id="legalGuardianSurnames" class="" placeholder="Apellidos" value="{{ old('legalGuardianSurnames') }}">
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
								<input type="text" id="legalGuardianPhone" class="" placeholder="Teléfono" value="{{ old('legalGuardianPhone') }}">
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
								<input type="text" id="legalGuardianEmail" class="" placeholder="Correco electrónico" value="{{ old('legalGuardianEmail') }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5>Datos del alumno</h5>

			<div id="studentFields" class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Nombre</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="studentName" class="" placeholder="Nombre" value="{{ old('studentName') }}">
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
								<input type="text" id="studentSurnames" class="" placeholder="Apellidos" value="{{ old('studentSurnames') }}">
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
								<input type="text" id="studentPhone" class="" placeholder="Teléfono" value="{{ old('studentPhone') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-4">
								<label>Fecha de nacimiento</label>
							</div>

							<div id="datepickerBirthday" class="input-group date" data-provide="datepicker">
								<input id="datepickerInput" class="form-control" type="text" />
								<button class="btn btn-primary">
									<i class="fas fa-calendar-alt"></i>
								</button>
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
								<input type="text" id="legalGuardianAddress" class="" placeholder="Dirección" value="{{ old('legalGuardianAddress') }}">
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
								<input type="text" id="legalGuardianLocation" class="" placeholder="Ciudad" value="{{ old('legalGuardianLocation') }}">
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
								<input type="text" id="legalGuardianProvince" class="" placeholder="Provincia" value="{{ old('legalGuardianProvince') }}">
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
								<input type="text" id="legalGuardianPostalCode" class="" placeholder="Código postal" value="{{ old('legalGuardianPostalCode') }}">
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

							<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
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

							<select id="group">
								<option disabled="disabled" selected="selected">Seleccione un grupo</option>
							</select>
						</div>
					</div>
				</div>
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

	<script src="{{ asset('js/student.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.es.js') }}"></script>
	<script type="text/javascript">
		window.onload = function() {
			createDataPicker();
		}
	</script>
@endsection