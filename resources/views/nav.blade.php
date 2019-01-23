<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #081170;">
	<a class="navbar-brand" href="/">
		<strong>Planea tu bien</strong>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fa fa-users"></i><strong> Prospectos</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('prospectos.create')}}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{route('prospectos.index')}}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fa fa-user-secret"></i><strong> Agentes</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('empleados.create')}}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{route('empleados.index')}}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fa fa-building"></i><strong> Sucursales</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('sucursals.create')}}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{route('sucursals.index')}}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					↻<strong> Precargas</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('bancos.index')}}"><i class="fa fa-university"></i><strong> Bancos</strong></a>
				</div>
			</li>
		</ul>
	</div>
</nav>