		<!-- Init Footer -->
		<footer id="footer">
			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<div class="single-widget">
								<h2><a href="{{ URL::asset('contact') }}">Contacto</a></h2>
								
								<p>Todo lo que necesitas saber sobre la aplicación y el desarrollador que la ha llevado a cabo.</p>
							</div>
						</div>

						<div class="col-sm-5">
						</div>

						<div class="col-sm-3 offset-1">
							<div class="single-widget">
								<h2>Sobre la aplicación</h2>

                                <form action="#" class="searchform">
                                    <input type="text" placeholder="Tu correo electrónico"/>
                                    <button type="submit" class="btn btn-default">
										<i class="fa fa-arrow-circle-right"></i>
									</button>
                                    <p>Realiza cualquier recomendación que ayude a mejorar nuestro sercivio.</p>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p>Copyright © 2020 TFG Inc. Todos los derechos reservados.</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer -->

		<script src="{{ asset('js/bootstrap.js') }}"></script>
		<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
		<!-- <script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script> -->
	</body>
</html>