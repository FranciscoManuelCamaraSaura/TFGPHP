@extends('layouts.master')
@section('title', 'Editar estudiante')
@section('content')
	<div id="editStudent" class="container">
		<h2>Datos del estudiante</h2>

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
						<label id="legalGuardianDNILabel">{{ $legal_guardian -> dni }}</label>
						<input type="text" id="legalGuardianDNI" class="" placeholder="DNI" value="{{ $legal_guardian -> dni }}" style="display: none">
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
								<label id="legalGuardianNameLabel">{{ $legal_guardian -> name }}</label>
								<input type="text" id="legalGuardianName" class="" placeholder="Nombre" value="{{ $legal_guardian -> name }}" style="display: none">
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
								<label id="legalGuardianSurnamesLabel">{{ $legal_guardian -> surnames }}</label>
								<input type="text" id="legalGuardianSurnames" class="" placeholder="Apellidos" value="{{ $legal_guardian -> surnames }}" style="display: none">
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
								<label id="legalGuardianPhoneLabel">{{ $legal_guardian -> phone }}</label>
								<input type="text" id="legalGuardianPhone" class="" placeholder="Teléfono" value="{{ $legal_guardian -> phone }}" style="display: none">
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
								<label id="legalGuardianEmailLabel">{{ $legal_guardian -> email }}</label>
								<input type="text" id="legalGuardianEmail" class="" placeholder="Correco electrónico" value="{{ $legal_guardian -> email }}" style="display: none">
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
								<label id="studentNameLabel">{{ $student -> name }}</label>
								<input type="text" id="studentName" class="" placeholder="Nombre" value="{{ $student -> name }}" style="display: none">
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
								<label id="studentSurnamesLabel">{{ $student -> surnames }}</label>
								<input type="text" id="studentSurnames" class="" placeholder="Apellidos" value="{{ $student -> surnames }}" style="display: none">
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
								<label id="studentPhoneLabel">{{ $student -> phone }}</label>
								<input type="text" id="studentPhone" class="" placeholder="Teléfono" value="{{ $student -> phone }}" style="display: none">
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

							<div class="col-md-4">
								<label id="birthdayLabel">{{ $student -> birthday }}</label>

								<div id="datepickerBirthday" class="input-group date" data-provide="datepicker" style="display: none">
									<input id="datepickerInput" class="form-control" type="text" />
									<button class="btn btn-primary">
										<i class="fas fa-calendar-alt"></i>
									</button>
								</div>
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
								<label id="legalGuardianAddressLabel">{{ $legal_guardian -> address }}</label>
								<input type="text" id="legalGuardianAddress" class="" placeholder="Dirección" value="{{ $legal_guardian -> address }}" style="display: none">
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
								<label id="legalGuardianLocationLabel">{{ $legal_guardian -> location }}</label>
								<input type="text" id="legalGuardianLocation" class="" placeholder="Ciudad" value="{{ $legal_guardian -> location }}" style="display: none">
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
								<label id="legalGuardianProvinceLabel">{{ $legal_guardian -> province }}</label>
								<input type="text" id="legalGuardianProvince" class="" placeholder="Provincia" value="{{ $legal_guardian -> province }}" style="display: none">
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
								<label id="legalGuardianPostalCodeLabel">{{ $legal_guardian -> postal_code }}</label>
								<input type="text" id="legalGuardianPostalCode" class="" placeholder="Código postal" value="{{ $legal_guardian -> postal_code }}" style="display: none">
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

							<div class="col-md-4">
								<label id="courseLabel">{{ $course_default -> number }} {{ $course_default -> degree }}</label>

								<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')" style="display: none">
									<option disabled="disabled">Seleccione un curso</option>

									@foreach($courses as $course)
										@if ($course -> id === $course_default -> id)
											<option value="{{ $course -> id }}" selected="selected">{{ $course -> number }} {{ $course -> degree }}</option>
										@else
											<option value="{{ $course -> id }}">{{ $course -> number }} {{ $course -> degree }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Grupo</label>
							</div>

							<div class="col-md-4">
								<label id="groupLabel">{{ $student -> group_words }}</label>

								<select id="group" style="display: none">
									<option disabled="disabled">Seleccione un grupo</option>

									@foreach($groups as $group)
										@if ($group -> group_words === $student -> group_words)
											<option value="{{ $group -> group_words }}" selected="selected">{{ $group -> group_words }}</option>
										@else
											<option value="{{ $group -> group_words }}">{{ $group -> group_words }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<button id="edit" class="btn btn-primary" onclick="edit('{{ $student -> birthday }}')">
					Editar
				</button>

				<div id="saveOptions" class="row" style="display: none">
					<div class="col-md-5">
					</div>

					<div class="col-md-1">
						<button id="save" class="btn btn-primary" onclick="save('{{ $student -> id }}', '{{ $type_user }}')">
							Guardar
						</button>
					</div>

					<div class="col-md-1">
						<button id="cancel" class="btn btn-primary" onclick="cancel()">
							Cancel
						</button>
					</div>
				</div>
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