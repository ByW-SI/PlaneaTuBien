@extends('principal')
@section('content')
	<div class="card card-default">
		<div class="card-header">
			<div class="d-flex justify-content-around">
				<div class="col-10">
					<h3 class="title">
						Promociones
					</h3>
				</div>
				<div class="col">
					<a class="btn btn-primary" href="{{ route('promocions.create') }}" role="button"><i class="fas fa-plus"></i> Nueva Promoción</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row-group">
				<div class="d-flex justify-content-center">
					<form action="{{ route('promocions.index') }}" method="GET">
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
						<tr class="table-primary">
							<th scope="col">Nombre</th>
							<th scope="col">Descripción</th>
							<th scope="col">Validez</th>
							<th scope="col">Monto de descuento</th>
							<th scope="col">Tipo de descuento</th>
							<th scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($promociones as $promocion)
						<tr>
							<th scope="row">{{$promocion->nombre}}</th>
							<th>{{$promocion->descripcion}}</th>
							<th>{{date('d-m-Y', strtotime($promocion->valido_inicio))}} a {{date('d-m-Y', strtotime($promocion->valido_fin))}}</th>
							<th>{{$promocion->tipo_monto == "porcentaje" ? "$promocion->monto %" : "$ $promocion->monto MXN"}}</th>
							<th>{{$promocion->tipo_promocion->nombre}}</th>
							<th>
								<div class="row justify-content-around">
									<a href="{{ route('promocions.edit',['promocion'=>$promocion]) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
									<form id="delete-{{$promocion->id}}" action="{{ route('promocions.destroy',['promocion'=>$promocion]) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									</form>
									<a href="{{ route('promocions.destroy',['promocion'=>$promocion]) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-{{$promocion->id}}').submit();"><i class="fas fa-trash"></i> Eliminar</a>
								</div>
							</th>
						</tr>
						@empty
							<div class="alert alert-warning" role="alert">
								No se encontraron promociones
							</div>
						@endforelse
					</tbody>
				</table>
				{{$promociones->links()}}
			</div>
		</div>
	</div>
@endsection