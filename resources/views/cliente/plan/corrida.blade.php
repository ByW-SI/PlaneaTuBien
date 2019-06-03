@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		Corrida Financiera Para El Plan {{$plan->nombre}}
	</div>
	<div class="card-body">

		<div class="row">
			<div class="col-12">
				<h5>Bien: ${{number_format($cotizacion->monto,2)}}</h5>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center" scope="col">Meses</th>
						<th class="text-center" scope="col">Aportación</th>
						<th class="text-center" scope="col">Cuota de Administración</th>
						<th class="text-center" scope="col">IVA</th>
						<th class="text-center" scope="col">Seguro de vida</th>
						<th class="text-center" scope="col">Seguro de desastres</th>
						<th class="text-center" scope="col">Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">
							{{$plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['meses']}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['aportacion'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['cuota_administracion'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['iva'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['sv'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['sd'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}
						</td>
					</tr>
					<tr>
						<td class="text-center">
							{{$plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['meses']}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['aportacion'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['cuota_administracion'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['iva'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['sv'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['sd'],2)}}
						</td>
						<td class="text-center">
							${{number_format($plan->corrida_meses_fijos($cotizacion->monto,$cotizacion->factor_actualizacion)['adjudicado']['total'],2)}}
						</td>
					</tr>
				</tbody>
			</table>
			<div class="col-12">
				<h5>Aportaciones extraordinarías</h5>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th class="text-center" scope="col">Porcentaje</th>
						<th class="text-center" scope="col">Monto</th>
						<th class="text-center" scope="col">Mes</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">1</td>
						<td class="text-center">{{$plan->aportacion_1}}%</td>
						<td class="text-center">${{number_format($plan->monto_aportacion_1($cotizacion->monto),2)}}</td>
						<td class="text-center">{{$plan->mes_1}}</td>
					</tr>
					<tr>
						<td class="text-center">2</td>
						<td class="text-center">{{$plan->aportacion_2}}%</td>
						<td class="text-center">${{number_format($plan->monto_aportacion_2($cotizacion->monto),2)}}</td>
						<td class="text-center">{{$plan->mes_2}}</td>
					</tr>
					<tr>
						<td class="text-center">3</td>
						<td class="text-center">{{$plan->aportacion_3}}%</td>
						<td class="text-center">${{number_format($plan->monto_aportacion_3($cotizacion->monto),2)}}</td>
						<td class="text-center">{{$plan->mes_3}}</td>
					</tr>
					<tr>
						<td class="text-center">Liquidación</td>
						<td class="text-center">{{$plan->aportacion_liquidacion}}%</td>
						<td class="text-center">${{number_format($plan->monto_aportacion_liquidacion($cotizacion->monto),2)}}</td>
						<td class="text-center">{{$plan->mes_liquidacion}}</td>
					</tr>
					<tr>
						<td class="text-center">Semestral</td>
						<td class="text-center">{{$plan->semestral}}%</td>
						<td class="text-center">${{number_format($plan->monto_aportacion_semestral($cotizacion->monto),2)}}</td>
						<td class="text-center">Cada Junio y Diciembre</td>
					</tr>
					<tr>
						<td class="text-center">Anual</td>
						<td class="text-center">{{$plan->anual}}%</td>
						<td class="text-center">${{number_format($plan->monto_aportacion_anual($cotizacion->monto),2)}}</td>
						<td class="text-center">Cada Diciembre</td>
					</tr>
					
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-header">
		Contratos
	</div>
	<div class="card-body">
		<div class="row">
		 	@foreach ($cliente->recibo->contratos as $contrato)
	            @if ($contrato->checklist && $contrato->checklist->status)
					<div class="col-12">
						<h5>
							Contrato de folio: @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}} con valor de {{number_format($contrato->monto,2)}}
						</h5>
					</div>
	                <div class="col-12">
	                    <table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center" scope="col">Meses</th>
									<th class="text-center" scope="col">Aportación</th>
									<th class="text-center" scope="col">Cuota de Administración</th>
									<th class="text-center" scope="col">IVA</th>
									<th class="text-center" scope="col">Seguro de vida</th>
									<th class="text-center" scope="col">Seguro de desastres</th>
									<th class="text-center" scope="col">Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										{{$plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['meses']}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['aportacion'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['cuota_administracion'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['iva'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['sv'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['sd'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}
									</td>
								</tr>
								<tr>
									<td class="text-center">
										{{$plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['meses']}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['aportacion'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['cuota_administracion'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['iva'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['sv'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['sd'],2)}}
									</td>
									<td class="text-center">
										${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['adjudicado']['total'],2)}}
									</td>
								</tr>
							</tbody>
						</table>
	                </div>
	                <div class="col-12">
						<h5>Aportaciones extraordinarías</h5>
					</div>
					<div class="col-12">
						
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center" scope="col">#</th>
									<th class="text-center" scope="col">Porcentaje</th>
									<th class="text-center" scope="col">Monto</th>
									<th class="text-center" scope="col">Mes</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">1</td>
									<td class="text-center">{{$plan->aportacion_1}}%</td>
									<td class="text-center">${{number_format($plan->monto_aportacion_1($contrato->monto),2)}}</td>
									<td class="text-center">{{$plan->mes_1}}</td>
								</tr>
								<tr>
									<td class="text-center">2</td>
									<td class="text-center">{{$plan->aportacion_2}}%</td>
									<td class="text-center">${{number_format($plan->monto_aportacion_2($contrato->monto),2)}}</td>
									<td class="text-center">{{$plan->mes_2}}</td>
								</tr>
								<tr>
									<td class="text-center">3</td>
									<td class="text-center">{{$plan->aportacion_3}}%</td>
									<td class="text-center">${{number_format($plan->monto_aportacion_3($contrato->monto),2)}}</td>
									<td class="text-center">{{$plan->mes_3}}</td>
								</tr>
								<tr>
									<td class="text-center">Liquidación</td>
									<td class="text-center">{{$plan->aportacion_liquidacion}}%</td>
									<td class="text-center">${{number_format($plan->monto_aportacion_liquidacion($contrato->monto),2)}}</td>
									<td class="text-center">{{$plan->mes_liquidacion}}</td>
								</tr>
								<tr>
									<td class="text-center">Semestral</td>
									<td class="text-center">{{$plan->semestral}}%</td>
									<td class="text-center">${{number_format($plan->monto_aportacion_semestral($contrato->monto),2)}}</td>
									<td class="text-center">Cada Junio y Diciembre</td>
								</tr>
								<tr>
									<td class="text-center">Anual</td>
									<td class="text-center">{{$plan->anual}}%</td>
									<td class="text-center">${{number_format($plan->monto_aportacion_anual($contrato->monto),2)}}</td>
									<td class="text-center">Cada Diciembre</td>
								</tr>
								
							</tbody>
						</table>
					</div>
	            @endif
	        @endforeach
		</div>
	</div>
</div>
@endsection