@extends('layouts.master')
@section('title', 'Perfil')
@section('content')
	<div id="profile" class="container">
		<h2>Perfil</h2>

		<div class="row">
			<div class="col-md-2">
				<!--<img src="{{ asset('images') }}" alt="" />-->
			</div>

			<div class="col-md-5">
				<h5>Datos personales</h5>

				<div class="row">
					<div id="error" class="alert alert-danger" style="display:none;">
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="name">Nombre</label>
					</div>

					<div class="col-md-7">
						<label id="nameLabel">{{ $person -> name }} {{ $person -> surnames }}</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="address">Dirección</label>
						<label id="oldPassword" style="display: none">Inserte su contraseña actual</label>
					</div>

					<div class="col-md-7">
						<label id="addressLabel">{{ $person -> address }}</label>
						<input type="text" id="addressInput" style="display: none" value="{{ $person -> address }}">
						<input type="text" id="oldPasswordInput" style="display: none">
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="location">Ciudad</label>
						<label id="newPassword" style="display: none">Inserte la nueva contraña</label>
					</div>

					<div class="col-md-7">
						<label id="locationLabel">{{ $person -> location }}</label>
						<input type="text" id="locationInput" style="display: none" value="{{ $person -> location }}">
						<input type="text" id="newPasswordInput" style="display: none">
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="province">Provincia</label>
						<label id="repeatNewPassword" style="display: none">Repita la nueva contraña</label>
					</div>

					<div class="col-md-7">
						<label id="provinceLabel">{{ $person -> province }}</label>
						<input type="text" id="provinceInput" style="display: none" value="{{ $person -> province }}">
						<input type="text" id="repeatNewPasswordInput" style="display: none">
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="phone">Teléfono</label>
					</div>

					<div class="col-md-7">
						<label id="phoneLabel">{{ $person -> phone }}</label>
						<input type="text" id="phoneInput" style="display: none" value="{{ $person -> phone }}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-5">
						<label id="email">Correo electrónico</label>
					</div>

					<div class="col-md-7">
						<label id="emailLabel">{{ $person -> email }}</label>
						<input type="text" id="emailInput" style="display: none" value="{{ $person -> email }}">
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-2">
					</div>

					<div class="col-md-7">
						<p>
							<button id="editButton" class="btn btn-primary" onclick="modifyData()">
								Modificar datos
							</button>
							<button id="saveButton" class="btn btn-primary" style="display: none" onclick="updateData('{{ $person -> id }}')">
								Guardar datos
							</button>
						</p>

						<p>
							<button id="changePasswordButton" class="btn btn-primary" onclick="changePassword()">
								Cambiar contraseña
							</button>
							<button id="savePasswordButton" class="btn btn-primary" style="display: none" onclick="updatePassword('{{ $person -> id }}', '{{ $type_user }}')">
								Guardar datos
							</button>
						</p>

						<p>
							<button id="backButton" class="btn btn-primary" onclick="window.history.back()">
								Volver
							</button>
							<button id="cancelButton" class="btn btn-primary" style="display: none" onclick="cancelModificationData()">
								Cancelar
							</button>
							<button id="cancelChangePasswordButton" class="btn btn-primary" style="display: none" onclick="cancelChangePassword()">
								Cancelar
							</button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/profile.js') }}"></script>
@endsection