@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Cliente:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('clientes.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Clientes</strong>
                </a>
            </div>
        </div>
    </div>
    <form action="{{ route('clientes.store') }}" method="post">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>✱Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Apellido Paterno:</label>
                    <input type="text" class="form-control" name="appaterno" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" name="apmaterno">
                </div>
                <div class="form-group col-sm-3">
                    <label>Asesor:</label>
                    <select name="empleado_id" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach($asesores as $asesor)
                            <option value="{{ $asesor->id }}">{{ $asesor->nombre }} {{ $asesor->parterno }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>RFC:</label>
                    <input type="text" class="form-control" name="rfc">
                </div>
                <div class="form-group col-sm-3">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="telefono">
                </div>
                <div class="form-group col-sm-3">
                    <label>Teléfono de Oficina:</label>
                    <input type="text" class="form-control" name="oficina">
                </div>
                <div class="form-group col-sm-3">
                    <label>Teléfono Móvil:</label>
                    <input type="text" class="form-control" name="celular">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Email:</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group col-sm-3">
                    <label>Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nacimiento">
                </div>
                <div class="form-group col-sm-3">
                    <label>Lugar de Nacimiento:</label>
                    <input type="text" class="form-control" name="lugar_nacimiento">
                </div>
                <div class="form-group col-sm-3">
                    <label>Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control">
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label>Edad:</label>
                    <input type="text" class="form-control" name="edad">
                </div>
                <div class="form-group col-sm-3">
                    <label>Estado Civil:</label>
                    <select name="estado_civil" class="form-control">
                        <option value="Soltero">Soltero</option>
                        <option value="Comprometido">Comprometido</option>
                        <option value="Casado">Casado</option>
                        <option value="Unión Libre">Unión Libre</option>
                        <option value="Separado">Separado</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Viudo">Viudo</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label>Profesión:</label>
                    <input type="text" class="form-control" name="profesion">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Empresa:</label>
                    <input type="text" class="form-control" name="empresa">
                </div>
                <div class="form-group col-sm-3">
                    <label>Puesto Actual:</label>
                    <input type="text" class="form-control" name="puesto_actual">
                </div>
                <div class="form-group col-sm-3">
                    <label>Puesto Anterior:</label>
                    <input type="text" class="form-control" name="puesto_anterior">
                </div>
                <div class="form-group col-sm-3">
                    <label>Antigüedad:</label>
                    <input type="text" class="form-control" name="antiguo">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Ingreso:</label>
                    <input type="text" class="form-control" name="ingreso">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Calle:</label>
                    <input type="text" class="form-control" name="calle" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Número Exterior:</label>
                    <input type="text" class="form-control" name="numext" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>Número Interior:</label>
                    <input type="text" class="form-control" name="numint">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>✱Colonia:</label>
                    <input type="text" class="form-control" name="colonia" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Delegación:</label>
                    <input type="text" class="form-control" name="delegacion" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Estado:</label>
                    <input type="text" class="form-control" name="estado" required="">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Código Postal:</label>
                    <input type="text" class="form-control" name="cp" required="">
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