@extends('layouts.master')
@section('title', 'Nuevo directivo')
@section('content')
	<div id="newManager" class="container">
		<h2>Nuevo directivo</h2>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div class="row">
			<h5>Datos del directivo</h5>

			<div id="managerFields" class="row">
				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-2">
						<label>DNI</label>
					</div>

					<div class="col-md-3">
						<input type="text" id="managerDNI" class="" placeholder="DNI" value="{{ old('managerDNI') }}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Nombre</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="managerName" class="" placeholder="Nombre" value="{{ old('managerName') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Apellidos</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="managerSurnames" class="" placeholder="Apellidos" value="{{ old('managerSurnames') }}">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="col-md-3">
								<label>Teléfono</label>
							</div>

							<div class="col-md-6">
								<input type="text" id="managerPhone" class="" placeholder="Teléfono" value="{{ old('managerPhone') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-4">
								<label>Correo electrónico</label>
							</div>

							<div class="col-md-6">
								<input type="text" id="managerEmail" class="" placeholder="Correco electrónico" value="{{ old('managerEmail') }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5>Datos del domicilio</h5>

			<div id="residenceFields" class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Dirección</label>
							</div>

							<div class="col-md-8">
								<input type="text" id="managerAddress" class="" placeholder="Dirección" value="{{ old('managerAddress') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-2">
								<label>Ciudad</label>
							</div>

							<div class="col-md-4">
								<input type="text" id="managerLocation" class="" placeholder="Ciudad" value="{{ old('managerLocation') }}">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-3">
							</div>

							<div class="col-md-3">
								<label>Provincia</label>
							</div>

							<div class="col-md-6">
								<input type="text" id="managerProvince" class="" placeholder="Provincia" value="{{ old('managerProvince') }}">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Código postal</label>
							</div>

							<div class="col-md-4">
								<input type="text" id="managerPostalCode" class="" placeholder="Código postal" value="{{ old('managerPostalCode') }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<h5>Datos del centro</h5>

			<div id="managerSelect" class="row">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2">
							</div>

							<div class="col-md-3">
								<label>Tipo de directivo</label>
							</div>

							<select id="managerType" onchange="validateType('{{ $school }}')">
								<option disabled="disabled" selected="selected">Seleccione un tipo de directivo</option>

								@foreach($managers as $manager)
									<option value="{{ $manager['type'] }}">{{ $manager['description'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-5">
						<div id="errorType" class="alert alert-danger" style="display:none;">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<button id="save" class="btn btn-primary" onclick="save('', '{{ $school }}', '{{ $type_user }}')" onchange="enableButton()">
					Guardar
				</button>
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