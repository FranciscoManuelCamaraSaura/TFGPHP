@extends('layouts.master')
@section('title', 'PreLogin')
@section('content')
	<!-- Init Prelogin -->
	<div id="prelogin" class="container">
		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-2">
				<label>Provincia</label>
			</div>

			<select id="provinces" class="col-md-4" onchange="showLocations()">
				<option disabled="disabled" selected="selected">Seleccione una provincia</option>

				@foreach ($provinces as $province)
					<option value="{{ $province }}">{{ $province }}</option>
				@endforeach
			</select>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-2">
				<label>Localidad</label>
			</div>

			<select id="locations" class="col-md-4" onchange="showSchools()">
				<option disabled="disabled" selected="selected">Seleccione una localidad</option>
			</select>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-2">
				<label>Colegio</label>
			</div>

			<select id="schools" class="col-md-4" onchange="enableButton()">
				<option disabled="disabled" selected="selected">Seleccione un colegio</option>
			</select>
		</div>

		<div class="row">
			<div class="col-md-3">
			</div>

			<div class="col-md-6">
				<button id="next" class="btn btn-primary" disabled="disabled" onclick="login()">
					Siguiente
				</button>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/prelogin.js') }}"></script>
	<!-- End Prelogin -->
@endsection