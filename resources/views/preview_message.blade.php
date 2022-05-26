@extends('layouts.master')
@section('title', 'Mensaje previo')
@section('content')
	<div id="previewMessage" class="container">
		<h2>Vista previa</h2>

		<div class="row">
			<div class="col-md-4">
				<!--<img src="{{ asset('images') }}" alt="" />-->
			</div>

			<div class="col-md-5">
				<div class="row">
					<div class="col-md-3">
						<label>Asignatura</label>
					</div>

					<div class="col-md-6">
						<label>{{ $subject -> name }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Alumno</label>
					</div>

					<div class="col-md-6">
						<label>{{ $student -> name }} {{ $student -> surnames }}</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-2">
				<label>Asunto</label>
			</div>

			<div class="col-md-4">
				<label id="matter">{{ $matter }}</label>
			</div>
		</div>

		<div class="row" id="messageLabel">
			<div class="col-md-1">
			</div>

			<div class="col-md-1">
				<label>Mensaje</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-8">
				<label id="messageTextArea">{{ $message }}</label>
			</div>

			<div class="col-md-2">
				<p>
					<button id="send" class="btn btn-primary" onclick="sendMessage('{{ $person -> dni }}', '{{ $student -> legal_guardian }}', '{{ $previous_message }}', '{{ $pantalla }}')">
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