@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Cliente:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('clientes.edit', ['cliente' => $cliente]) }}" class="btn btn-warning">
                    <strong>✎ Editar Cliente</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('clientes.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Cliente</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('clientes.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Clientes</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Nombre:</label>
                <dd>{{ $cliente->nombre }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Paterno:</label>
                <dd>{{ $cliente->appaterno }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Materno:</label>
                <dd>{{ $cliente->apmaterno ? $cliente->apmaterno : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Asesor:</label>
                <dd>{{ $cliente->asesor ? $cliente->asesor->nombre . ' ' . $cliente->asesor->paterno : 'N/A'}}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>RFC:</label>
                <dd>{{ $cliente->rfc ? $cliente->rfc : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono:</label>
                <dd>{{ $cliente->telefono ? $cliente->telefono : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono de Oficina:</label>
                <dd>{{ $cliente->oficina ? $cliente->oficina : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono Móvil:</label>
                <dd>{{ $cliente->celular ? $cliente->celular : 'N/A' }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Email:</label>
                <dd>{{ $cliente->email ? $cliente->email : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Fecha de Nacimiento:</label>
                <dd>{{ $cliente->fecha_nacimiento ? $cliente->fecha_nacimiento : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Lugar de Nacimiento:</label>
                <dd>{{ $cliente->lugar_nacimiento ? $cliente->lugar_nacimiento : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Nacionalidad:</label>
                <dd>{{ $cliente->nacionalidad ? $cliente->nacionalidad : 'N/A' }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Sexo:</label>
                <dd>{{ $cliente->sexo ? $cliente->sexo : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Edad:</label>
                <dd>{{ $cliente->edad ? $cliente->edad : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Estado Civil:</label>
                <dd>{{ $cliente->estado_civil ? $cliente->estado_civil : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Profesión:</label>
                <dd>{{ $cliente->profesion ? $cliente->profesion : 'N/A' }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Empresa:</label>
                <dd>{{ $cliente->empresa ? $cliente->empresa : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Puesto Actual:</label>
                <dd>{{ $cliente->puesto_actual ? $cliente->puesto_actual : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Puesto Anterior:</label>
                <dd>{{ $cliente->puesto_anterior ? $cliente->puesto_anterior : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Antigüedad:</label>
                <dd>{{ $cliente->antiguo ? $cliente->antiguo : 'N/A' }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Ingreso:</label>
                <dd>{{ $cliente->ingreso ? $cliente->ingreso : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Calle:</label>
                <dd>{{ $cliente->calle }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Número Exterior:</label>
                <dd>{{ $cliente->numext }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Número Interior:</label>
                <dd>{{ $cliente->numint ? $cliente->numint : 'N/A' }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Colonia:</label>
                <dd>{{ $cliente->colonia }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Delegación:</label>
                <dd>{{ $cliente->delegacion }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Estado:</label>
                <dd>{{ $cliente->estado }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Código Postal:</label>
                <dd>{{ $cliente->cp }}</dd>
            </div>
        </div>
    </div>
</div>

@endsection