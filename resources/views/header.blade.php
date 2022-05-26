<!DOCTYPE html>
<!-- <html lang="{{ config('app.locale') }}"> -->
	<!-- Init Header -->
	<header id="header">
		<!-- Init Header Top -->

		@if (request() -> segment(1) !== 'contact')
			<div class="header_top">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="appinfo">
								<h1>
									<p>
										School Manager
									</p>
								</h1>
							</div>
						</div>

						<div class="col-sm-6">
						</div>

						<div class="col-sm-2">
							<div class="social-icons pull-right">
								<ul class="nav nav-pills">
									<li class="nav-item">
										<a class="nav-link" href="/">
											<i class="fab fa-facebook"></i>
										</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" href="/">
											<i class="fab fa-twitter"></i>
										</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" href="/">
											<i class="fab fa-google-plus"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		<!-- End Header Top -->

		<!-- Init Header Middle -->
		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<!--<a href="/"><img src="{{ asset('images') }}" alt="" /></a>-->
						</div>
					</div>

					<div class="col-sm-8">
						<div class="login-menu pull-right">
							<ul class="nav navbar-nav">
								@if ($person !== "")
									<li>
										<a href="{{ URL::asset('/perfil/' . $school . '/person/' . $person -> id . '/type/' . $type_user) }}">
											<i class="fa"></i> Bienvenido, <b>{{ $person -> name }} {{ $person -> surnames }}</b>
										</a>
									</li>
									<!-- <li>
										<a href="{{ URL::asset('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											<i class="fa"></i> Logout
										</a>
									</li>
									<form id="logout-form" action="{{ URL::asset('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form> -->
								@else
									<li>
										<a href="{{ URL::asset('/prelogin') }}">
											<i class="fa fa-lock"></i> Login
										</a>
									</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Header Middle -->
	</header>
	<!-- End Header -->
	<!--</body>-->
<!--</html>-->
