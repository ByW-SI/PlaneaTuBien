@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			<h5>PLANES</h5>
		</div>
		<div class="card-body">
			<div class="d-flex justify-content-center">
				<div class="w-50 input-group mb-3">
					<div class="input-group-prepend">
						<a class="btn btn-primary" href="{{ route('plans.create') }}" id="basic-addon2"><i class="fas fa-columns"></i> Nuevo plan</a>
					</div>
					<input type="search" class="form-control" placeholder="Busca el plan" aria-label="Buscar plan" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-info " id="basic-addon2"><i class="fas fa-search"></i> Buscar</button>
					</div>
				</div>
			</div>
			<div class="row">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Plazo</th>
							<th scope="col">Aporta</th>
							<th scope="col">Aportacion extraordinaria 1</th>
							<th scope="col">Aportacion extraordinaria 2</th>
							<th scope="col">Aportacion extraordinaria 3</th>
							<th scope="col">Aportacion extraordinaria Liquidación</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						@forelse ($planes as $plan)
							<tr>
								<th scope="row">{{$plan->nombre}}</th>
								<td>{{$plan->plazo}} meses</td>
								<td>{{$plan->mes_aportacion_adjudicado}} meses</td>
								<td>{{$plan->aportacion_1.' en el mes #'.$plan->mes_1}}</td>
								<td>{{$plan->aportacion_2.' en el mes #'.$plan->mes_2}}</td>
								<td>{{$plan->aportacion_3.' en el mes #'.$plan->mes_3}}</td>
								<td>{{$plan->aportacion_liquidacion.' en el mes #'.$plan->mes_liquidacion}}</td>
								<td>
									<div class="d-flex justify-content-center">
										<a href="{{ route('plans.show',['plan'=>$plan]) }}" class="btn btn-info mr-2"><i class="far fa-eye"></i>Ver</a>
										<a href="" class="btn btn-danger mr-2"><i class="fas fa-level-down-alt"></i>Dar de baja</a>
									</div>
								</td>

							</tr>
						@empty
							<div class="alert alert-info" role="alert">
							  	Todavía no hay ningún plan <a href="{{ route('plans.create') }}" class="alert-link">haz click aquí</a> para agregar uno.
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection