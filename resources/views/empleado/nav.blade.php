<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link active" href="{{ route('empleados.contactos.index', ['empleado' => $empleado]) }}">Contactos</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('empleados.direcciones.index' , ['empleado' => $empleado]) }}">Dirección</a>
	</li>
</ul>