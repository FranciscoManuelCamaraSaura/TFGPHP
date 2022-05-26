@extends('layouts.master')
@section('title', 'Alumno')
@section('content')
	<div id="studentFile" class="container">
		<h2>Ficha de la alumno</h2>

		<div class="row">
			<div class="col-md-2">
				<!--<img src="{{ asset('images') }}" alt="" />-->
			</div>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-4">
						<label id="nameTitle">Nombre</label>
					</div>

					<div class="col-md-8">
						<label id="nameLabel">{{ $student -> name }} {{ $student -> surnames }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="ageTitle">Edad</label>
					</div>

					<div class="col-md-8">
						<label id="ageLabel">{{ $student -> birthday }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="addressTitle">Dirección</label>
					</div>

					<div class="col-md-8">
						<label id="addressLabel">{{ $legal_guardian -> address }}, {{ $legal_guardian -> location }} ( {{ $legal_guardian -> province }})</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="phoneTitle">Teléfono</label>
					</div>

					<div class="col-md-8">
						<label id="phoneLabel">{{ $student -> phone }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label id="mailTitle">Correo Electrónico</label>
					</div>

					<div class="col-md-8">
						<label id="mailLabel">{{ $legal_guardian -> email }}</label>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-5">
						<label id="contactTitle">Contacto</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="messageTitle">Enviar mensaje</label>
					</div>

					<div class="col-md-5">
						<button id="sendMessageButton" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Enviar mensaje" onclick="sendMessage('{{ $school }}', '{{ $person -> id }}', '{{ $subject }}', '{{ $student -> id }}', '{{ $type_user }}', '2')">
							<i class="fas fa-envelope"></i>
						</button>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="alertTitle">Enviar alerta</label>
					</div>

					<div class="col-md-5">
						<button id="sendAlertButton" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Enviar alerta" onclick="sendAlert('{{ $school }}', '{{ $person -> id }}', '{{ $subject }}', '{{ $student -> id }}', '{{ $type_user }}')">
							<i class="fas fa-bell"></i>
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
	<script type="text/javascript">
		window.onload = function() {
			var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});
		}
	</script>
@endsection