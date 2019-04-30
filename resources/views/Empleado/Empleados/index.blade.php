@extends('empleado.show')
@section('submodulos')
<div class="row">
  <div class="col-sm-12">
      <ul class="nav nav-tabs">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('empleados.show', ['empleado' => $empleado]) }}">Datos generales</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('empleados.laborals.index', ['empleado' => $empleado]) }}">Datos Laborales</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('empleados.contactos.index', ['empleado' => $empleado]) }}">Contactos</a>
          </li>
          <li class="nav-item">
              <a class="nav-link active" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('empleados.direcciones.index' , ['empleado' => $empleado]) }}">Dirección</a>
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
                    @foreach($empleados as $empleado)
                      <tr>
                        <td>{{$empleado->id}} </td>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->cargo}}</td>
                        <td>{{$empleado->sucursal}}</td>
                        <td>
                          <button type="button" class="btn btn-warning">Editar</button>
                          <button type="button" class="btn btn-danger">Baja</button>
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