@extends('principal')
@section('content')
<div class="card card-default">
	<div class="card-header">
		<h4>Prospectos de {{$empleado->nombre." ".$empleado->paterno." ".$empleado->materno}}</h4>
	</div>
	<div class="card-body">
		<div class="row-group">
			<div class="d-flex justify-content-center">
				<form action="{{ route('empleados.prospectos.index',['empleado'=>$empleado]) }}" method="GET">
					@csrf
					{{-- <div class="col-12">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Buscar" name="buscar" aria-label="Buscar" value="{{$buscar}}" aria-describedby="basic-addon1">
							<div class="input-group-append">
								<button type="submit" class="btn btn-info" id="basic-addon1"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div> --}}
				</form>
			</div>
		</div>
		<div class="row-group">
			<table class="table table-striped table-bordered" id="prospectos-table">
				<thead>
					<tr>
						<th scope="col" class="text-center">Id</th>
						<th scope="col" class="text-center">Cliente</th>
						<th scope="col" class="text-center">Asesor</th>
						<th scope="col" class="text-center">Teléfono</th>
						<th scope="col" class="text-center">Estado</th>
						<th scope="col" class="text-center">Ver</th>
						<th scope="col" class="text-center">Editar</th>
						{{-- <th scope="col" class="text-center">Perfil</th>
						<th scope="col" class="text-center">Presolicitud</th>
						<th scope="col" class="text-center">CRM</th>
						<th scope="col" class="text-center">Cotización</th>
						<th scope="col" class="text-center">Acción</th> --}}
					</tr>
				</thead>
				<tbody>
					@forelse ($prospectos as $prospecto)
						<tr>
							<td>{{$prospecto->id}}</td>
							<td scope="col" class="text-center">
								{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
							</td>
							<td>
								{{$prospecto->asesor ? $prospecto->asesor->nombre : 'N/D'}}
							</td>
							<td>{{$prospecto->celular}}</td>
							<td class="text-center">
								@if ($prospecto->empleado_id != null)
									Seguimiento Llamada									
								@else
									Sin asesor
								@endif
							</td>
							<td class="text-center">
								<a class="btn btn-info" href="{{ route('empleados.prospectos.show',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"><i class="far fa-eye"></i><strong> Ver</strong></a>
							</td>
							<td class="text-center">
								<a class="btn btn-warning" href="{{ route('empleados.prospectos.edit',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}">✎<strong> Editar</strong></a>
							</td>
							{{-- <td class="text-center">
								@if ($prospecto->perfil)
									<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
										<i class="far fa-eye"></i>
										<strong> Perfil</strong>
									</a>
								@else
									<a href="{{ route('crear-perfil-sin-cotizacion',['prospecto'=>$prospecto]) }}" class="btn btn-success">
										<i class="fa fa-plus"></i>
										Perfil
									</a>
								@endif
							</td>
							<td class="text-center">
								@if ($prospecto->perfil)
									<a href="{{ route('prospectos.presolicitud.index',['prospecto'=>$prospecto]) }}" class="btn btn-info" id="basic-addon1">
										<i class="far fa-eye"></i>
										<strong> Presolicitud</strong>
									</a>
								@endif
							</td>
							<td class="text-center">
								<a class="btn btn-success" href="{{ route('empleados.prospectos.crms.create',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"><i class="fa fa-plus"></i><strong> CRM</strong></a>
							</td>
							<td>
								<a href="{{ route('empleados.prospectos.cotizacions.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-sm btn-success">
		                            <i class="fa fa-plus"></i><strong> Cotización</strong>
		                        </a>
							</td>
							<td class="text-center">
								<div class="row justify-content-around">
									@if ($prospecto->cotizaciones->first())
										@if($prospecto->cotizaciones->first()->plan()->first()->tipo === 'libre')
											<a href="{{ route('cambio-plan', ['prospecto'=>$prospecto]) }}" class="btn btn-success">Cambiar Plan</a>
										@endif
									@endif
								</div>
							</td> --}}
						</tr>
					@empty
						<div class="alert alert-warning" role="alert">
							No se encontraron registros
						</div>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
	$(document).ready(function() {
		// console.log($('#corrdia'));
		$('#prospectos-table').DataTable();
	} );
</script>

@endsection