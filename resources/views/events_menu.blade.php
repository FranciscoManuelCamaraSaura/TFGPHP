@extends('layouts.master')
@section('title', 'Eventos')
@section('content')
	<div id="eventsButtons" class="container">
		<h2>Calendario</h2>

		<div class="row">
			<div class="col-md-3">
				<button id="timetableButton" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					<div class="row">
						<i class="fas fa-calendar-week"></i>
						<p>Mostrar horario</p>
					</div>
				</button>
			</div>

			<div class="col-md-3">
				<button id="calendarButton" class="btn btn-lg btn-primary" onclick="calendar('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
							<i class="fas fa-calendar-alt"></i>
						<p>Mostrar calendario</p>
					</div>
				</button>
			</div>

			<div class="col-md-3">
				<button id="addEventButton" class="btn btn-lg btn-primary" onclick="addEvent('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-calendar-plus"></i>
						<p>Añadir evento</p>
					</div>
				</button>
			</div>

			<div class="col-md-3">
				<button id="editEventdButton" class="btn btn-lg btn-primary" onclick="editEvents('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-calendar-day"></i>
						<p>Editar evento</p>
					</div>
				</button>
			</div>

			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Horario semanal</h5>

							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							Esta funcionalidad no se encuentra disponible en este momento debido a la política del centro.
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
								Cerrar
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
	</div>

	<script src="{{ asset('js/events.js') }}"></script>
@endsection