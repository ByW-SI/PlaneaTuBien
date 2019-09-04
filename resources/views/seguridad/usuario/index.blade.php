@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Usuarios:</h4>
			</div>
            <div class="col-sm-4 text-center">
                <a class="btn btn-success" href="{{ route('usuarios.create') }}">
                    <i class="fa fa-plus"></i><strong> Agregar Usuario</strong>
                </a>
            </div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
            <div class="col-sm-12">
                @if(count($usuarios) > 0)
                    <table class="table table-hover table-striped table-bordered" style="margin-bottom: 0;">
                        <tr class="info">
                            <th style="width: 10%;">Perfil</th>
                            <th style="width: 25%;">Nombre</th>
                            <th style="width: 20%;">Correo</th>
                            <th style="width: 20%;">Puesto</th>
                            <th style="width: 25%;">Acciones</th>
                        </tr>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->perfil ? $usuario->perfil->nombre : null }}</td>
                                <td>{{ $usuario->empleado->nombre . ' ' . $usuario->empleado->paterno }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->empleado->tipo }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('usuarios.show', ['usuario' => $usuario]) }}">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('usuarios.edit', ['usuario' => $usuario]) }}">
                                        ✎ Editar
                                    </a>
                                    <form method="post" action="{{ route('usuarios.destroy', ['usuario' => $usuario]) }}" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-times"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4>No hay usuarios disponibles.</h4>
                @endif
            </div>
		</div>
	</div>
</div>

@endsection