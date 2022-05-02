@extends('layouts.master')
@section('title', 'Mensajes')
@section('content')
	<div id="messagesButtons" class="container">
		<h2>Mensajes</h2>

		<div class="row">
			<div class="col-md-3">
				<button id="newMessageButton" class="btn btn-lg btn-primary" onclick="newMessage('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', '1')">
					<div class="row">
						<i class="fas fa-plus-square"></i>
						<p>Nuevo mensaje</p>
					</div>
				</button>
			</div>

			<div class="col-md-3">
				<button id="messagesSentButton" class="btn btn-lg btn-primary" onclick="messagesSent('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-envelope"></i>
						<p>Mensajes enviados</p>
					</div>
				</button>
			</div>

			<div class="col-md-3">
				<button id="messagesReceivedButton" class="btn btn-lg btn-primary" onclick="messagesReceived('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-envelope-open"></i>
						<p>Mensajes recibidos</p>
					</div>
				</button>
			</div>

			<div class="col-md-3">
				<button id="messagesDeletedButton" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					<div class="row">
						<i class="fas fa-trash-alt"></i>
						<p>Mensajes borrados</p>
					</div>
				</button>
			</div>

			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Aviso legal</h5>

							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							La política actual de la aplicación impide que se realice el borrado de mensajes, tanto enviados como recibidos.
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

	<script src="{{ asset('js/messages.js') }}"></script>
@endsection