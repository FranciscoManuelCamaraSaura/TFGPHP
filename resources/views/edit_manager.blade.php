@extends('layouts.master')
@section('title', 'Editar directivo')
@section('content')
	<div id="editManager" class="container">
		<h2>Editar directivo</h2>

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
						<label id="managerDNILabel">{{ $manager -> dni }}</label>
						<input type="text" id="managerDNI" class="" placeholder="DNI" value="{{ $manager -> dni }}" style="display:none;">
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
								<label id="managerNameLabel">{{ $manager -> name }}</label>
								<input type="text" id="managerName" class="" placeholder="Nombre" value="{{ $manager -> name }}" style="display:none;">
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
								<label id="managerSurnamesLabel">{{ $manager -> surnames }}</label>
								<input type="text" id="managerSurnames" class="" placeholder="Apellidos" value="{{ $manager -> surnames }}" style="display:none;">
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
								<label id="managerPhoneLabel">{{ $manager -> phone }}</label>
								<input type="text" id="managerPhone" class="" placeholder="Teléfono" value="{{ $manager -> phone }}" style="display:none;">
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
								<label id="managerEmailLabel">{{ $manager -> email }}</label>
								<input type="text" id="managerEmail" class="" placeholder="Correco electrónico" value="{{ $manager -> email }}" style="display:none;">
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
								<label id="managerAddressLabel">{{ $manager -> address }}</label>
								<input type="text" id="managerAddress" class="" placeholder="Dirección" value="{{ $manager -> address }}" style="display:none;">
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
								<label id="managerLocationLabel">{{ $manager -> location }}</label>
								<input type="text" id="managerLocation" class="" placeholder="Ciudad" value="{{ $manager -> location }}" style="display:none;">
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
								<label id="managerProvinceLabel">{{ $manager -> province }}</label>
								<input type="text" id="managerProvince" class="" placeholder="Provincia" value="{{ $manager -> province }}" style="display:none;">
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
								<label id="managerPostalCodeLabel">{{ $manager -> postal_code }}</label>
								<input type="text" id="managerPostalCode" class="" placeholder="Código postal" value="{{ $manager -> postal_code }}" style="display:none;">
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

							<div class="col-md-4">
								<label id="managerTypeLabel">{{ $type_admin['description'] }}</label>

								<select id="managerType" onchange="validateType('{{ $school }}')" style="display:none;">
									<option disabled="disabled" selected="selected">Seleccione un tipo de directivo</option>

									@foreach($managers as $manager_type)
										@if ($manager_type['type'] === $type_admin['type'])
											<option value="{{ $manager_type['type'] }}" selected="selected">{{ $manager_type['description'] }}</option>
										@else
											<option value="{{ $manager_type['type'] }}">{{ $manager_type['description'] }}</option>
										@endif
									@endforeach
								</select>
							</div>
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
				<button id="edit" class="btn btn-primary" onclick="edit()">
				Editar
				</button>

				<div id="saveOptions" class="row" style="display: none">
					<div class="col-md-5">
					</div>

					<div class="col-md-1">
						<button id="save" class="btn btn-primary" onclick="save('{{ $manager -> id }}', '{{ $school }}', '{{ $type_user }}')">
							Guardar
						</button>
					</div>

					<div class="col-md-1">
						<button id="cancel" class="btn btn-primary" onclick="cancel()">
							Cancel
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

	<script src="{{ asset('js/managers.js') }}"></script>
@endsection