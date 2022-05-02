@extends('layouts.master')
@section('title', 'Asignatura')
@section('content')
	<div id="subjectFile" class="container">
		<h2>Ficha de la asignatura</h2>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-3">
				<label id="subjectName">{{ $subject -> name }}</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-3">
				<label id="descriptionTitle">Descripción</label>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1">
			</div>

			<div class="col-md-5">
				<label id="descriptionContent">{{ $subject -> description }}</label>
			</div>
		</div>

		@if ($type_user === 'Teacher')
			<div id="studentsTable" class="row">
				<h5>Alumnos</h5>

				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-2">
						<label>Nombre</label>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-4">
								<label id="firstTrimester">Primer trimestre</label>
							</div>

							<div class="col-md-4">
								<label id="secondTrimester">Segundo trimestre</label>
							</div>

							<div class="col-md-4">
								<label id="thirdTrimester">Tercer trimestre</label>
							</div>
						</div>
					</div>

					<div class="col-md-1">
						<label id="optionalWork">Trabajos</label>
					</div>

					<div class="col-md-1">
						<label id="presentation">Exibiciones</label>
					</div>

					<div class="col-md-1">
						<label id="finalNote">Nota final</label>
					</div>
				</div>

				@foreach($evaluations as $student)
					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-2">
							<a href="{{ URL::asset('/students/' . $school . '/person/' . $person -> id . '/student/' . $student['id'] . '?subject=' . $subject -> code . '&type_user=' . $type_user) }}">{{ $student['name'] }}</a>
						</div>

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-4">
									<label>{{ $student['noteFirstTrimester'] }}</label>
								</div>

								<div class="col-md-4">
									<label>{{ $student['noteSecondTrimester'] }}</label>
								</div>

								<div class="col-md-4">
									<label>{{ $student['noteThirdTrimester'] }}</label>
								</div>
							</div>
						</div>

						<div class="col-md-1">
							<label>{{ $student['noteOptionalWork'] }}</label>
						</div>

						<div class="col-md-1">
							<label>{{ $student['noteOptionalWork'] }}</label>
						</div>

						<div class="col-md-1">
							<label>{{ $student['finalNote'] }}</label>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div id="teachersTable" class="row">
				<h5>Profesores</h5>

				<div class="row">
					<div class="col-md-1">
					</div>

					<div class="col-md-2">
						<label>Nombre</label>
					</div>
				</div>

				@foreach($teachers as $teacher)
					<div class="row">
						<div class="col-md-1">
						</div>

						<div class="col-md-2">
							<label>{{ $teacher['name'] }} {{ $teacher['surnames'] }}</label>
						</div>
					</div>
				@endforeach
			</div>
		@endif

		<div class="row">
			<div class="col-md-6">
				<button id="back" class="btn btn-primary" onclick="window.history.back()">
					Volver
				</button>
			</div>
		</div>
	</div>
@endsection