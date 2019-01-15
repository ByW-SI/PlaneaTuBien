@extends('empleado.show')
@section('submodulos')
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
                  <tr></tr>  
                </table>
        </div>
        <div class="card-footer">
        </div> 
    </div>
    
</div>

@endsection