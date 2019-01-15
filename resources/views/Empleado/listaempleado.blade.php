@foreach($empleados as $empleado)
<option value="{{$empleado->id}}">{{$empleado->nombre}}</option>
@endforeach