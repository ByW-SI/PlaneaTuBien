@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
      <div>
      <h2>Editar Agente</h2>      
      </div>
  
    </div>
    <div class="card-body">
        <form role="form" name="domicilio" id="form-cliente" method="POST" action="" name="form">
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="nombre"><i class="fa fa-asterisk" aria-hidden="true"></i> Nombre(s):</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="" required autofocus>
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="apater">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="paterno" name="paterno" value="" >
                </div>	
                <div class="form-group col-4">
                    <label class="control-label" for="amater">Apellido Materno:</label>
                    <input type="text" class="form-control" id="materno" name="materno" value="" >
                </div>		
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label class="control-label" for="edad"> Edad:</label>
                    <input type="text" class="form-control" id="edad" name="edad" value=""  autofocus>
                </div>
                <div class="form-group col-4">
                    <label class="control-label" for="sexo">Sexo:</label>
                    <input type="text" class="form-control" id="sexo" name="sexo" value="" >
                </div>	
                <div class="form-group col-4 mt-4 mb-1">
                    <div class="input-group mt-1">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="sucursal">Sucursal:</label>
                      </div>
                      <select class="custom-select" id="sucursal" name="sucursal">
                        <option selected>Selecciona...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                </div>		
            </div>
            <div class="row">
                <div class="form-group col-4 mt-4">
                    <div class="input-group ">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="cargo">Cargo:</label>
                      </div>
                      <select class="custom-select" id="cargo" name="cargo">
                        <option selected>Selecciona...</option>
                        <option value="1">Asesor</option>
                        <option value="2">Supervisor</option>
                        <option value="3">Gerente</option>
                        <option value="4">Mesa de trabajo</option>
                        <option value="5">Ejecutivo de Cuenta</option>
                        <option value="6">Jurídico</option>
                        <option value="7">Contador</option>
                        <option value="8">Gerente de área</option>
                        <option value="9">Director de área</option>
                      </select>
                    </div>
                </div>
                <div class="form-group col-4 mt-4">
                    <div class="input-group ">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="supervisor">Supervisor:</label>
                      </div>
                      <select class="custom-select" id="supervisor" name="supervisor">
                        <option selected>Selecciona...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                </div>
                <div class="form-group col-4 mt-4">
                    <div class="input-group ">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="gerente">Gerente:</label>
                      </div>
                      <select class="custom-select" id="gerente" name="gerente">
                        <option selected>Selecciona...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="col-4 offset-4 text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> Guardar
                        </button>
                    </div>
                    <div class="col-sm-4 text-right text-danger">
                        ✱Campos Requeridos.
                    </div>
                </div>
            </div>    
        </form>
</div> 
@endsection
