@extends('layouts.master')
@section('title', 'Listado de eventos')
@section('content')
	<div id="eventItem" class="container">
		<h2>Evento</h2>

		<div class="row">
			<div class="col-md-4">
			</div>

			<div class="col-md-4">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		@if($is_exam === true)
			<div id="examData">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Fecha</label>
							</div>

							<div class="col-md-4">
								<label id="dateExamLabel">{{ $event -> date }}</label>

								<div id="datepickerExam" class="input-group date" data-provide="datepicker" style="display: none">
									<input id="datepickerInput" class="form-control" type="text" />
									<button class="btn btn-primary">
										<i class="fas fa-calendar-alt"></i>
									</button>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Curso</label>
							</div>

							<div class="col-md-4">
								<label id="curseExamLabel">{{ $course -> number }} {{ $course -> degree }}</label>

								<select id="course" class="col-md-4" style="display: none" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
									<option disabled="disabled">Seleccione un curso</option>

									@foreach ($courses as $course)
										@if($exam -> course_id === $course -> id )
											<option value="{{ $course -> id }}" selected="selected">{{ $course -> number }} de {{ $course -> degree }}</option>
										@else
											<option value="{{ $course -> id }}">{{ $course -> number }} de {{ $course -> degree }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Grupo</label>
							</div>

							<div class="col-md-4">
								<label id="groupExamLabel">{{ $exam -> group_words }}</label>

								<select id="group" class="col-md-4" style="display: none" onchange="validateGroup('{{ $school }}', '{{ $person -> id }}')">
									<option disabled="disabled">Seleccione un grupo</option>
									<option value="{{ $exam -> group_words }}" selected="selected">{{ $exam -> group_words }}</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Asignatura</label>
							</div>

							<div class="col-md-4">
								<label id="subjectExamLabel">{{ $subject_default -> name }}</label>

								<select id="subjects" class="col-md-4" style="display: none">
									<option disabled="disabled" selected="selected">Seleccione una asignatura</option>

									@foreach ($subjects as $subject)
										@if($subject_default -> code === $subject -> code )
											<option value="{{ $subject_default -> code }}" selected="selected">{{ $subject_default -> name }}</option>
										@else
											<option value="{{ $subject -> code }}">{{ $subject -> name }}</option>
										@endif
									@endforeach
									
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Título del evento</label>
							</div>

							<div class="col-md-5">
								<label id="nameExamLabel">{{ $event -> name }}</label>
								<input type="text" id="nameExam" class="" placeholder="Título del evento" value="{{ $event -> name }}" style="display: none">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Tipo de examen</label>
							</div>

							<div id="typeExamExamLabel" class="col-md-4">
								<label>{{ $type_exam }}</label>
							</div>

							<div id="typeExamForm" class="col-md-4" style="display: none">
								<div class="form-check">
									<input id="written" type="radio" class="form-check-input" name="typeExam" value="written">
									<label class="form-check-label" for="written">Escrito</label>
								</div>

								<div class="form-check">
									<input id="oral" type="radio" class="form-check-input" name="typeExam" value="oral">
									<label class="form-check-label" for="oral">Oral</label>
								</div>

								<div class="form-check">
									<input id="presentation" type="radio" class="form-check-input" name="typeExam" value="presentation">
									<label class="form-check-label" for="presentation">Presentación</label>
								</div>

								<div class="form-check">
									<input id="exhibition" type="radio" class="form-check-input" name="typeExam" value="exhibition">
									<label class="form-check-label" for="exhibition">Expoxición</label>
								</div>

								<div class="form-check">
									<input id="optional_work" type="radio" class="form-check-input" name="typeExam" value="optional_work">
									<label class="form-check-label" for="optional_work">Trabajo adicional</label>
								</div>

								<div class="form-check">
									<input id="homework" type="radio" class="form-check-input" name="typeExam" value="homework">
									<label class="form-check-label" for="homework">Deberes</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Evaluación</label>
							</div>

							<div class="col-md-4">
								<label id="evaluationExamLabel">{{ $evaluation }}</label>

								<select id="evaluationSelect" class="col-md-4" style="display: none">
									<option disabled="disabled" selected="selected">Seleccione una evaluación</option>
									@if ($exam -> evaluation == 'first_trimester')
										<option value="{{ $exam -> evaluation }}" selected="selected">Primer trimestre</option>
										<option value="second_trimester">Segundo trimestre</option>
										<option value="third_trimester">Tercer trimestre</option>
									@elseif ($exam -> evaluation == 'second_trimester')
										<option value="first_trimester">Primer trimestre</option>
										<option value="{{ $exam -> evaluation }}" selected="selected">Segundo trimestre</option>
										<option value="third_trimester">Tercer trimestre</option>
									@else
										<option value="first_trimester">Primer trimestre</option>
										<option value="second_trimester">Segundo trimestre</option>
										<option value="{{ $exam -> evaluation }}" selected="selected">Tercer trimestre</option>
									@endif
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Descripción del evento</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-8">
						<label id="descriptionExamLabel">{{ $event -> description }}</label>
						<textarea id="descriptionExamTextArea" rows="6" placeholder="Introduce la descripción del evento." value="{{ old('descriptionExamTextArea') }}" style="display: none">{{ $event -> description }}</textarea>
					</div>

					<div class="col-md-1">
					</div>

					<div class="col-md-2">
						<p>
							<button id="updateExamButton" class="btn btn-primary" onclick="update('{{ $event -> date }}', '{{ $exam -> type_exam }}', '{{ $is_exam }}')">
								Editar
							</button>

							<button id="saveExamButton" class="btn btn-primary" onclick="updateEvent('{{ $school }}', '{{ $person -> id }}', '{{ $event -> id }}', '{{ $exam -> id }}', '{{ $is_exam }}')" style="display: none">
								Guardar
							</button>
						</p>

						<p>
							<button id="backExamButton" class="btn btn-primary" onclick="window.history.back()">
								Volver
							</button>

							<button id="cancelExamButton" class="btn btn-primary" onclick="cancelEdition('{{ $is_exam }}')" style="display: none">
								Cancelar
							</button>
						</p>
					</div>
				</div>
			</div>
		@else
			<div id="eventData">
				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-3">
						<label>Fecha</label>
					</div>

					<div class="col-md-4">
						<label id="dateEventLabel">{{ $event -> date }}</label>

						<div id="datepickerEvent" class="input-group date" data-provide="datepicker" style="display: none">
							<input id="datepickerInput" class="form-control" type="text" />
							<button class="btn btn-primary">
								<i class="fas fa-calendar-alt"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-3">
						<label>Título del evento</label>
					</div>

					<div class="col-md-4">
						<label id="nameEventLabel">{{ $event -> name }}</label>
						<input type="text" id="nameEvent" class="" placeholder="Título del evento" value="{{ $event -> name }}" style="display: none">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-3">
						<label>Duración del evento</label>
					</div>

					<div class="col-md-4">
						<label id="timeLabel">{{ $event -> duration }}</label>
						<input type="number" id="timeEvent" min="1" max="6" class="" placeholder="Duración del evento" value="{{ $event -> duration }}" style="display: none">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Descripción del evento</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-8">
						<label id="descriptionEventLabel">{{ $event -> description }}</label>
						<textarea id="descriptionEventTextArea" rows="6" placeholder="Introduce la descripción del evento." value="{{ old('descriptionEventTextArea') }}" style="display: none">{{ $event -> description }}</textarea>
					</div>

					<div class="col-md-2">
						<p>
							<button id="updateEventButton" class="btn btn-primary" onclick="update('{{ $event -> date }}', '{{ $exam -> type_exam }}', '{{ $is_exam }}')">
								Editar
							</button>

							<button id="saveEventButton" class="btn btn-primary" onclick="updateEvent('{{ $school }}', '{{ $person -> id }}', '{{ $event -> id }}', '{{ $exam -> id }}', '{{ $is_exam }}')" style="display: none">
								Guardar
							</button>
						</p>

						<p>
							<button id="backEventButton" class="btn btn-primary" onclick="window.history.back()">
								Volver
							</button>

							<button id="cancelEventButton" class="btn btn-primary" onclick="cancelEdition('{{ $is_exam }}')" style="display: none">
								Cancelar
							</button>
						</p>
					</div>
				</div>
			</div>
		@endif
	</div>

	<script src="{{ asset('js/events.js') }}"></script>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.es.js') }}"></script>
	<script type="text/javascript">
		window.onload = function() {
			createDataPicker();
		}
	</script>
@endsection
