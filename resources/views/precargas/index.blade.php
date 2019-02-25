@extends('principal')
@section('content')
	<div class="card card-default">
		<div class="card-header">
			<div class="d-flex justify-content-around">
				<div class="col-10">
					<h3 class="title">
						{{$titulo}}
					</h3>
				</div>
				<div class="col">
					<a class="btn btn-primary" href="{{ route($agregar) }}" role="button"><i class="fas fa-plus"></i> Nuevo</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row-group">
				<div class="d-flex justify-content-center">
					<form action="{{ route($index) }}" method="GET">
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
							<th scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($precargas as $precarga)
							<th scope="row">{{$precarga->nombre}}</th>
							<th>{{$precarga->descripcion}}</th>
							<th>
								<div class="row justify-content-around">
									<a href="{{ route($editar,['precarga'=>$precarga]) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
									<form id="delete-{{$precarga->id}}" action="{{ route($borrar,['precarga'=>$precarga]) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
									</form>
									<a href="{{ route($borrar,['precarga'=>$precarga]) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-{{$precarga->id}}').submit();"><i class="fas fa-trash"></i> Eliminar</a>
								</div>
							</th>
						@empty
							<div class="alert alert-warning" role="alert">
								No se encontraron registros
							</div>
						@endforelse
					</tbody>
				</table>
				{{$precargas->links()}}
			</div>
		</div>
	</div>
@endsection