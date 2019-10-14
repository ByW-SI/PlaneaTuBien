@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			Cotizador
		</div>
		<div class="card-body">
			<form method="GET" action="{{ route('cotizador') }}">
				<div class="row form-row align-items-center">
					<div class="col-auto">
						<label class="sr-only" for="inlineFormInputMonto">Monto</label>
						<input type="number" name="monto" min="300000" max="20000000" step="50000" value="{{$request->monto}}" class="form-control mb-2 mr-sm-2" id="inlineFormInputMonto" placeholder="Monto">
					</div>
					<div class="col-auto">
						<label class="sr-only" for="plan">Plan</label>
						<select name="plan" id="plan" class="form-control mb-2 mr-sm-2" placeholder="Plan a contratar">
							<option value="">Seleccione un plan</option>
							@foreach ($planes as $plan)
								<option value="{{$plan->id}}" {{$plan_select && $request->plan == $plan_select->id ? 'selected=""' : ''}}>{{$plan->nombre}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-primary mb-2">Cotizar</button>
					</div>
				</div>
			</form>
			@if ($res)
				<div class="row">
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<h4>{{$plan_select->nombre}}</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto contratado</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($request->monto,2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Plazo</label>
						<div class="input-group mb-3">
							<span class="form-control bg-light">{{$plan_select->plazo}}</span>
							<div class="input-group-append">
								<span class="input-group-text">meses</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Aportaciones extraordinarias</label>
						<div class="input-group mb-3">
							<span class="form-control bg-light">{{$res['aportaciones_extraordinarias']}}</span>
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto a financiar</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['monto_financiar']),2}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Cuota de administración</label>
						<div class="input-group mb-3">
							<span class="form-control bg-light">{{$plan_select->cuota_admon}}</span>
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto a adjudicar</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{$plan_select->abreviatura == "TC"  ? number_format($plan_select->monto_adjudicar_tc($request->monto),2) : number_format($res['monto_adjudicar'],2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Aportación integrante</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['aportacion_integrante'],2)}}</span>
						</div>
					</div>
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC")
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Aportación adjudicado</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['aportacion_adjudicado'],2)}}</span>
						</div>
					</div>
					@endif
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Cuota periodica integrante</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['cuota_periodica_integrante'],2)}}</span>
						</div>
					</div>
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC")
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Cuota periodica adjudicado</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['cuota_periodica_adjudicado'],2)}}</span>
						</div>
					</div>
					@endif
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Total aportaciones en mensualidades</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['total_aportacion_en_mensualidades'],2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Total aportaciones extraordinarias</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['total_aportaciones_en_extraordin'],2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Total de aportaciones</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['total_aportacion'],2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Total de cuota de administración</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['total_cuota_administracion'],2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto de aportación extraordinaría 1</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_aportacion_1($request->monto),2)}}</span>
						</div>
					</div>
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC")
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto de aportación extraordinaría 2</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_aportacion_2($request->monto),2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto de aportación extraordinaría 3</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_aportacion_3($request->monto),2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto de aportación liquidación</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_aportacion_liquidacion($request->monto),2)}}</span>
						</div>
					</div>
					@endif
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto de aportación anual</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_aportacion_anual($request->monto),2)}}</span>
						</div>
					</div>
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC")
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto de aportación semestral</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_aportacion_semestral($request->monto),2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto cuota periodica integrante</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_cuota_periodica_integrante($request->monto),2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto cuota periodica adjudicado</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_cuota_periodica_adjudicado($request->monto),2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto derecho de adjudicación</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_derecho_adjudicacion($request->monto),2)}}</span>
						</div>
					</div>
					@endif
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Monto total a pagar</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_total_pagar($request->monto),2)}}</span>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
						<label for="">Sobrecosto anual</label>
						<div class="input-group mb-3 mt-3">
							<span class="form-control bg-light">{{$plan_select->sobrecosto_anual($request->monto)}}</span>
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center" scope="col">
									#
								</th>
								<th class="text-center" scope="col">
									Mes
								</th>
								<th class="text-center" scope="col">
									Aportación
								</th>
								<th class="text-center" scope="col">
									Cuota de Administración
								</th>
								<th class="text-center" scope="col">
									IVA
								</th>
								<th class="text-center" scope="col">
									Seguro de vida
								</th>
								<th class="text-center" scope="col">
									Seguro de desastres
								</th>
								<th class="text-center" scope="col">
									Total
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($res['corrida'] as $key=>$mes)
								<tr>
									<th class="text-center" scope="row">
										{{$key+1}}
									</th>
									<td class="text-center">
										{{$mes['mes']}}
									</td>
									<td class="text-center">
										${{number_format($mes['aportacion'],2)}}
									</td>
									<td class="text-center">
										${{number_format($mes['cuota_administracion'],2)}}
									</td>
									<td class="text-center">
										${{number_format($mes['iva'],2)}}
									</td>
									<td class="text-center">
										${{number_format($mes['sv'],2)}}
									</td>
									<td class="text-center">
										${{number_format($mes['sd'],2)}}
									</td>
									<td class="text-center">
										${{number_format($mes['total'],2)}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@if ($plan_select->abreviatura != "TC")
					{{-- expr --}}
					<div class="row">
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
										{{$plan_select->corrida_meses_fijos($request->monto)['integrante']['meses']}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['integrante']['aportacion'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['integrante']['cuota_administracion'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['integrante']['iva'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['integrante']['sv'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['integrante']['sd'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['integrante']['total'],2)}}
									</td>
								</tr>
								<tr>
									<td class="text-center">
										{{$plan_select->corrida_meses_fijos($request->monto)['adjudicado']['meses']}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['adjudicado']['aportacion'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['adjudicado']['cuota_administracion'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['adjudicado']['iva'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['adjudicado']['sv'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['adjudicado']['sd'],2)}}
									</td>
									<td class="text-center">
										{{number_format($plan_select->corrida_meses_fijos($request->monto)['adjudicado']['total'],2)}}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				@endif
			@endif
		</div>
		<div class="card-footer"></div>
	</div>
@endsection