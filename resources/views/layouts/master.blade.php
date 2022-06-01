<!DOCTYPE html>
<html>
	<head>
		<title>@yield("title")</title>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="Francisco Manuel Cámara Saura">
		<meta name="description" content="Trabajo de fin de grado de la titulación del Grado en Ingeniería Informática de la Universidad de Alicante">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ URL::asset('css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ URL::asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">
		<script src="{{ asset('js/jquery.js') }}"></script>
	</head>

	<body>
		@include("header")

		@if ($person !== "" || request() -> segment(0) !== "prelogin")
			@yield("content")
		@endif

		@if (request() -> segment(1) !== "contact")
			@include("footer")
		@endif
	</body>
</html>