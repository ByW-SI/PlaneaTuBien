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
								<option value="{{$plan->id}}" {{$plan_select && $request->plan == $plan->id ? 'selected=""' : ''}}>{{$plan->nombre}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-auto mr-auto">
						<button type="submit" class="btn btn-primary mb-2">Cotizar</button>
					</div>
					@if($res && $plan_select->abreviatura)
					<div class="col-auto">
						<a href="#" class="btn btn-danger mb-2">PDF</a>{{-- route('toPDF',['plan'=>$plan_select, 'monto'=>$request->monto]) --}}
					</div>
					<div class="col-auto">
						<a href="#" class="btn btn-success mb-2">EXCEL</a>
					</div>
					@endif
				</div>
			</form>
			@if ($res && $plan_select->abreviatura !== "PL")
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
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
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
							<span class="form-control bg-light">{{number_format($res['monto_financiar'], 2)}}</span>
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
					@if ($plan_select->abreviatura != "TC" && $plan_select->abreviatura != "TD")
						<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
							<label for="">Monto a adjudicar</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<span class="form-control bg-light">{{$plan_select->abreviatura == "TC"  ? number_format($plan_select->monto_adjudicar_tc($request->monto),2) : number_format($res['monto_adjudicar'],2)}}</span>
							</div>
						</div>
					@endif
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Aportación integrante</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($res['aportacion_integrante'],2)}}</span>
						</div>
					</div>
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC" && $plan_select->abreviatura !== "TD")
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
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC" && $plan_select->abreviatura !== "TD")
					<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group">
						<label for="">Cuota periodica adjudicado {{ $plan_select->abreviatura }}</label>
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
					@if(isset($plan_select) && $plan_select->abreviatura !== "TC" && $plan_select->abreviatura !== "TD")
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
						<label for="">Inscripción</label>
						<div class="input-group mb-3 mt-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<span class="form-control bg-light">{{number_format($plan_select->monto_inscripcion_con_iva($request->monto),2)}}</span>
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
									Aportación Anual
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
							@php($totales = [0,0,0,0,0,0,0])
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
										@if($mes['mes'] === "12")${{number_format($mes['monto_anual'], 2)}} @else $0.00 @endif
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
										@if($mes['mes'] === "12" && $plan_select->abreviatura === "TC")
											${{number_format($mes['total'] + $mes['monto_anual'],2)}}
										@elseif($mes['mes'] === "12" && $plan_select->abreviatura !== "TC")
											${{number_format($mes['total'] + $mes['monto_anual'],2)}}
										@else
											${{number_format($mes['total'],2)}}
										@endif
									</td>
								</tr>
									@php($totales[0] += $mes['aportacion'])
									@if($mes['mes'] == "12") @php($totales[1] += $mes['monto_anual']) @endif
									@php($totales[2] += $mes['cuota_administracion'])
									@php($totales[3] += $mes['iva'])
									@php($totales[4] += $mes['sv'])
									@php($totales[5] += $mes['sd'])
									@php($totales[6] += $mes['total'])
							@endforeach
							<tr>
								<td><b>TOTALES</b></td>
								<td></td>
								<td class="text-center">${{ number_format($totales[0], 2) }}</td>
								<td class="text-center">${{ number_format($totales[1], 2) }}</td>
								<td class="text-center">${{ number_format($totales[2], 2) }}</td>
								<td class="text-center">${{ number_format($totales[3], 2) }}</td>
								<td class="text-center">${{ number_format($totales[4], 2) }}</td>
								<td class="text-center">${{ number_format($totales[5], 2) }}</td>
								<td class="text-center">${{ number_format($totales[6], 2) }}</td>
							</tr>
						</tbody>
					</table>
				</div>
				@if ($plan_select->abreviatura != "TC" && $plan_select->abreviatura != "TD")
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
			@else
				@if ($res)
					<div class="row">
						<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group offset-4">
							<h4>{{$plan_select->nombre}}</h4>
						</div>
						<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2 form-group">
							<label for="">Monto contratado</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">$</span>
								</div>
								<span class="form-control bg-light">{{number_format($request->monto,2)}}</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 offset-3">
							<table class="table table-striped">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Mínimo</th>
										<th scope="col">Posible 1</th>
										<th scope="col">Posible 2</th>
										<th scope="col">Posible 3</th>
										<th scope="col">Máximo</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>${{ number_format($res['minimo'], 2) }}</td>
										<td>${{ number_format($res['posible1'], 2) }}</td>
										<td>${{ number_format($res['posible2'], 2) }}</td>
										<td>${{ number_format($res['posible3'], 2) }}</td>
										<td>${{ number_format($res['maximo'], 2) }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				@endif
			@endif
		</div>
		<div class="card-footer"></div>
	</div>
@endsection

{{-- 
Total a pagar = Monto aportaciones extraordinarias + Monto cuota periodica integhrante + monto cuota periodica adjudicado + inscripcion + derecho de adjudicacion
			  = 280,170.37 + 651,951.07 + 0.0 + 17,400.0 + 19,486.79
			  = 969,008.24

			  = 195,000.0 + 674,331.42 + 0.0 + 17,400.0 + 19486.79
			  = 906,218.21

Tanda Clasica 	TC 	168 	1 	2 	1 	1 	3 	25 	18 	0 	3 	0 	6 	0.00 	120 	0.00 	1.00 	3.00 	0.10 	0.06 	0.00 	0 	0 	2019-10-11 12:09:34 	2019-10-11 12:09:34 	NULL 	normal
 --}}