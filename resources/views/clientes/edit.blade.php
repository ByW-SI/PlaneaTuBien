@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Cliente:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('clientes.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Cliente</strong>
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('clientes.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Clientes</strong>
                </a>
            </div>
        </div>
    </div>
    <form action="{{ route('clientes.update', ['cliente' => $cliente]) }}" method="post">
        {{ csrf_field() }}
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>✱Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required="" value="{{ $cliente->nombre }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Apellido Paterno:</label>
                    <input type="text" class="form-control" name="appaterno" required="" value="{{ $cliente->appaterno }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" name="apmaterno" value="{{ $cliente->apmaterno }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Asesor:</label>
                    <select name="empleado_id" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach($asesores as $asesor)
                            <option value="{{ $asesor->id }}"{{ $cliente->empleado_id == $asesor->id ? 'selected' : '' }}>{{ $asesor->nombre }} {{ $asesor->parterno }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>RFC:</label>
                    <input type="text" class="form-control" name="rfc" value="{{ $cliente->rfc }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Teléfono de Oficina:</label>
                    <input type="text" class="form-control" name="oficina" value="{{ $cliente->oficina }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Teléfono Móvil:</label>
                    <input type="text" class="form-control" name="celular" value="{{ $cliente->celular }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ $cliente->email }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" value="{{ $cliente->fecha_nacimiento }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Lugar de Nacimiento:</label>
                    <input type="text" class="form-control" name="lugar_nacimiento" value="{{ $cliente->lugar_nacimiento }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" value="{{ $cliente->nacionalidad }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control">
                        <option value="Hombre" {{ $cliente->sexo == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{ $cliente->sexo == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label>Edad:</label>
                    <input type="text" class="form-control" name="edad" value="{{ $cliente->edad }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Estado Civil:</label>
                    <select name="estado_civil" class="form-control">
                        <option value="Soltero" {{ $cliente->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                        <option value="Comprometido" {{ $cliente->estado_civil == 'Comprometido' ? 'selected' : '' }}>Comprometido</option>
                        <option value="Casado" {{ $cliente->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                        <option value="Unión Libre" {{ $cliente->estado_civil == 'Unión Libre' ? 'selected' : '' }}>Unión Libre</option>
                        <option value="Separado" {{ $cliente->estado_civil == 'Separado' ? 'selected' : '' }}>Separado</option>
                        <option value="Divorciado" {{ $cliente->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                        <option value="Viudo" {{ $cliente->estado_civil == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label>Profesión:</label>
                    <input type="text" class="form-control" name="profesion" value="{{ $cliente->profesion }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Empresa:</label>
                    <input type="text" class="form-control" name="empresa" value="{{ $cliente->empresa }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Puesto Actual:</label>
                    <input type="text" class="form-control" name="puesto_actual" value="{{ $cliente->puesto_actual }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Puesto Anterior:</label>
                    <input type="text" class="form-control" name="puesto_anterior" value="{{ $cliente->puesto_anterior }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Antigüedad:</label>
                    <input type="text" class="form-control" name="antiguo" value="{{ $cliente->antiguo }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>Ingreso:</label>
                    <input type="text" class="form-control" name="ingreso" value="{{ $cliente->ingreso }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Calle:</label>
                    <input type="text" class="form-control" name="calle" required="" value="{{ $cliente->calle }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Número Exterior:</label>
                    <input type="text" class="form-control" name="numext" required="" value="{{ $cliente->numext }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>Número Interior:</label>
                    <input type="text" class="form-control" name="numint" value="{{ $cliente->numint }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label>✱Colonia:</label>
                    <input type="text" class="form-control" name="colonia" required="" value="{{ $cliente->colonia }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Delegación:</label>
                    <input type="text" class="form-control" name="delegacion" required="" value="{{ $cliente->delegacion }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Estado:</label>
                    <input type="text" class="form-control" name="estado" required="" value="{{ $cliente->estado }}">
                </div>
                <div class="form-group col-sm-3">
                    <label>✱Código Postal:</label>
                    <input type="text" class="form-control" name="cp" required="" value="{{ $cliente->cp }}">
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