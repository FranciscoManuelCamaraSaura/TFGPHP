@extends('layouts.master')

@if($send === true)
	@section('title', 'Mensajes enviados')
	@section('content')
@else
	@section('title', 'Mensajes recibidos')
	@section('content')
@endif
	<div id="messagesList" class="container">
		@if($send === true)
			<h2>Mensajes enviados</h2>

			<div class="row">
				<div class="col-md-3">
				</div>

				<div class="col-md-6">
					<button id="newMessageButton" class="btn btn-lg btn-primary" onclick="newMessage('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', '2')">
						<div class="row">
							<i class="fas fa-envelope"></i>
							<p>Nuevo mensaje</p>
						</div>
					</button>
				</div>
			</div>
		@else
			<h2>Mensajes recibidos</h2>
		@endif

		@if(count($messages) > 0)
			@foreach($messages as $message)
				@if($loop -> iteration  % 2 != 0)
					<div class="row">
				@endif
						<div class="col-md-6">
						@if($send === false && $message -> read === false)
							<button id="messageNoReadButton" class="btn btn-lg btn-primary" onclick="getMessage('{{ $school }}', '{{ $person -> id }}', '{{ $message -> id }}', '{{ $type_user }}')">
						@else
							<button id="messageReadButton" class="btn btn-lg btn-primary" onclick="getMessage('{{ $school }}', '{{ $person -> id }}', '{{ $message -> id }}', '{{ $type_user }}')">
						@endif
								<div class="row">
									<div id="top" class="col-md-12">
										<div class="row">
											<div class="col-md-2">
											</div>

											<div class="col-md-8">
												<p>{{ $message -> text }}</p>
											</div>

											<div class="col-md-2">
												<a type="button" class="btn btn-secundary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="event.stopPropagation()">
													<i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminar mensaje"></i>
												</a>
											</div>
										</div>
									</div>

									@foreach($persons as $person_sender_receiver)
										@if($send === true)
											@if ($person_sender_receiver -> dni === $message -> receiver)
												<div id="bottom" class="col-md-12">
													<div class="row">
														<div id="labelName" class="col-md-7">
															<label id="name">{{ $person_sender_receiver -> name }}</label>
														</div>

														<div id="labelDate" class="col-md-5">
															<label id="date">{{ $message -> date }}</label>
														</div>
													</div>
												</div>
											@endif
										@else
											@if($person_sender_receiver -> dni === $message -> sender)
												<div id="bottom" class="col-md-12">
													<div class="row">
														<div id="labelName" class="col-md-7">
															<label id="name">{{ $person_sender_receiver -> name }} </label>
														</div>

														<div id="labelDate" class="col-md-5">
															<label id="date">{{ $message -> date }} </label>
														</div>
													</div>
												</div>
											@endif
										@endif
									@endforeach
								</div>
							</button>
						</div>
				@if($loop -> iteration  % 2 == 0)
					</div>
				@endif
			@endforeach

			@if(count($messages) % 2 != 0)
				</div>
			@endif
		@else
			<div class="row">
				<div class="col-md-3">
				</div>

				@if($send === true)
					<div class="col-md-6">
						<div id="error" class="alert alert-danger">
							<label>Aun no ha enviado ningún mensaje, cuando lo haga aparecerán aquí.</label>
						</div>
					</div>
				@else
					<div class="col-md-6">
						<div id="error" class="alert alert-danger">
							<label>Aun no ha recibido ningún mensaje.</label>
						</div>
					</div>
				@endif
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

		<div class="row">
			<div class="col-md-1">
				<button id="back" class="btn btn-primary" onclick="window.history.back()">
					Volver
				</button>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/messages.js') }}"></script>
	<script type="text/javascript">
		window.onload = function() {
			var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});
		}

		window.onbeforeunload = function(e) {
			location.reload();
		}
	</script>
@endsection