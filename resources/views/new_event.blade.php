@extends('layouts.master')
@section('title', 'Nuevo evento')
@section('content')
	<div id="newEvent" class="container">
		<h2>Nuevo evento</h2>

		<div class="row">
			<div class="col-md-4">
			</div>

			<div class="col-md-4">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div id="radioButtonContent" class="row">
			<div class="col-md-4">
			</div>

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<label>Seleccione el tipo de evento</label>
					</div>
				</div>

				@if ($type_user === 'Teacher')
					<div class="form-check">
						<input id="exam" type="radio" class="form-check-input" name="typeEvent" value="exam">
						<label class="form-check-label" for="exam">Examen</label>
					</div>
				@endif

				<div class="form-check">
					<input id="event" type="radio" class="form-check-input" name="typeEvent" value="event">
					<label class="form-check-label" for="event">Evento general</label>
				</div>

				<div class="row">
					<div class="col-md-12">
						<button id="loginButton" class="btn btn-primary" onclick="showForm()">
							Siguiente
						</button>
					</div>
				</div>
			</div>
		</div>

		<div id="examData" style="display: none">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-2">
						</div>

						<div class="col-md-3">
							<label>Fecha</label>
						</div>

						<div id="datepickerExam" class="input-group date" data-provide="datepicker">
							<input id="datepickerInput" class="form-control" type="text" />
							<button class="btn btn-primary">
								<i class="fas fa-calendar-alt"></i>
							</button>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
						</div>

						<div class="col-md-3">
							<label>Curso</label>
						</div>

						<select id="course" class="col-md-4" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
							<option disabled="disabled" selected="selected">Seleccione un curso</option>

							@foreach ($courses as $course)
								<option value="{{ $course -> id }}">{{ $course -> number }} de {{ $course -> degree }}</option>
							@endforeach
						</select>
					</div>

					<div class="row">
						<div class="col-md-2">
						</div>

						<div class="col-md-3">
							<label>Grupo</label>
						</div>

						<select id="group" class="col-md-4" onchange="validateGroup('{{ $school }}', '{{ $person -> id }}')">
							<option disabled="disabled" selected="selected">Seleccione un grupo</option>
						</select>
					</div>

					<div class="row">
						<div class="col-md-2">
						</div>

						<div class="col-md-3">
							<label>Asignatura</label>
						</div>

						<select id="subjects" class="col-md-4">
							<option disabled="disabled" selected="selected">Seleccione una asignatura</option>
						</select>
					</div>

					<div class="row">
						<div class="col-md-2">
						</div>

						<div class="col-md-3">
							<label>Título del evento</label>
						</div>

						<div class="col-md-4">
							<input type="text" id="nameExam" class="" placeholder="Título del evento" value="{{ old('nameExam') }}">
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

						<div class="col-md-4">
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

						<select id="evaluationSelect" class="col-md-4">
							<option disabled="disabled" selected="selected">Seleccione una evaluación</option>
							<option value="first_trimester">Primer trimestre</option>
							<option value="second_trimester">Segundo trimestre</option>
							<option value="third_trimester">Tercer trimestre</option>
						</select>
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
					<textarea id="descriptionExamTextArea" rows="6" placeholder="Introduce la descripción del evento." value="{{ old('descriptionExamTextArea') }}"></textarea>
				</div>

				<div class="col-md-2">
					<p>
						<button id="saveButton" class="btn btn-primary" onclick="save('{{ $school }}', '{{ $person -> id }}')">
							Guardar
						</button>
					</p>

					<p>
						<button id="cancelButton" class="btn btn-primary" onclick="cancel()">
							Cancelar
						</button>
					</p>
				</div>
			</div>
		</div>

		<div id="eventData" style="display: none">
			<div class="row">
				<div class="col-md-2">
				</div>

				<div class="col-md-3">
					<label>Fecha</label>
				</div>

				<div id="datepickerEvent" class="input-group date" data-provide="datepicker">
					<input id="datepickerInput" class="form-control" type="text" />
					<button class="btn btn-primary">
						<i class="fas fa-calendar-alt"></i>
					</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
				</div>

				<div class="col-md-3">
					<label>Título del evento</label>
				</div>

				<div class="col-md-4">
					<input type="text" id="nameEvent" class="" placeholder="Título del evento" value="{{ old('nameEvent') }}">
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
				</div>

				<div class="col-md-3">
					<label>Duración del evento</label>
				</div>

				<div class="col-md-4">
					<input type="number" id="timeEvent" min="1" max="6" class="" placeholder="Duración del evento" value="{{ old('timeEvent') }}">
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
					<textarea id="descriptionEventTextArea" rows="6" placeholder="Introduce la descripción del evento." value="{{ old('descriptionEventTextArea') }}"></textarea>
				</div>

				<div class="col-md-2">
					<p>
						<button id="saveButton" class="btn btn-primary" onclick="save('{{ $school }}', '{{ $person -> id }}')">
							Guardar
						</button>
					</p>

					<p>
						<button id="cancelButton" class="btn btn-primary" onclick="cancel()">
							Cancelar
						</button>
					</p>
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

	<script src="{{ asset('js/events.js') }}"></script>
	<!--<script src="{{ asset('js/moment.min.js') }}"></script>-->
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.es.js') }}"></script>
	<!--<script src="{{ asset('js/bootstrap-timepicker.js') }}"></script>-->
	<!--<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>-->
	<script type="text/javascript">
		window.onload = function() {
			createDataPicker();
		}
	</script>
@endsection