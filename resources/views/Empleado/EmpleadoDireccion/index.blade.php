@extends('empleado.show')
@section('submodulos')
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
                  </tr>  
                  @foreach($direcciones as $direccion)
                    <tr>
                      <td>{{$contacto->telefono}} </td>
                      <td>{{$contacto->celular}}</td>
                      <td>{{$contacto->correo}}</td>
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