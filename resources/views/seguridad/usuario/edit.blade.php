@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
		<div class="row">
            <div class="col-sm-4">
                <h4>Datos del Usuario aqui:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a class="btn btn-success" href="{{ route('usuarios.create') }}">
                    <i class="fa fa-plus"></i><strong> Agregar Usuario</strong>
                </a>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Usuarios</strong>
                </a>
            </div>
		</div>
	</div>
    <form action="{{ route('usuarios.update', ['id' => $usuario->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-4" style="display:none">
                    <label class="control-label">✱Empleado:</label>
                    <select class="form-control" name="empleado_id" required="">
                        <option selected="">Seleccionar</option>
                        @foreach($empleados as $empleado)
                            <option value="{{ $empleado->id }}" {{ $empleado->id == $usuario->empleado->id ? ' selected=""' : ''}}>{{ $empleado->nombre . " " . $empleado->paterno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-4" style="display:none">
                    <label class="control-label">✱Nombre de Usuario:</label>
                    <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required="">
                </div>
                <div class="form-group col-sm-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$usuario->empleado->nombre}}" readonly>
                </div>
                <div class="form-group col-sm-4">
                    <label for="nombre">Apellido paterno</label>
                    <input type="text" name="paterno" class="form-control" value="{{$usuario->empleado->paterno}}" readonly>
                </div>
                <div class="form-group col-sm-4">
                    <label for="nombre">Apellido materno</label>
                    <input type="text" name="materno" class="form-control" value="{{$usuario->empleado->materno}}" readonly>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">Correo:</label>
                    <input type="text" name="email" class="form-control" value="{{$usuario->empleado->email}}" readonly required>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">✱Perfil:</label>
                    <select class="form-control" name="perfil_id" required="">
                        <option>Seleccionar</option>
                        @foreach($perfiles as $perfil)
                            <option value="{{ $perfil->id }}"{{ $perfil->id == $usuario->perfil_id ? ' selected' : '' }}>{{ $perfil->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">Contraseña:</label>
                    <input type="text" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar." value="">
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