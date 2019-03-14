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
					<div class="col-12">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Buscar" name="buscar" aria-label="Buscar" value="{{$buscar}}" aria-describedby="basic-addon1">
							<div class="input-group-append">
								<button type="submit" class="btn btn-info" id="basic-addon1"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row-group">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th scope="col" class="text-center">Cliente</th>
						<th scope="col" class="text-center">Estado</th>
						<th scope="col" class="text-center">Calificacion</th>
						<th scope="col" class="text-center">Acción</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($prospectos as $prospecto)
						<tr>
							<td scope="col" class="text-center">
								<ul>
									<strong>Nombre: </strong>
									{{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
									
								</ul>
								<ul>
									<strong>Telefono: </strong>
									{{$prospecto->tel}}
								</ul>
							</td>
							<td class="text-center">
								@if ($prospecto->aprobado == 1)
									Aprobado
								@elseif($prospecto->aprobado == null)
									Sin definir
								@else
									No aprobado
								@endif
							</td>
							<td class="text-center">
								{{$prospecto->calificacion ? $prospecto->calificacion : "Sin calificar"}}
							</td>
							<td>
								<div class="row justify-content-around">
									<a class="btn btn-info" href="{{ route('empleados.prospectos.show',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"><i class="far fa-eye"></i><strong> Ver</strong></a>
									@if ($prospecto->perfil)
										<a href="{{ route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]) }}" class="btn btn-success" id="basic-addon1">
											<i class="fas fa-file-invoice"></i>
											<strong> Perfil</strong>
										</a>
									
									@endif
									<a class="btn btn-success" href="{{ route('empleados.prospectos.crms.index',['empleado'=>$empleado,'prospecto'=>$prospecto]) }}"><i class="far fa-calendar-alt"></i><strong> CRM</strong></a>
								</div>
							</td>
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
@endsection