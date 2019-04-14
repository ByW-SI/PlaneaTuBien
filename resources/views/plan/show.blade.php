@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			<h5>
				{{$plan->nombre}}
			</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-6">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Inscripción</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->aportacion_2}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Cuota de administración</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->cuota_admon}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Seguro de vida</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->s_v}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Seguro de desempleo</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->s_d}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 form-group">
							<label for="aportacion" class="mt-2">Inicio de aportación adjudicatario</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->mes_aportacion_adjudicado}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">Meses</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 form-group">
							<label for="aportacion">Mes en el que se completan adjudicación</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->mes_adjudicado}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">Meses</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Aportación extraordinaria 1</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->aportacion_1}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon2">#</span>
								</div>
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->mes_1}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">Mes</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Aportación extraordinaria 2</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->aportacion_2}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon2">#</span>
								</div>
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->mes_2}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">Mes</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class=" mt-2">Aportación extraordinaria 3</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->aportacion_3}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon2">#</span>
								</div>
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->mes_3}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">Mes</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion">Aportación extraordinaria de liquidación</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->aportacion_liquidacion}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon2">#</span>
								</div>
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->mes_liquidacion}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">Mes</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class="mt-2">Semestral</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->semestral}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon2">Total</span>
								</div>
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->semestral*10}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<label for="aportacion" class="mt-2">Anual</label>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->anual}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
							
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon2">Total</span>
								</div>
								<span class="form-control bg-light text-center" for="aportacion">{{$plan->anual*10}}</span>
								<div class="input-group-append">
									<span class="input-group-text " id="basic-addon2">%</span>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="card-footer"></div>
	</div>
@endsection