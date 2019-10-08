@extends('principal')
@section('content')


<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Agentes:</h4>  
			</div>
			@php
			$ver = false;
			$editar = false;
			$eliminar = false;
			$crear = false;		
			foreach(Auth::user()->perfil->componentes as $c){
				if($c->nombre == "ver rh")
					$ver = true;
				
				if($c->nombre == "editar rh")
					$editar = true;
				
				if($c->nombre == "eliminar rh")
					$eliminar = true;
				if($c->nombre == "crear rh")
					$crear = true;
			}
			@endphp
			@if($crear)
				<div class="col-sm-4 text-center">
					<a href="{{ route('empleados.create') }}" class="btn btn-success">
						<i class="fa fa-plus"></i><strong> Agregar Agente</strong>
					</a>
				</div>
			@endif
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
					<table class="table table-bordered table-striped" id="listaEmpleados">
							<thead>
								<tr>
									<th class="text-center" scope="col">ID</th>
									<th class="text-center" scope="col">Nombre</th>
									<th class="text-center" scope="col">Apellido paterno</th>
									<th class="text-center" scope="col">Apellido materno</th>
									<th class="text-center" scope="col">Fecha de alta</th>
									<th class="text-center" scope="col">Jefe</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach($empleados as $key => $empleado)
								<tr class="text-center">
									<td>{{$empleado->id}}</td>
									<td>{{$empleado->nombre}}</td>
									<td>{{$empleado->paterno}}</td>
									<td>{{$empleado->materno}}</td>
									<td>{{$empleado->created_at}}</td>
									<td>{{$empleado->id_jefe ? $empleado->jefe->nombre." ". $empleado->jefe->paterno." ".$empleado->jefe->materno : "N/A"}}</td>
									<td>
										<a href="{{ route('empleados.show', [$empleado]) }}" class="btn btn-primary">
											<i class="fa fa-eye"></i> Ver
										</a>
										<a href="{{ route('empleados.edit',[$empleado]) }}" class="btn btn-warning">
											Editar
										</a>
										<button type="button" class="btn btn-danger eliminar" data-toggle="modal" data-target="#exampleModal{{$empleado->id}}" id-empleado={{$empleado->id}}>Eliminar</button>
										<div class="modal fade" id="exampleModal{{$empleado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="{{url('empleados', [$empleado->id])}}" method="POST" class="mt-1">
														@csrf
														{{method_field('DELETE')}}
														<div class="form-group">
															<label for="motivo" class="col-form-label">Motivo de la baja:</label>
															<input type="text" class="form-control" name="motivo">
														</div>
														<input type="hidden" name="empleado_id" value="{{$empleado->id}}">
														<button type="submit" class="btn btn-danger">
															Eliminar
														</button>
													</form>
												</div>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
			</div>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('#listaEmpleados').DataTable();
    } );
</script>


@endsection