@extends('principal')
@section('content')

<div class="container">
    {{-- Formulario para el nuevo usuario --}}
    <div class="card" id="formularioNuevoUsuario" style="display: none">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Datos del Usuario:</h4>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                        <i class="fa fa-bars"></i><strong> Lista de Usuarios</strong>
                    </a>
                </div>
            </div>
        </div>
        <form action="{{ route('usuarios.store') }}" method="post">    
            {{ csrf_field() }}
            {{-- Formulario para agregar al posible usuario --}}
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <input type="hidden" class="form-control" name="empleado_id" id="empleado_id">
                    <div class="form-group col-sm-4">
                        <label class="control-label">✱Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control" required readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label">Apellido paterno:</label>
                        <input type="text" name="paterno" id="paterno" class="form-control" required readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label">✱Apellido materno:</label>
                        <input type="text" name="materno" id="materno" class="form-control" required readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label">✱Contraseña:</label>
                        <input type="text" name="password" class="form-control" required="">
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label">✱Perfil:</label>
                        <select class="form-control" name="perfil_id" required>
                            <option selected="" value="">Seleccionar</option>
                            @foreach($perfiles as $perfil)
                                <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                            @endforeach
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
    <br>
    {{-- Lista de empleados no usuarios --}}
    <div class="card">
        <div class="card-header">Empleados</div>
        {{-- Lista de empleados no usuarios--}}
        <div class="card-body">
            @if(count($empleadosNoUsuarios) > 0)
            <table class="table table-hover table-striped table-bordered" style="margin-bottom: 0;">
                <tr class="info">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>RFC</th>
                    <th>Acción</th>
                </tr>
                @foreach($empleadosNoUsuarios as $key => $empleado)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->paterno}}</td>
                        <td>{{$empleado->materno}}</td>
                        <td>{{$empleado->rfc}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success text-white agregarUsuario" id-empleado={{$empleado->id}}>
                                <i class="fa fa-plus"></i> Agregar usuario
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <h4>Todos tus empleados ya tienen una cuenta de usuario.</h4>
            @endif
        </div>
        <div class="card-footer">Footer</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(".agregarUsuario").on("click", function(){
        // alert('works');
        // alert($(this).attr('id-empleado'));

        const base_url = document.location.origin;
		var empleado_id = $(this).attr('id-empleado');

        $.ajax({
			url: base_url+'/api/empleados/'+empleado_id,
			type: 'GET',
			contentType: "application/json",
			success: function(empleado){
				// alert(empleado.id);
                // $('#fullname').val(empleado.id);
                $('#empleado_id').val(empleado.id);
                $('#name').val(empleado.nombre);
                $('#paterno').val(empleado.paterno);
                $('#materno').val(empleado.materno);
                $('#formularioNuevoUsuario').show('slow');
			},
			error: function(error){
				alert('ERROR');
			}
		});

    });
</script>

@endsection