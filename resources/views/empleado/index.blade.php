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
						<th>Cargo</th>
						<th>Fecha de Alta</th>
						<th>Fecha de Baja</th>
						<th>Razón de Baja</th>
						@if($ver || $editar || $eliminar)
							<th>Acción</th>
						@endif
					</tr>  
					@foreach($empleados as $empleado)
						<tr>
							<td>{{ $empleado->id }} </td>
							<td>{{ $empleado->nombre }}</td>
							<td>{{ $empleado->paterno }}</td>
							<td>{{ $empleado->cargo }}</td>
							<td>{{ $empleado->created_at }}</td>
							<td>{{ $empleado->fechabaja ? $empleado->fechabaja : 'N/A' }}</td>
							<td>{{ $empleado->motivobaja ? $empleado->motivobaja : 'N/A' }}</td>
							@if($ver || $editar || $eliminar)
								<td class="text-center">
									@if($ver)
									<a href="{{ route('empleados.show', [$empleado]) }}" class="btn btn-primary">
										<i class="fa fa-eye"></i> Ver
									</a>
									@endif
									@if($editar)
									<a href="{{ route('empleados.edit',[$empleado]) }}" class="btn btn-warning">
										Editar
									</a>
									@endif
									@if($eliminar)
									<button type="button" class="btn btn-danger eliminar" data-toggle="modal" data-target="#exampleModal{{$empleado->id}}" id-empleado={{$empleado->id}}>Eliminar</button>
									{{-- <form action="{{url('empleados', [$empleado->id])}}" method="POST" class="mt-1">
										@csrf
										{{method_field('DELETE')}}
										<input type="hidden" value="{{$empleado->id}}">
										<button type="submit" class="btn btn-danger">
											Eliminar
										</button>
									</form> --}}

									{{-- Modal --}}
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

									@endif
								</td>
							@endif
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>





@endsection