@extends('layouts.master')
@section('title', 'Login')
@section('content')
	<!-- Init Login -->
	<div id="loginContent" class="container">
		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<div id="error" class="alert alert-danger" style="display:none;">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-2">
				<label>Tipo</label>
			</div>

			<select id="type_user" class="col-md-4">
				<option disabled="disabled" selected="selected">Seleccione un tipo de usuario</option>
				<!--<option>Super Admin</option>-->
				<option>Manager</option>
				<option>Teacher</option>
			</select>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-2">
				<label>Usuario</label>
			</div>

			<div class="col-md-4">
				<input type="text" id="user_name" class="" placeholder="Introduzca su usuario" value="{{ old('user') }}">
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-2">
				<label>Contraseña</label>
			</div>

			<div class="col-md-4">
				<input type="password" id="password" class="" placeholder="Introduzca su constraseña" value="{{ old('password') }}">
				<i id="togglePassword" class="fas fa-eye" style="margin-left: -30px; cursor: pointer;" onclick="showPassword()"></i>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<button id="login" class="btn btn-primary" onclick="login('{{ $school -> id }}')">
					Login
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

	<script src="{{ asset('js/login.js') }}"></script>
	<!-- End Login -->
@endsection