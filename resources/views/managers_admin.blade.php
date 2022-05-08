@extends('layouts.master')
@section('title', 'Directivos')
@section('content')
	<div id="managersList" class="container">
		<h2>Directivos</h2>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<button id="newManagerButton" class="btn btn-lg btn-primary" onclick="newManager('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}')">
					<div class="row">
						<i class="fas fa-user-plus"></i>
						<p>Crear directivo</p>
					</div>
				</button>
			</div>
		</div>

		<div id="managersTable">
			<div class="row">
				<div class="col-md-1">
				</div>

				<div class="col-md-2">
					<label>Nombre</label>
				</div>

				<div class="col-md-5">
					<label>Cargo</label>
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-md-5">
							<label>Opciones</label>
						</div>
					</div>
				</div>
			</div>

			<div id="managersTableContent">
				@foreach($persons as $manager)
					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-2">
							<a href="{{ URL::asset('/managers/' . $school . '/person/' . $person -> id . '/manager/' . $manager['id'] . '?type_user=' . $type_user) }}">{{ $manager['name'] }} {{ $manager['surnames'] }}</a>
						</div>

						<div class="col-md-5">
							<label>{{ $manager['type_admin'] }}</label>
						</div>

						<div class="col-md-4">
							<div class="row">
								@php
									$manager_id = $manager['id'];
								@endphp

								<div class="col-md-2">
									<button id="editButton" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Editar directivo" onclick="editManager('{{ $school }}', '{{ $person -> id }}', '{{ $type_user }}', '{{ $manager_id }}')">
										<i class="fas fa-user-edit"></i>
									</button>
								</div>

								<div class="col-md-1">
								</div>

								<div class="col-md-2">
									@if ($person -> id === $manager_id)
										<button id="deleteButton" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminar directivo" onclick="deleteManager('{{ $manager_id }}')" disabled>
									@else
										<button id="deleteButton" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminar directivo" onclick="deleteManager('{{ $manager_id }}')">
									@endif
										<i class="fas fa-user-times"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				@endforeach
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

	<script src="{{ asset('js/managers.js') }}"></script>
@endsection