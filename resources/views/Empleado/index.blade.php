@extends('principal')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Agentes:</h4>  
			</div>
			<div class="col-sm-4 text-center">
				<a href="{{ route('empleados.create') }}" class="btn btn-success">
					<i class="fa fa-plus"></i><strong> Agregar Agente</strong>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row ">
			<div class="form-group col-sm-4 offset-sm-4">
                <div class="input-group">
					<input class="form-control" type="text" placeholder="Buscar...">
                    <div class="input-group-append">
						<button class="btn btn-default">
							<i class="fa fa-search"></i>
						</button>
                    </div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px">
					<tr class="info">
						<th>ID</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Fecha de Alta</th>
						<th>Fecha de Baja</th>
						<th>Razón de Baja</th>
						<th>Acción</th>
					</tr>  
					@foreach($empleados as $empleado)
						<tr>
							<td>{{ $empleado->id }} </td>
							<td>{{ $empleado->nombre }}</td>
							<td>{{ $empleado->paterno }}</td>
							<td>{{ $empleado->created_at }}</td>
							<td>{{ $empleado->fechabaja ? $empleado->fechabaja : 'N/A' }}</td>
							<td>{{ $empleado->motivobaja ? $empleado->motivobaja : 'N/A' }}</td>
							<td class="text-center">
								<a href="{{ route('empleados.show', [$empleado]) }}" class="btn btn-primary">
									<i class="fa fa-eye"></i> Ver
								</a>
								<a href="{{ route('empleados.edit',[$empleado]) }}" class="btn btn-warning">
									✎ Editar
								</a>
								<button type="button" class="btn btn-danger disabled">
									<i class="fa fa-times"></i> Baja
								</button>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>

@endsection