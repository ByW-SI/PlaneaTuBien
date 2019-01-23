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
                </div>
            </div>
            <form action="{{ route('prospectos.documentos.store', ['prospecto' => $prospecto]) }}" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Fecha de nacimiento:</label>
                            <input type="date" name="nacimiento" class="form-control" required="">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Nacionalidad:</label>
                            <input type="text" name="nacionalidad" class="form-control" required="">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Lugar de nacimiento:</label>
                            <input type="text" name="lugar" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Estado civil:</label>
                            <select name="civil" class="form-control" required="">
                                <option value="">Seleccionar</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Profesión:</label>
                            <input type="text" name="profesion" class="form-control" required="">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Empresa:</label>
                            <input type="text" name="empresa" class="form-control" required="">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">✱Puesto actual:</label>
                            <input type="text" name="actual" class="form-control" required="">
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="control-label">Puesto anterior:</label>
                            <input type="text" name="anterior" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label class="control-label">Antigüedad:</label>
                            <input type="text" name="antiguo" class="form-control">
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
    </div>
</div>

@endsection