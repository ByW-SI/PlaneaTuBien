@extends('principal')
@section('content')
<div class="card">
	<div class="card-header">
		Grupos {{$grupo->id}}:
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
				<label for="fecha_inicio">Fecha de inicio</label>
				<span class="form-control bg-light">{{date('d-m-Y', strtotime($grupo->fecha_inicio))}}</span>
			</div>
			<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
				<label for="vigencia">Vigencia del grupo</label>
				<div class="input-group mb-3">
					<span class="form-control bg-light">{{$grupo->vigencia}}</span>
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon2">Meses</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
				<label for="fecha_fin">Fecha de termino</label>
				<span class="form-control bg-light">{{date('d-m-Y', strtotime($grupo->fecha_fin))}}</span>
			</div>
			<div class="col-12 col-xs-12 col-md-6 col-lg-3 col-xl-3">
				<label for="contratos">Números de contratos</label>
				<div class="input-group mb-3">
					<div class="input-group-preppend">
						<span class="input-group-text" id="basic-addon2">#</span>
					</div>
					<span class="form-control bg-light">{{$grupo->contrato->count()}}</span>
				</div>
			</div>
		</div>
		{{-- <div class="row">
                <div class="col-4 offset-4 text-center">
                    <a href="{{ route('grupos.listcontratos', ['grupo' =>$grupo]) }}" class="btn btn-primary">
		Ver status de contratos
		</a>
	</div>
</div> --}}
<br>
<br>
<div class="d-flex justify-content-center">
	<h4>Planes dentro del grupo</h4>
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
			@forelse ($grupo->plans as $plan)
			<tr>
				<th scope="row">{{$plan->nombre}}</th>
				<td>{{$plan->plazo}} meses</td>
				<td>{{$plan->mes_aportacion_adjudicado}} meses</td>
				<td>{{$plan->aportacion_1.' en el mes #'.$plan->mes_1}}</td>
				<td>{{$plan->aportacion_2.' en el mes #'.$plan->mes_2}}</td>
				<td>{{$plan->aportacion_3.' en el mes #'.$plan->mes_3}}</td>
				<td>{{$plan->aportacion_liquidacion.' en el mes '.$plan->mes_liquidacion}}</td>
				<td>
					<div class="d-flex justify-content-center">
						<a href="{{ route('plans.show',['plan'=>$plan]) }}" class="btn btn-info mr-2"><i
								class="far fa-eye"></i>Ver</a>
					</div>
				</td>

			</tr>
			@empty
			<div class="alert alert-info" role="alert">
				Todavía no hay ningún plan <a href="{{ route('plans.create') }}" class="alert-link">haz click aquí</a>
				para agregar uno.
			</div>
			@endforelse
		</tbody>
	</table>
</div>
</div>
<div class="card-footer">
	<div class="row">
		<div class="col-4 offset-4 text-center">
			<a href="{{ route('grupos.index') }}" class="btn btn-success">
				Regresar
			</a>
		</div>

	</div>
</div>
</div>
@endsection