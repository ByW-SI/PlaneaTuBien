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
                        <a class="nav-link" href="{{ route('prospectos.documentos.index', ['prospecto' => $prospecto]) }}">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.prestamos.index', ['prospecto' => $prospecto]) }}">Préstamos</a>
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
                        <h5>Préstamos:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.prestamos.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Préstamo</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($prospecto->prestamos) > 0)
                    <table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                        <tr class="info">
                            <th>Préstamo</th>
                            <th>Meses</th>
                            <th>Total</th>
                        </tr>
                        @foreach($prospecto->prestamos as $prestamo)
                            <tr>
                                <td>${{ $prestamo->prestamo }}</td>
                                <td>{{ $prestamo->meses }} meses</td>
                                <td>${{ $prestamo->prestamo * 1.1 }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4>No hay préstamos disponibles.</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection