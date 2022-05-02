@extends('layouts.master')
@section('title', 'Nuevo mensaje')
@section('content')
	<div id="newMessage" class="container">
		<h2>Nuevo mensaje</h2>

		<div class="row">
			<div class="col-md-4">
			</div>

			<div class="col-md-4">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-1">
				<label>Curso</label>
			</div>

			<select id="course" onchange="validateCourse('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
				@if($course_default === "")
					<option disabled="disabled" selected="selected">Seleccione una curso</option>
				@else
					<option disabled="disabled">Seleccione una curso</option>
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
			<div class="col-md-2">
			</div>

			<div class="col-md-3">
				<label>Asignatura</label>
			</div>

			<select id="subjects" class="col-md-4" onchange="validateSubject('{{ $school }}', '{{ $person -> id }}')">
				@if($subject_default === "")
					<option disabled="disabled" selected="selected">Seleccione una asignatura</option>
				@else
					<option disabled="disabled">Seleccione una asignatura</option>
				@endif

				@foreach($subjects as $subject)
					@if($subject_default === $subject -> code)
						<option value="{{ $subject -> code }}" selected="selected">{{ $subject -> name }}</option>
					@else
						<option value="{{ $subject -> code }}">{{ $subject -> name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-3">
				<label>Alumno</label>
			</div>

			<select id="students" class="col-md-4">
				@if($student === "")
					<option disabled="disabled" selected="selected">Seleccione un alumno</option>
				@else
					<option disabled="disabled" value="{{ $student -> id }}" selected="selected">{{ $student -> name }} {{ $student -> surnames }}</option>
				@endif
			</select>
		</div>

		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-3">
				<label>Asunto</label>
			</div>

			<div class="col-md-4">
				<input type="text" id="matter" class="" placeholder="Título del mensaje" value="{{ old('matter') }}">
			</div>
		</div>

		<div class="row" id="messageLabel">
			<div class="col-md-1">
			</div>

			<div class="col-md-2">
				<label>Mensaje</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-8">
				<textarea id="messageTextArea" rows="6" placeholder="Introduce el mensaje que deseeas enviar."></textarea>
			</div>

			<div class="col-md-2">
				<p>
					<button id="send" class="btn btn-primary" onclick="confirm('{{ $school }}', '{{ $person -> id }}', '{{ $previous_message }}', '{{ $type_user }}', '{{ $pantalla }}')">
						Enviar
					</button>
				</p>

				<p>
					<button id="cancel" class="btn btn-primary" onclick="window.history.back()">
						Cancelar
					</button>
				</p>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/messages.js') }}"></script>
@endsection