@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
		<div class="row">
			<div class="col-sm-3">
				<h4>Datos del Usuario:</h4>
			</div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('usuarios.edit', ['usuario' => $usuario]) }}" class="btn btn-warning">
                    ✎<strong> Editar Usuario</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a class="btn btn-success" href="{{ route('usuarios.create') }}">
                    <i class="fa fa-plus"></i><strong> Agregar Usuario</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Usuarios</strong>
                </a>
            </div>
		</div>
	</div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="control-label">Empleado:</label>
                <input type="text" name="nombre" class="form-control" value="{{ $usuario->empleado->nombre . ' ' . $usuario->empleado->appaterno . ' ' . $usuario->empleado->apmaterno }}" readonly="">
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">Nombre de Usuario:</label>
                <input type="text" name="usuario" class="form-control" value="{{ $usuario->name }}" readonly="">
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">Correo:</label>
                <input type="text" name="mail" class="form-control" value="{{ $usuario->email }}" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="control-label">Perfil:</label>
                <input type="text" name="perfil" class="form-control" value="{{ $usuario->perfil->nombre }}" readonly="">
            </div>
        </div>
    </div>
</div>
@endsection