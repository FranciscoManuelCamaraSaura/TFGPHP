@extends('layouts.master')
@section('title', 'Listado de eventos')
@section('content')
	<div id="editEvent" class="container">
		<h2>Editar evento</h2>

		<div id="eventsTable">
			<h5>Eventos generales</h5>

			@if (count($event_not_exam) == 0)
				<div class="row">
					<div class="col-md-3">
					</div>

					<div class="col-md-6">
						<div id="error" class="alert alert-danger">
							<label>Aun no ha creado ningún evento, cuando lo haga aparecerán aquí.</label>
						</div>
					</div>
				</div>
			@else
				<div class="row" id="eventsTableHead">
					<div class="col-md-1">
					</div>

					<div class="col-md-2">
						<label>Fecha</label>
					</div>

					<div class="col-md-2">
						<label>Título</label>
					</div>

					<div class="col-md-2">
					</div>

					<div class="col-md-1">
					</div>

					<div class="col-md-3">
						<label>Opciones</label>
					</div>
				</div>

				@foreach($event_not_exam as $event)
					<div class="row" id="eventsTableBody">
						<div class="col-md-1">
						</div>

						<div class="col-md-2">
							<label>{{ $event -> date }}</label>
						</div>

						<div class="col-md-2">
							<label>{{ $event -> name }}</label>
						</div>

						<div class="col-md-2">
						</div>

						<div class="col-md-1">
						</div>

						<div class="col-md-3">
							<div class="row">
								<div class="col-md-6">
									<button id="edit" class="btn btn-primary" onclick="editEvent('{{ $school }}', '{{ $person -> id }}', '{{ $event -> id }}', '{{ $type_user }}')">
										Editar
									</button>
								</div>

								<div class="col-md-6">
									<button id="delete" class="btn btn-primary" onclick="deleteEvent('{{ $event -> id }}')">
										Eliminar
									</button>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>

		@if($type_user === "Teacher")
			<div id="examsTable">
				<h5>Examenes</h5>

				@if (count($event_exam) == 0)
					<div class="row">
						<div class="col-md-3">
						</div>

						<div class="col-md-6">
							<div id="error" class="alert alert-danger">
								<label>Aun no ha creado ningún examen, cuando lo haga aparecerán aquí.</label>
							</div>
						</div>
					</div>
				@else
					<div class="row" id="examsTableHead">
						<div class="col-md-1">
						</div>

						<div class="col-md-2">
							<label>Fecha</label>
						</div>

						<div class="col-md-2">
							<label>Título</label>
						</div>

						<div class="col-md-3">
							<div class="row">
								<div class="col-md-4">
									<label>Curso</label>
								</div>

								<div class="col-md-2">
									<label>Grupo</label>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<label>Opciones</label>
						</div>
					</div>

					@php
						$contador = 0;
					@endphp

					@foreach($event_exam as $event)
						@foreach($exams as $exam)
							@if($event -> id == $exam -> event)
								<div class="row" id="examsTableBody">
									<div class="col-md-1">
									</div>

									<div class="col-md-2">
										<label>{{ $event -> date }}</label>
									</div>

									<div class="col-md-2">
										<label>{{ $event -> name }}</label>
									</div>

									<div class="col-md-3">
										<div class="row">
											<div class="col-md-4">
												<label>{{ $courses[$contador] }}</label>
											</div>

											<div class="col-md-2">
												<label>{{ $exam -> group_words }}</label>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="row">
											<div class="col-md-4">
												<button id="edit" class="btn btn-primary" onclick="editEvent('{{ $school }}', '{{ $person -> id }}', '{{ $event -> id }}', '{{ $type_user }}')">
													Editar
												</button>
											</div>

											<div class="col-md-4">
												<button id="evalue" class="btn btn-primary" onclick="evalueExam('{{ $school }}', '{{ $person -> id }}', '{{ $exam -> id }}', '{{ $type_user }}')">
													Evaluar
												</button>
											</div>

											<div class="col-md-4">
												<button id="delete" class="btn btn-primary" onclick="deleteExam('{{ $exam -> id }}')">
													Eliminar
												</button>
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach

						@php
							$contador ++;
						@endphp
					@endforeach
				@endif
			</div>
		@endif

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