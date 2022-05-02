@extends('layouts.master')
@section('title', 'Inicio')
@section('content')
	@if ($type_user === 'Teacher')
		<div id="teacherButtons" class="container">
			<div class="row">
				<div class="col-md-4">
					<button id="subjectsButton" class="btn btn-lg btn-primary" onclick="subjects('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-book"></i>
							<p>Asignaturas</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					@if ($teacher -> preceptor == '1')
						<button id="studentsButton" class="btn btn-lg btn-primary" onclick="students('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', '{{ $teacher -> preceptor }}')">
					@else
						<button id="studentsButton"  disabled="disabled" class="btn btn-lg btn-primary">
					@endif

						<div class="row">
							<i class="fas fa-address-book"></i>
							<p>Alumnos</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="messagesButton" class="btn btn-lg btn-primary" onclick="messages('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-envelope"></i>
							<label id="newMessages" style="display: none"></label>
							<p>Mensajes</p>
						</div>
					</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<button id="calendarButton" class="btn btn-lg btn-primary" onclick="calendar('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-calendar-alt"></i>
							<label id="checkEvents" style="display: none"></label>
							<p>Calendario</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="alertsButton" class="btn btn-lg btn-primary" onclick="alerts('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-bell"></i>
							<label id="readAlerts" style="display: none"></label>
							<p>Enviar alerta</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="helpButton" class="btn btn-lg btn-primary" onclick="help('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-question"></i>
							<p>Ayuda</p>
						</div>
					</button>
				</div>
			</div>
		</div>
	@elseif ($type_user === "Manager")
		<div id="managersButtons" class="container">
			<div class="row">
				<div class="col-md-4">
					<button id="teachersButton" class="btn btn-lg btn-primary" onclick="teachers('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-address-book"></i>
							<p>Profesores</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="studentsButton" class="btn btn-lg btn-primary" onclick="students('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', '0')">
						<div class="row">
							<i class="fas fa-address-book"></i>
							<p>Alumnos</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="messagesButton" class="btn btn-lg btn-primary" onclick="messages('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-envelope"></i>
							<label id="newMessages" style="display: none"></label>
							<p>Mensajes</p>
						</div>
					</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<button id="calendarButton" class="btn btn-lg btn-primary" onclick="calendar('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-calendar-alt"></i>
							<label id="checkEvents" style="display: none"></label>
							<p>Calendario</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="alertsButton" class="btn btn-lg btn-primary" onclick="alerts('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-bell"></i>
							<label id="readAlerts" style="display: none"></label>
							<p>Enviar alerta</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="helpButton" class="btn btn-lg btn-primary" onclick="help('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-question"></i>
							<p>Ayuda</p>
						</div>
					</button>
				</div>
			</div>
		</div>
	@elseif ($type_user === "Admin")
		<div id="adminButtons" class="container">
			<div class="row">
				<div class="col-md-4">
					<button id="studentsButton" class="btn btn-lg btn-primary" onclick="students('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-address-book"></i>
							<p>Alumnos</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="teachersButton" class="btn btn-lg btn-primary" onclick="teachers('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-address-book"></i>
							<p>Profesores</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="managersButton" class="btn btn-lg btn-primary" onclick="managers('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-address-book"></i>
							<p>Directivos</p>
						</div>
					</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<button id="messagesButton" class="btn btn-lg btn-primary" onclick="messages('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-envelope"></i>
							<label id="newMessages" style="display: none"></label>
							<p>Mensajes</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="calendarButton" class="btn btn-lg btn-primary" onclick="calendar('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-calendar-alt"></i>
							<label id="checkEvents" style="display: none"></label>
							<p>Calendario</p>
						</div>
					</button>
				</div>

				<div class="col-md-4">
					<button id="helpButton" class="btn btn-lg btn-primary" onclick="help('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
						<div class="row">
							<i class="fas fa-question"></i>
							<p>Ayuda</p>
						</div>
					</button>
				</div>
			</div>
		</div>
	@else
		<div id="welcomeMessage" class="container">
			<div class="row">
				<div class="col-md-3">
				</div>

				<div class="col-md-6">
					<h1>Bienvenido a la aplicación de School Manager</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
				</div>

				<div class="col-md-6">
					<h2>Por favor, haga login para continuar</h2>
				</div>
			</div>
		</div>
	@endif

	<script src="{{ asset('js/home.js') }}"></script>

	@if ($type_user !== '')
		<script type="text/javascript">
			window.onload = function() {
				loadNewMessages('{{ $person -> id }}');
				loadEventDay('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}');
				loadReadAlerts('{{ $person -> id }}');
			}
		</script>
	@endif
@endsection