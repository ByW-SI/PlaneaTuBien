@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>Buscar Agentes</h2>  
        </div>
        <div class="col">
        <a href="{{route('empleados.create')}}" class="btn btn-success">Crear Agente</a>
        </div>
      </div>
      
  
    </div>
    <div class="card-body">
        <div class="card-body">
            <div class="row ">
                <div class="col-12 mb-5">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Nombre o Apellido" aria-label="Buscar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
                  </div>
            </div>

            <div class="row">
              <div class="col-12">
                <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px">
                  <tr class="info">
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Alta</th>
                    <th>Fecha de Baja</th>
                    <th>Razón de Baja</th>
                    <th>Acción</th>
                  </tr>  
                  @foreach($empleados as $empleado)
                    <tr>
                      <td>{{$empleado->id}} </td>
                      <td>{{$empleado->nombre}}</td>
                      <td>{{$empleado->paterno}}</td>
                      <td>{{$empleado->created_at}}</td>
                      <td>{{$empleado->fechabaja}}</td>
                      <td>{{$empleado->motivobaja}}</td>
                      <td>
                        <a href="{{route('empleados.show', [$empleado])}}" class="btn btn-primary">Ver</a>
                        <button type="button" class="btn btn-warning">Editar</button>
                        <button type="button" class="btn btn-danger">Baja</button>
                      </td>
                    </tr>
                  @endforeach
                  <tr></tr>  
                </table>
              </div>
            </div>
            </div>
</div> 
@endsection