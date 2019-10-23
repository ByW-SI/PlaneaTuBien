@extends('empleado.show')
@section('submodulos')
<div class="row">
  <div class="col-sm-12">
      <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Laborales</a>
            </li>
            @if($empleado->tipo != "Asesor")
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.vacacions.index' , ['empleado' => $empleado]) }}">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.permisos.index' , ['empleado' => $empleado]) }}">Permisos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.faltas.index' , ['empleado' => $empleado]) }}">Faltas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.estudios.index' , ['empleado' => $empleado]) }}">Estudios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.emergencias.index' , ['empleado' => $empleado]) }}">Emergencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.disciplinas.index' , ['empleado' => $empleado]) }}">Falta Administrativa</a>
            </li>
        </ul>
  </div>
</div>
<div class="container p-5">
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h4>Empleados</h4>
            </div>
            <div class="col">
              <a href="{{route('empleados.relaciones.create', ['empleado'=>$empleado])}}" class="btn btn-success">Agregar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px">
                  <tr class="info">
                    <th>#ID</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Sucursal</th>
                    <th>Acciones</th>
                  </tr>  
                  @if(isset($empleados))
                    @foreach($empleados as $empl)
                      <tr>
                        <td>{{$empl->id}} </td>
                        <td>{{$empl->nombre}}</td>
                        <td>{{$empl->cargo}}</td>
                        <td>{{ $empl->sucursal ? $empl->sucursal->nombre : ""}}</td>
                        <td>
                          <form action="{{route('empleados.relaciones.destroy', ['empleado'=>$empleado, 'relacion'=>$empl])}}" method="POST" class="mt-1">
                            @csrf
                            {{method_field('DELETE')}}
                            <input type="hidden" name="sub_empleado" value="{{ $empl->id }}">
                            <button type="submit" class="btn btn-danger">Baja</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr><td colspan="5">No hay Empleados</td></tr>  
                  @endif
                </table>
        </div>
        <div class="card-footer">
        </div> 
    </div>
    
</div>

@endsection