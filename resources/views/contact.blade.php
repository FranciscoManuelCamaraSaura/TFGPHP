@extends('layouts.master')
@section('title', 'Contacto')
@section('content')
	<!-- Init Contact -->
	<div id="contact-page" class="container">
		<div class="bg">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="title text-center">Contacta con <strong>el desarrollador</strong></h2>
				</div>
			</div>

			<div class="row">  	
				<div class="col-sm-8">
					<div class="contact-form">
						<h2 class="title text-center">Envía una descripción de tu problema</h2>

						<div class="status alert alert-success" style="display: none"></div>

						<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
							<div class="form-group col-md-6">
								<input type="text" name="name" class="form-control" required="required" placeholder="Nombre">
							</div>

							<div class="form-group col-md-6">
								<input type="email" name="email" class="form-control" required="required" placeholder="Email">
							</div>

							<div class="form-group col-md-12">
								<input type="text" name="subject" class="form-control" required="required" placeholder="Asunto">
							</div>

							<div class="form-group col-md-12">
								<textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Mensaje.."></textarea>
							</div>

							<div class="form-group col-md-12">
								<input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
							</div>
						</form>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="contact-info">
						<h2 class="title text-center">Información de contacto</h2>
						<br>

						<address>
							<p>School Manager</p>
							<p>Francisco Manuel Cámara Saura</p>
							<p>Trabajo de fin de grado de la titulación del Grado en Ingeniería Informática de la Universidad de Alicante</p>
							<p>Teléfono: 657600986</p>
							<p>Email: fmcs@alu.ua.es</p>
						</address>

						<div class="social-networks">
							<h2 class="title text-center">Redes Sociales</h2>

							<ul>
								<li>
									<a href="#">
										<i class="fab fa-facebook"></i>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="fab fa-twitter"></i>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="fab fa-google-plus"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>  
		</div>	
	</div>
	<!-- End Contact -->
@endsection