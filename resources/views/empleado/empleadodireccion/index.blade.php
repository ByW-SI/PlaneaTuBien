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
          @if($empleado->tipo != "Asesor")
          <li class="nav-item">
              <a class="nav-link" href="{{ route('empleados.relaciones.index', ['empleado' => $empleado]) }}">Empleados</a>
          </li>
          @endif
          <li class="nav-item">
              <a class="nav-link active" href="{{ route('empleados.direcciones.index' , ['empleado' => $empleado]) }}">Dirección</a>
          </li>
          <li class="nav-item">
                <a class="nav-link" href="{{ route('empleados.accidentes.index' , ['empleado' => $empleado]) }}">Accidentes</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('empleados.beneficiario.index' , ['empleado' => $empleado]) }}">Beneficiario</a>
          </li>
      </ul>
  </div>
</div>
<div class="container p-5">

    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h4>Direcciones</h4>
            </div>
            <div class="col">
              <a href="{{route('empleados.direcciones.create', ['empleado'=>$empleado])}}" class="btn btn-success">Crear</a>
            </div>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px">
                  <tr class="info">
                    <th>Calle</th>
                    <th>#Exterior</th>
                    <th>#Interior</th>
                    <th>Colonia</th>
                    <th>Delegación</th>
                    <th>Estado</th>
                    <th>CP</th>
                    <th>Acciones</th>
                  </tr>  
                  @foreach($direcciones as $direccion)
                    <tr>
                      <td>{{$direccion->calle}} </td>
                      <td>{{$direccion->exterior}}</td>
                      <td>{{$direccion->interior}}</td>
                      <td>{{$direccion->colonia}}</td>
                      <td>{{$direccion->delegacion}}</td>
                      <td>{{$direccion->estado}}</td>
                      <td>{{$direccion->cp}}</td>
                      <td>
                        <button type="button" class="btn btn-warning">Editar</button>
                        <button type="button" class="btn btn-danger">Baja</button>
                      </td>
                    </tr>
                  @endforeach
                  <tr></tr>  
                </table>
        </div>
        <div class="card-footer">
        </div> 
    </div>
    
</div>

@endsection