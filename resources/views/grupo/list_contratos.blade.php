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
					  <span class="form-control bg-light">{{$grupo->contratos}}</span>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-center">
				<h4>Contratos del grupo</h4>
			</div>
			<div class="row">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th scope="col">Número de contrato</th>
							<th scope="col">Monto</th>
							<th scope="col">Estado</th>
							<th scope="col">Recibo</th>
							<th scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($contratos as $contrato)
							<tr>
								<th scope="row">{{$contrato->numero_contrato}}</th>
								<td>${{$contrato->monto}}</td>
								<td>{{$contrato->estado}}</td>
								<td>{{!$contrato->recibo ? : $contrato->recibo->numero}}</td>
								<td>
									<div class="d-flex justify-content-center">
											{{-- {{route('grupos.listpagos',['contrato'=>$contrato]) }} --}}
										<a href="#" class="btn btn-info mr-2"><i class="far fa-eye"></i>Ver</a>
									</div>
								</td>
							</tr>
						@empty
							<div class="alert alert-info" role="alert">
							  	Todavía no hay ningún contrato <a href="{{ route('plans.create') }}" class="alert-link">haz click aquí</a> para agregar uno.
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		{{ $contratos->links() }}
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