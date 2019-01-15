@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
      <div>
      <h2>Mostrar Agente</h2>      
      </div>
  
    </div>
    <div class="card-body">
        <form role="form" name="domicilio" id="form-cliente" method="POST" action="" name="form">
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="nombre"><i class="fa fa-asterisk" aria-hidden="true"></i> Nombre(s):</label>
                    <input readonly type="text" class="form-control" id="nombre" name="nombre" value="{{$empleado->nombre}}" required autofocus>
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="apater">Apellido Paterno:</label>
                    <input readonly type="text" class="form-control" id="paterno" name="paterno" value="{{$empleado->paterno}}" >
                </div>	
                <div class="form-group col-4">
                    <label class="control-label" for="amater">Apellido Materno:</label>
                    <input readonly type="text" class="form-control" id="materno" name="materno" value="{{$empleado->materno}}" >
                </div>		
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="edad"> Edad:</label>
                    <input readonly type="text" class="form-control" id="edad" name="edad" value="{{$empleado->edad}}"  autofocus>
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="sexo">Sexo:</label>
                    <input readonly type="text" class="form-control" id="sexo" name="sexo" value="{{$empleado->sexo}}" >
                </div>	
                <div class="form-group col-4">
                    <label class="control-label" for="tipo">Tipo:</label>
                    <input readonly type="text" class="form-control" id="tipo" name="tipo" value="{{$empleado->tipo}}" >
                </div>			
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="sucursal">Sucursal:</label>
                    <input readonly type="text" class="form-control" id="sucursal" name="sucursal" value="{{$empleado->sucursal}}" >
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="cargo">Cargo:</label>
                    <input readonly type="text" class="form-control" id="cargo" name="cargo" value="{{$empleado->cargo}}" >
                </div>	
                @if($empleado->tipo == 'Asesor')
                <div class="form-group col-4">
                    <label class="control-label" for="sucursal">
                        Supervisosr:
                    </label>
                    <input readonly type="text" class="form-control" id="jefe" name="jefe" value="{{$empleado->jefe->nombre}}" >
                </div>
                @elseif($empleado->tipo == 'Supervisor')
                <div class="form-group col-4">
                    <label class="control-label" for="sucursal">
                        Gerente:
                    </label>
                    <input readonly type="text" class="form-control" id="jefe" name="jefe" value="{{$empleado->jefe->nombre}}" >
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="col-4 offset-4 text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Editar
                        </button>
                    </div>
                    <div class="col-sm-4 text-right text-danger">
                        ✱Campos Requeridos.
                    </div>
                </div>
            </div>    
        </form>
</div> 
@yield('submodulos')
@endsection
