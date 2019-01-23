@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Nombre:</label>
                <dd>{{ $prospecto->nombre }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Paterno:</label>
                <dd>{{ $prospecto->appaterno }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Materno:</label>
                <dd>{{ $prospecto->apmaterno ? $prospecto->apmaterno : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Sexo:</label>
                <dd>{{ $prospecto->sexo }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>RFC:</label>
                <dd>{{ $prospecto->rfc }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Email:</label>
                <dd>{{ $prospecto->email }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono:</label>
                <dd>{{ $prospecto->telefono }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Teléfono Móvil:</label>
                <dd>{{ $prospecto->movil }}</dd>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Asesor:</label>
                <dd>{{ $prospecto->asesor->nombre }} {{ $prospecto->asesor->paterno }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Ingreso Mensual:</label>
                <dd>{{ $prospecto->ingreso }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Gasto Mensual:</label>
                <dd>{{ $prospecto->gasto }}</dd>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.documentos.index', ['prospecto' => $prospecto]) }}">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.prestamos.index', ['prospecto' => $prospecto]) }}">Préstamos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Documentación:</h5>
                    </div>
                    @if($prospecto->documentos)
                        <div class="col-sm-4 text-center">
                            <a href="{{ route('prospectos.documentos.edit', ['prospecto' => $prospecto, 'documento' => $prospecto->documentos]) }}" class="btn btn-warning">
                                ✎<strong> Editar Documentación</strong>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @include('prospectos.documentos.index')
            </div>
        </div>
    </div>
</div>

@endsection