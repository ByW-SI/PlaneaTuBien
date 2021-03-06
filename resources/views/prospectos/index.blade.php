@extends('principal')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-4">
				<h4>Prospectos:</h4>
			</div>
			<div class="col-sm-4 text-center">
				<a href="{{ route('prospectos.create') }}" class="btn btn-success">
					<i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				@if(count($prospectos) > 0)
					<table class="table table-bordered table-hover table-stripped display" id="tablaProspectos">
						<thead>
							<tr class="table-primary">
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Email</th>
								<th>Asesor</th>
								<th>Asignar asesor</th>
								<th>Cotización</th>
								<th scope="col" class="text-center">CRM</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
							@foreach($prospectos as $prospecto)
								<tr>
									<td>{{ $prospecto->nombre }}</td>
									<td>{{ $prospecto->appaterno }}</td>
									<td>{{ $prospecto->apmaterno ? $prospecto->apmaterno : 'N/A' }}</td>
									<td>{{ $prospecto->email ? $prospecto->email : 'N/A' }}</td>
									<td>{{$prospecto->asesor ? $prospecto->asesor->nombre." ".$prospecto->asesor->paterno." ".$prospecto->asesor->materno : "Sin asignar"}}</td>
									<td>
										@if (!$prospecto->asesor && (Auth::user()->empleado->cargo == '' || Auth::user()->empleado->cargo == 'Supervisor'))
											<a href="{{ route('prospectos.asesor.create',['prospecto'=>$prospecto]) }}" class="btn btn-sm btn-success"><i class="fas fa-user-tie"></i> Asignar asesor</a>
										@endif
									</td>
									<td>
				                        <a href="{{ route('empleados.prospectos.cotizacions.create', ['empleado'=>Auth::user()->empleado,'prospecto' => $prospecto]) }}" class="btn btn-sm btn-success">
				                            <i class="fa fa-plus"></i><strong> Cotización</strong>
				                        </a>
									</td>
									<td>
										<a class="btn btn-sm btn-success" href="{{ route('empleados.prospectos.crms.index',['empleado'=>Auth::user()->empleado,'prospecto'=>$prospecto]) }}"><i class="far fa-calendar-alt"></i><strong> CRM</strong></a>
									</td>
									<td class="text-center">
										@foreach(Auth::user()->perfil->componentes as $componente)
											@if ($componente->nombre == "ver prospecto")
											<a href="{{ route('prospectos.show', ['prospecto' => $prospecto]) }}" class="btn btn-sm btn-primary">
												<i class="fa fa-eye"></i> Ver
											</a>
											@endif
										@endforeach
										@foreach(Auth::user()->perfil->componentes as $componente)
											@if ($componente->nombre == "editar prospecto")
											<a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-sm btn-warning">
												✎ Editar
											</a>
											@endif
										@endforeach
										@if ($prospecto->perfil)
											<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-sm btn-success" id="basic-addon1">
												<i class="fas fa-file-invoice"></i>
												<strong> Perfil</strong>
											</a>
											<a href="{{ route('prospectos.presolicitud.index',['prospecto'=>$prospecto]) }}" class="btn btn-sm btn-success" id="basic-addon1">
												<i class="fas fa-file-contract"></i>
												<strong> Presolicitud</strong>
											</a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<h4>No hay prospectos disponibles.</h4>
				@endif
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script>
	$(document).ready(function() {
		$('#tablaProspectos').DataTable({
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
	} );
</script>

@endsection