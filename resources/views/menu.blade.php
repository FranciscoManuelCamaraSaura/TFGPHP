	<!-- Menu -->
	<div class="header-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="mainmenu pull-left">
						<!-- <ul class="nav navbar-nav collapse navbar-collapse">  
								@if (Auth::check())
									@if (Auth::user()->esadmin)
									<li><a href="{{ URL::asset('admin/productos') }}" class="active">Administrador</a></li>
								@endif
							@endif
						</ul> -->
					</div>
				</div>

				<div class="col-sm-9">
					<!-- <form action="{{url('buscar')}}" method="GET">
					<div class="search_box pull-left">
						<input type="text" placeholder="Buscar" name="producto" id="producto"/>
					</div>
					</form> -->
				</div>
			</div>
		</div>
	</div>
	<!-- Menu -->