<nav class="nav nav-pills nav-fill">
  <a class="nav-item nav-link" href="{{route('empleados.contactos.index', ['empleado'=>$empleado])}}">Contactos</a>
  <a class="nav-item nav-link" href="{{route('empleados.relaciones.index', ['empleado'=>$empleado])}}">Empleados</a>
  <a class="nav-item nav-link" href="{{route('empleados.direcciones.index' , ['empleado'=>$empleado])}}">Dirección</a>
</nav>