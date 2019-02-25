<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #081170;">
	<a class="navbar-brand" href="/">
		<strong>Planea tu bien</strong>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
            {{-- LOGOUT --}}
            <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                	<strong>{{ Auth::user()->name }}</strong>
                </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    	↶<strong> Logout</strong>
					</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
				</div>
            </li>
            {{-- SEGURIDAD --}}
	        <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
	                <i class="fa fa-lock"></i><strong> Seguridad</strong>
	            </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('perfils.index') }}">
						<i class="fa fa-universal-access"></i><strong> Perfiles</strong>
					</a>
					<a class="dropdown-item" href="{{ route('usuarios.index') }}">
						<i class="fa fa-user-circle"></i><strong> Usuarios</strong>
					</a>
				</div>
	        </li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fa fa-users"></i><strong> Prospectos</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('prospectos.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{ route('prospectos.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fa fa-user-secret"></i><strong> Agentes</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('empleados.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{ route('empleados.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fas fa-briefcase"></i><strong> RH</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('empleados.create') }}"><i class="fas fa-user-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{ route('empleados.index') }}"><i class="fas fa-user-friends"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fas fa-calendar-alt"></i><strong> C.R.M.</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('empleados.prospectos.index',['empleado'=>2]) }}"><i class="fas fa-calendar"></i><strong> Mi CRM</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fa fa-building"></i><strong> Sucursales</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('sucursals.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
					<a class="dropdown-item" href="{{ route('sucursals.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					↻<strong> Precargas</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('bancos.index') }}"><i class="fa fa-university"></i><strong> Bancos</strong></a>
					<a class="dropdown-item" href="{{ route('promocions.index') }}"><i class="fas fa-percent"></i><strong> Promociones</strong></a>
					<a class="dropdown-item" href="{{ route('areas.index') }}"><i class="fas fa-clipboard-check"></i><strong> Areas</strong></a>
					<a class="dropdown-item" href="{{ route('bajas.index') }}"><i class="fas fa-user-times"></i><strong> Bajas</strong></a>
					<a class="dropdown-item" href="{{ route('contratos.index') }}"><i class="fas fa-file-contract"></i><strong> Contratos</strong></a>
					<a class="dropdown-item" href="{{ route('puestos.index') }}"><i class="fas fa-users-cog"></i><strong> Puestos</strong></a>
				</div>
			</li>
		</ul>
	</div>
</nav>