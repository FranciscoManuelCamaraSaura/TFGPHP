@extends('layouts.master')

@if($send === true)
	@section('title', 'Mensaje enviado')
	@section('content')
@else
	@section('title', 'Mensaje recibido')
	@section('content')
@endif
	<div id="message" class="container">
		@if($send === true)
			<h2>Mensaje enviado</h2>
		@else
			<h2>Mensaje recibido</h2>
		@endif

		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-5">
				<div class="row">
					<div class="col-md-4">
						@if($send === true)
							<label>Destinatario</label>
						@else
							<label>Emisor</label>
						@endif
					</div>

					<div class="col-md-6">
						<label>{{ $student_message -> name }} {{ $student_message -> surnames }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label>Fecha y hora</label>
					</div>

					<div class="col-md-6">
						<label>{{ $message -> date }}</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
			</div>

			<div class="col-md-5">
				<div class="row">
					<div class="col-md-4">
						<label>Asunto del mensaje</label>
					</div>

					<div class="col-md-6">
						<label id="matter">{{ $message -> matter }}</label>
					</div>
				</div>
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
				<label id="messageTextArea">{{ $message -> text }}</label>
			</div>

			@if($send === true)
				<div class="col-md-2">
					<p>
						<button id="delete" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							Borrar
						</button>
					</p>

					<p>
						<button id="back" class="btn btn-primary" onclick="window.history.back()">
							Volver
						</button>
					</p>
				</div>
			@else
				<div class="col-md-2">
					<p>
						<button id="reply" class="btn btn-primary" onclick="replyMessage('{{ $school }}', '{{ $person -> id }}', '{{ $message -> id }}', '{{ $type_user }}', '3')">
							Responder
						</button>
					</p>

					<p>
						<button id="delete" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							Borrar
						</button>
					</p>

					<p>
						<button id="back" class="btn btn-primary" onclick="window.history.back()">
							Volver
						</button>
					</p>
				</div>
			@endif

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
		</div>
	</div>

	<script src="{{ asset('js/messages.js') }}"></script>
@endsection