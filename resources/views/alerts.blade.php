@extends('layouts.master')
@section('title', 'Alertas')
@section('content')
	<div id="alerts" class="container">
		<h2>Alertas</h2>

		<div class="row">
				<div class="col-md-3">
				</div>

				<div class="col-md-6">
					<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div id="alertsForm">
			<div class="row">
				<div class="col-md-3">
				</div>

				<div class="col-md-1">
					<label>Curso</label>
				</div>

				<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					@if($course_default === "")
						<option disabled="disabled" selected="selected">Seleccione un curso</option>
					@else
						<option disabled="disabled">Seleccione un curso</option>
					@endif

					@foreach($courses as $course)
						@if($course_default === $course -> id)
							<option value="{{ $course -> id }}" selected="selected">{{ $course -> number }} {{ $course -> degree }}</option>
						@else
							<option value="{{ $course -> id }}">{{ $course -> number }} {{ $course -> degree }}</option>
						@endif
					@endforeach
				</select>

				<div class="col-md-1">
					<label>Grupo</label>
				</div>

				<select id="group" onchange="validateGroup('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					@if($group_default === "")
						<option disabled="disabled" selected="selected">Seleccione un grupo</option>
					@else
						<option disabled="disabled">Seleccione un grupo</option>
					@endif

					@foreach($groups as $group)
						@if($group_default === $group -> group_words)
							<option value="{{ $group -> group_words }}" selected="selected">{{ $group -> group_words }}</option>
						@else
							<option value="{{ $group -> group_words }}">{{ $group -> group_words }}</option>
						@endif
					@endforeach
				</select>
			</div>

			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-3">
						</div>

						<div class="col-md-2">
							<label>Asignatura</label>
						</div>

						<select id="subjects" class="col-md-3" onchange="validateSubject('{{ $school }}', '{{ $person -> id }}')">
							@if($subject_default === "")
								<option disabled="disabled" selected="selected">Seleccione una asignatura</option>
							@else
								<option disabled="disabled">Seleccione una asignatura</option>
							@endif

							@foreach($subjects as $subject)
								@if($subject_default === $subject -> code )
									<option value="{{ $subject -> code }}" selected="selected">{{ $subject -> name }}</option>
								@else
									<option value="{{ $subject -> code }}">{{ $subject -> name }}</option>
								@endif
							@endforeach
						</select>
					</div>

					<div class="row">
						<div class="col-md-3">
						</div>

						<div class="col-md-2">
							<label>Alumno</label>
						</div>

						<select id="students" class="col-md-3">
							@if($student === "")
								<option disabled="disabled" selected="selected">Seleccione un alumno</option>
							@else
								<option disabled="disabled" value="{{ $student -> id }}" selected="selected">{{ $student -> name }} {{ $student -> name }}</option>
							@endif
						</select>

						<div class="col-md-1">
						</div>

						<div class="form-check col-md-2">
							<input id="massive" class="form-check-input" type="checkbox" value="">
							<label class="form-check-label" for="massive">
								Alerta masiva
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
						</div>

						<div class="col-md-2">
							<label>Asunto</label>
						</div>

						<div class="col-md-5">
							<input type="text" id="matter" class="" placeholder="Título del mensaje" value="{{ old('matter') }}">
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="row">
						<div class="col-md-12">
							<button id="send" class="btn btn-primary" onclick="send('{{ $school }}', '{{ $person -> id }}')">
								Enviar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		@if(count($alerts_sent) > 0)
			<div class="row" id="alertsTablehead">
				<div class="col-md-1">
				</div>

				<div class="col-md-3">
					<label>Alertas enviadas</label>
				</div>

				<div class="col-md-1">
				</div>

				<div class="col-md-3">
					<label>Alertas leidas</label>
				</div>

				<div class="col-md-1">
				</div>

				<div class="col-md-3">
					<label></label>
				</div>
			</div>

			<div id="alertsTableBody">
				@foreach($alerts_sent as $alert)
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-2">
								</div>

								<div class="col-md-8">
									<label>Alumno: {{ $alert['student'] }}</label>
								</div>

								<div class="col-md-2">
								</div>
							</div>

							<div class="row">
								<div class="col-md-2">
								</div>

								<div class="col-md-8">
									<label>Asunto: {{ $alert['matter'] }}</label>
								</div>

								<div class="col-md-2">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="row">
								@if($alert["read"] === true)
									<div class="col-md-6 form-check">
										<input class="form-check-input" type="checkbox" value="" checked disabled>Leida
									</div>
								@else
									<div class="col-md-6 form-check">
										<input class="form-check-input" type="checkbox" value="" disabled>Leida
									</div>
								@endif

								<div class="col-md-2">
									@php
										$alert_id = $alert['alert'];
									@endphp

									<button id="delete" class="btn btn-primary" onclick="deleteAlert('{{ $alert_id }}')">
										Eliminar
									</button>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row" id="errorContent">
				<div class="col-md-3">
				</div>

				<div class="col-md-6">
					<div id="error" class="alert alert-danger">
						<label>Aun no ha enviado ninguna alerta, cuando lo haga aparecerán aquí.</label>
					</div>
				</div>
			</div>
		@endif

		<div class="row">
			<div class="col-md-2">
				<button id="back" class="btn btn-primary" onclick="window.history.back()">
					Volver
				</button>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/alerts.js') }}"></script>
@endsection