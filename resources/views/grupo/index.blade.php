@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			<h5>Grupos</h5>
		</div>
		<div class="card-body">
			<div class="d-flex justify-content-center">
				<div class="w-50 input-group mb-3">
					<div class="input-group-prepend">
						<a class="btn btn-primary" href="{{ route('grupos.create') }}" id="basic-addon2"><i class="fas fa-columns"></i> Nuevo grupo</a>
					</div>
					<input type="date" class="form-control" placeholder="desde" aria-label="Buscar plan" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<span class="input-group-text">
							hasta
						</span>
					</div>
					<input type="date" class="form-control" placeholder="desde" aria-label="Buscar plan" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-info " id="basic-addon2"><i class="fas fa-search"></i> Buscar</button>
					</div>
				</div>
			</div>
			<div class="row">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th scope="col">Número de grupo</th>
							<th scope="col">Fecha de inicio</th>
							<th scope="col">Fecha de termino</th>
							<th scope="col">Vigencia</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						@forelse ($grupos as $grupo)
							<tr>
								<th scope="row">{{$grupo->id}}</th>
								<td>{{$grupo->fecha_inicio}}</td>
								<td>{{$grupo->fecha_fin}}</td>
								<td>{{$grupo->vigencia.' meses'}}</td>
								<td>
									<div class="d-flex justify-content-center">
										<a href="{{ route('grupos.show',['grupo'=>$grupo]) }}" class="btn btn-info mr-2"><i class="far fa-eye"></i>Ver</a>
										{{-- <a href="" class="btn btn-danger mr-2"><i class="fas fa-level-down-alt"></i>Dar de baja</a> --}}
									</div>
								</td>

							</tr>
						@empty
							<div class="alert alert-info" role="alert">
							  	Todavía no hay ningún grupo <a href="{{ route('grupos.create') }}" class="alert-link">haz click aquí</a> para agregar uno.
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection