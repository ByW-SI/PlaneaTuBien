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
            @php 
            	$hasPerfil = false;
            	$hasUsuario = false;
            @endphp
            @foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice perfiles")
					@php
						$hasPerfil = true;
					@endphp
				@elseif($componente->nombre == "indice usuarios")
					@php
						$hasUsuario = true;
					@endphp
	        	@endif
            @endforeach
            @if($hasPerfil || $hasUsuario)
		        <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
		                <i class="fa fa-lock"></i><strong> Seguridad</strong>
		            </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					@if($hasPerfil)
						<a class="dropdown-item" href="{{ route('perfils.index') }}">
							<i class="fa fa-universal-access"></i><strong> Perfiles</strong>
						</a>
					@endif
					@if($hasUsuario)
						<a class="dropdown-item" href="{{ route('usuarios.index') }}">
							<i class="fa fa-user-circle"></i><strong> Usuarios</strong>
						</a>
					@endif
					</div>
		        </li>
			@endif

	        {{--  Prospectos --}}
	        @foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice prospectos")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fa fa-users"></i><strong> Prospectos</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@foreach(Auth::user()->perfil->componentes as $c)
	                            @if($c->nombre == "crear prospecto")
								<a class="dropdown-item" href="{{ route('prospectos.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
								@endif
								@if($c->nombre == "indice prospectos")
								<a class="dropdown-item" href="{{ route('prospectos.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
								@endif
							@endforeach
						</div>
					</li>
				@endif
            @endforeach

            {{-- Agentes --}}
            @foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice agentes")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fa fa-user-secret"></i><strong> Agentes</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@foreach(Auth::user()->perfil->componentes as $c)
								@if($c->nombre == "crear agente")
									<a class="dropdown-item" href="{{ route('empleados.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
								@endif
								@if($c->nombre == "indice agentes")
									<a class="dropdown-item" href="{{ route('agentes.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
								@endif
							@endforeach
						</div>
					</li>
				@endif
            @endforeach

			{{-- Recursos Humanos --}}
			@foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice recursos humanos")
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						<i class="fas fa-briefcase"></i><strong> RH</strong>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						@foreach(Auth::user()->perfil->componentes as $c)
	                        @if($c->nombre == "crear rh")
								<a class="dropdown-item" href="{{ route('empleados.create') }}"><i class="fas fa-user-plus"></i><strong> Alta</strong></a>
							@endif
							@if($c->nombre == "indice recursos humanos")
								<a class="dropdown-item" href="{{ route('empleados.index') }}"><i class="fas fa-user-friends"></i><strong> Búsqueda</strong></a>
							@endif
						@endforeach
					</div>
				</li>
				@endif
            @endforeach

			{{-- CRM --}}
			@foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice CRM")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fas fa-calendar-alt"></i><strong> C.R.M.</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('empleados.prospectos.index',['empleado'=>Auth::user()->empleado]) }}"><i class="fa fa-users"></i><strong> Mis prospectos</strong></a>
							<a class="dropdown-item" href="{{ route('empleados.crms.index',['empleado'=>Auth::user()->empleado]) }}"><i class="fas fa-calendar"></i><strong> Mi C.R.M.</strong></a>
							<a class="dropdown-item" href="{{ route('crms.index') }}"><i class="fas fa-calendar"></i><strong> C.R.M. General</strong></a>
						</div>
					</li>
				@endif
            @endforeach

			{{-- Sucursales --}}
			@foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice Sucursales")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fa fa-building"></i><strong> Sucursales</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@foreach(Auth::user()->perfil->componentes as $c)
		                        @if($c->nombre == "crear sucursal")
									<a class="dropdown-item" href="{{ route('sucursals.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
								@endif
								@if($c->nombre == "indice Sucursales")
									<a class="dropdown-item" href="{{ route('sucursals.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
								@endif
							@endforeach
						</div>
					</li>
				@endif
            @endforeach

			{{-- Precargas --}}
			@php
			 $moduloPrecargas = false;
			 foreach (Auth::user()->perfil->componentes as $c) {
			 	if ($c->modulo->nombre == "precargas")
			 		$moduloPrecargas = true;
			 }
			@endphp
			@if($moduloPrecargas)
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
						↻<strong> Precargas</strong>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						@foreach(Auth::user()->perfil->componentes as $c)
	                        @if($c->nombre == "Bancos")
								<a class="dropdown-item" href="{{ route('bancos.index') }}"><i class="fa fa-university"></i><strong> Bancos</strong></a>
							@endif
							@if($c->nombre == "Tareas")
								<a class="dropdown-item" href="{{ route('tasks.index') }}"><i class="fas fa-tasks"></i><strong> Tareas</strong></a>
							@endif
							@if($c->nombre == "Tipo de Promociones")
								<a class="dropdown-item" href="{{ route('tipo_promocions.index') }}"><i class="fas fa-percent"></i><strong> Tipo de Promociones</strong></a>
							@endif
							@if($c->nombre == "Areas")
								<a class="dropdown-item" href="{{ route('areas.index') }}"><i class="fas fa-clipboard-check"></i><strong> Areas</strong></a>
							@endif
							@if($c->nombre == "Bajas")
								<a class="dropdown-item" href="{{ route('bajas.index') }}"><i class="fas fa-user-times"></i><strong> Bajas</strong></a>
							@endif
							@if($c->nombre == "Contratos")
								<a class="dropdown-item" href="{{ route('contratos.index') }}"><i class="fas fa-file-contract"></i><strong> Contratos</strong></a>
							@endif
							@if($c->nombre == "Puestos")
								<a class="dropdown-item" href="{{ route('puestos.index') }}"><i class="fas fa-users-cog"></i><strong> Puestos</strong></a>
							@endif
						@endforeach
						{{-- FALTA AUTENTICACIÓN PARA POLIZAS --}}
						<a class="dropdown-item" href="{{ route('polizas.index') }}"><i class="fas fa-house-damage"></i><strong> Poliza de seguros</strong></a>
					</div>
				</li>
			@endif

			{{-- Promociones --}}
			@foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice promociones")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fas fa-percent"></i><strong> Promociones</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@foreach(Auth::user()->perfil->componentes as $c)
                        		@if($c->nombre == "crear promocion")
									<a class="dropdown-item" href="{{ route('promocions.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
								@endif
								@if($c->nombre == "indice promociones")
									<a class="dropdown-item" href="{{ route('promocions.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
								@endif
							@endforeach
						</div>
					</li>
				@endif
			@endforeach

			{{-- Planes --}}
			@foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice planes")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fas fa-home"></i><strong> Planes</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@foreach(Auth::user()->perfil->componentes as $c)
                        		@if($c->nombre == "crear plan")
									<a class="dropdown-item" href="{{ route('plans.create') }}"><i class="fa fa-plus"></i><strong> Alta</strong></a>
								@endif
								@if($c->nombre == "indice planes")
									<a class="dropdown-item" href="{{ route('plans.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
								@endif
								@if($c->nombre == "indice promociones")
								{{-- Checar que usuario puede cotizar --}}
									<a class="dropdown-item" href="{{ route('cotizador') }}"><i class="fa fa-search"></i><strong> Cotizador</strong></a> 
								@endif
							@endforeach
								<a class="dropdown-item" href="{{ route('factors.index') }}"><i class="fa fa-search"></i><strong> Factor de Actualización</strong></a> 
						</div>
					</li>
				@endif
			@endforeach

			{{-- Grupos --}}
			@foreach(Auth::user()->perfil->componentes as $componente)
		        @if($componente->nombre == "indice grupos")
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
							<i class="fas fa-layer-group"></i><strong> Grupos</strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							@foreach(Auth::user()->perfil->componentes as $c)
                        		@if($c->nombre == "crear grupo")
									<a class="dropdown-item" href="{{ route('grupos.create') }}"><i class="far fa-arrow-alt-circle-up"></i><strong> Alta</strong></a>
								@endif
								@if($c->nombre == "indice grupos")
									<a class="dropdown-item" href="{{ route('grupos.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
								@endif
							@endforeach
						</div>
					</li>
				@endif
			@endforeach
		</ul>
	</div>
</nav>
{{-- Segunda nav para poner elementos debajo --}}
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #081170;">
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
					<i class="fas fa-layer-group"></i><strong> Pagos</strong>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					{{-- <a href="{{route('pagos.busqueda.referencia')}}" class="dropdown-item"><i class="fa fa-search"> <strong> Búsqueda de referencia</strong></i></a> --}}
					<a class="dropdown-item" href="{{route('pagos.busqueda.referencia')}}"><i class="fa fa-search"></i><strong> Búsqueda de referencia</strong></a>
					<a class="dropdown-item" href="{{ route('pagos.index') }}"><i class="fa fa-search"></i><strong> Búsqueda</strong></a>
					<a class="dropdown-item" href="{{ route('excelpagos') }}"><i class="fa fa-search"></i><strong> Excel</strong></a>
				</div>
			</li>
		</ul>
	</div>
</nav>