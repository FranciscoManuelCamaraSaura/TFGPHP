@extends('layouts.master')
@section('title', 'Evaluación')
@section('content')
	<div id="evaluation" class="container">
		<h2>Evaluación del examen</h2>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-3">
				<label id="subjectName">{{ $subject -> name }}</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-3">
				<label id="descriptionTitle">Descripción</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-5">
				<label id="descriptionContent">{{ $subject -> description }}</label>
			</div>
		</div>

		<div id="studentsTable" class="row">
			<h5>Alumnos</h5>

			<div class="row">
				<div class="col-md-1">
				</div>

				<div class="col-md-2">
					<label>Nombre</label>
				</div>

				<div class="col-md-2">
					<label>Apellidos</label>
				</div>

				<div class="col-md-1">
					</div>

				<div class="col-md-1">
					<label>Nota</label>
				</div>
			</div>

			@foreach($evaluations as $student)
				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-2">
						<label>{{ $student['name'] }}</label>
					</div>

					<div class="col-md-2">
						<label>{{ $student['surnames'] }}</label>
					</div>

					<div class="col-md-1">
					</div>

					<div class="col-md-1">
						<label id="{{ $student['labelId'] }}" name="labelId" >{{ $student['note'] }}</label>
						<input type="number" id="{{ $student['id'] }}" name="inputId" value="{{ $student['note'] }}" min="0" max="10" step="0.01"  style="display: none">
					</div>
				</div>
			@endforeach
		</div>

		<div class="row">
			<div class="col-md-12">
				<button id="evalue" class="btn btn-primary" onclick="makeEvaluation()">
					Evaluar
				</button>
			</div>

			<div class="col-md-4">
			</div>

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6">
						<button id="saveExamButton" class="btn btn-primary" onclick="updateExamNotes('{{ $exam -> id }}')" style="display: none">
							Guardar
						</button>
					</div>

					<div class="col-md-6">
						<button id="cancelExamButton" class="btn btn-primary" onclick="cancelNotes()" style="display: none">
							Cancelar
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

	<script src="{{ asset('js/events.js') }}"></script>
@endsection