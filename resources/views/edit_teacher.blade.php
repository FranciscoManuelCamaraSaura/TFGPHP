@extends('layouts.master')
@section('title', 'Editar profesor')
@section('content')
	<div id="editTeacher" class="container">
		<h2>Editar profesor</h2>

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
						<label id="teacherDNILabel">{{ $teacher -> dni }}</label>
						<input type="text" id="teacherDNI" class="" placeholder="DNI" value="{{ $teacher -> dni }}" style="display:none;">
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
								<label id="teacherNameLabel">{{ $teacher -> name }}</label>
								<input type="text" id="teacherName" class="" placeholder="Nombre" value="{{ $teacher -> name }}" style="display:none;">
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
								<label id="teacherSurnamesLabel">{{ $teacher -> surnames }}</label>
								<input type="text" id="teacherSurnames" class="" placeholder="Apellidos" value="{{ $teacher -> surnames }}" style="display:none;">
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
								<label id="teacherPhoneLabel">{{ $teacher -> phone }}</label>
								<input type="text" id="teacherPhone" class="" placeholder="Teléfono" value="{{ $teacher -> phone }}" style="display:none;">
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
								<label id="teacherEmailLabel">{{ $teacher -> email }}</label>
								<input type="text" id="teacherEmail" class="" placeholder="Correco electrónico" value="{{ $teacher -> email }}" style="display:none;">
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
								<label id="teacherAddressLabel">{{ $teacher -> address }}</label>
								<input type="text" id="teacherAddress" class="" placeholder="Dirección" value="{{ $teacher -> address }}" style="display:none;">
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
								<label id="teacherLocationLabel">{{ $teacher -> location }}</label>
								<input type="text" id="teacherLocation" class="" placeholder="Ciudad" value="{{ $teacher -> location }}" style="display:none;">
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
								<label id="teacherProvinceLabel">{{ $teacher -> province }}</label>
								<input type="text" id="teacherProvince" class="" placeholder="Provincia" value="{{ $teacher -> province }}" style="display:none;">
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
								<label id="teacherPostalCodeLabel">{{ $teacher -> postal_code }}</label>
								<input type="text" id="teacherPostalCode" class="" placeholder="Código postal" value="{{ $teacher -> postal_code }}" style="display:none;">
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

							<div class="col-md-9">
								<label id="preceptorLabel">
									@if ($is_preceptor === true)
										Este profesor es el tutor del grupo
									@else
										Este profesor no es el tutor del grupo
									@endif
								</label>

								<div id="preceptorForm" class="form-check" style="display:none;">
									@if ($is_preceptor === true)
										<input id="preceptor" class="form-check-input" type="checkbox" value="" onclick="addPreceptor()" checked>
									@else
										<input id="preceptor" class="form-check-input" type="checkbox" value="" onclick="addPreceptor()">
									@endif

									<label class="form-check-label" for="massive">
										Asignar como tutor del curso
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div id="errorPreceptor" class="alert alert-danger" style="display:none;">
						</div>
					</div>
				</div>

				@if ($is_preceptor === true)
					<div id="preceptorData" class="row">
				@else
					<div id="preceptorData" class="row" style="display: none">
				@endif

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="col-md-3">
								<label>Curso</label>
							</div>

							<div class="col-md-4">
								@if ($is_preceptor === true)
									<label id="courseLabel">{{ $course_default -> number }} {{ $course_default -> degree }}</label>

									<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')" style="display:none;">
										<option disabled="disabled" selected="selected">Seleccione un curso</option>

										@foreach($courses as $course)
											@if ($course -> id === $course_default -> id)
												<option value="{{ $course -> id }}" selected="selected">{{ $course -> number }} {{ $course -> degree }}</option>
											@else
												<option value="{{ $course -> id }}">{{ $course -> number }} {{ $course -> degree }}</option>
											@endif
										@endforeach
									</select>
								@else
									<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')" style="display:none;">
										<option disabled="disabled" selected="selected">Seleccione un curso</option>

										@foreach($courses as $course)
											<option value="{{ $course -> id }}">{{ $course -> number }} {{ $course -> degree }}</option>
										@endforeach
									</select>
								@endif
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
								@if ($is_preceptor === true)
									<label id="groupLabel">{{ $group_default }}</label>

									<select id="group" style="display:none;">
										<option disabled="disabled" selected="selected">Seleccione un grupo</option>

										@foreach($groups as $group)
											@if ($group === $group_default)
												<option value="{{ $group }}" selected="selected">{{ $group }}</option>
											@else
												<option value="{{ $group }}">{{ $group }}</option>
											@endif
										@endforeach
									</select>
								@else
									<select id="group" style="display:none;">
										<option disabled="disabled" selected="selected">Seleccione un grupo</option>
									</select>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5>Datos de las asignaturas</h5>

			<div id="subjectsFields" class="row">
				<div id="selectsSubjects" class="row">
					@php
						$contador = 0;
					@endphp

					@foreach($subjects_impart as $subject_impart)
						<div id="addSubjectContent{{ $contador }}" class="row">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-2">
										</div>

										<div class="col-md-3">
											<label>Course</label>
										</div>

										<div class="col-md-4">
											<label id="courseLabel{{ $contador }}">{{ $subject_impart['course'] -> number }} {{ $subject_impart['course'] -> degree }}</label>

											<select id="course{{ $contador }}" class="col-md-4" onchange="validateCourseForSubject('{{ $school }}', '{{ $person }}', '{{ $type_user }}', '{{ $contador }}')" style="display:none;">
												<option disabled="disabled">Seleccione un curso</option>

												@foreach($courses as $course)
													@if ($course -> id === $subject_impart['course'] -> id)
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

										<div class="col-md-3">
											<label>Group</label>
										</div>

										<div class="col-md-4">
											<label id="groupLabel{{ $contador }}">{{ $subject_impart['group'] }}</label>

											<select id="group{{ $contador }}" class="col-md-4" onchange="validateGroupForSubject('{{ $school }}', '{{ $person }}', '{{ $type_user }}', '{{ $contador }}')" style="display:none;">
												<option disabled="disabled">Seleccione un grupo</option>

												@foreach($subject_impart['groups'] as $group)
													@if ($group === $subject_impart['group'])
														<option value="{{ $group }}" selected="selected">{{ $group }}</option>
													@else
														<option value="{{ $group }}">{{ $group }}</option>
													@endif
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-2">
										</div>

										<div class="col-md-3">
											<label>Asignatura</label>
										</div>

										<div class="col-md-4">
											<label id="subjectLabel{{ $contador }}">{{ $subject_impart['subject'] -> name }}</label>

											<select id="subject{{ $contador }}" name="subject"  onchange="changeSubject('{{ $contador }}')" style="display:none;">
												<option disabled="disabled">Seleccione una asignatura</option>

												@foreach($subject_impart['subjects'] as $subject)
													@if ($subject -> code === $subject_impart['subject'] -> code)
														<option value="{{ $subject -> code }}" selected="selected">{{ $subject -> name }}</option>
													@else
														<option value="{{ $subject -> code }}">{{ $subject -> name }}</option>
													@endif
												@endforeach
											</select>
										</div>
									</div>
								</div>

								<div id="validationOptions{{ $contador }}" class="col-md-6" style="display:none;">
									<div class="row">
										<div class="col-md-2">
										</div>

										<div class="col-md-2">
											<button id="validate{{ $contador }}" class="btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Validar asignatura" onclick="validateSubject('{{ $contador }}', '{{ $teacher -> id }}')">
												<i class="fas fa-circle-check"></i>
											</button>
										</div>

										<div class="col-md-2">
											<button id="cancel{{ $contador }}" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Cancelar" onclick="cancelSubject('{{ $contador }}')">
												<i class="fas fa-circle-xmark"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						@php
							$contador ++;
						@endphp
					@endforeach

					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-2">
							<a id="addSubject" class="enlace" onclick="addSubject('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')" style="display:none;">
								<i class="fas fa-plus-circle"></i> Añadir asignatura
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<button id="edit" class="btn btn-primary" onclick="edit()">
					Editar
				</button>

				<div id="saveOptions" class="row" style="display: none">
					<div class="col-md-5">
					</div>

					<div class="col-md-1">
						<button id="save" class="btn btn-primary" onclick="save('{{ $teacher -> id }}', '{{ $type_user }}')">
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

	<script src="{{ asset('js/teachers.js') }}"></script>
@endsection