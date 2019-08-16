@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		PAGA TU MENSUALIDAD
	</div>
	<form action="{{ route('confirmar-pago') }}" class="form-inline">
		<div class="card-body col-6 offset-3">
			@if($cliente->contratos->count() > count($pagos))
			@foreach ($contratos as $contrato)
				@if ($contrato->checklist && $contrato->checklist->status)
				@php($recargo = (($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'] * 0.03) + ($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'] * 0.03) * 0.16))
				<table class="table table-bordered table-striped my-4 text-center">
					<thead>
						<tr>
							<th scope="col">Seleccionar</th>
							<th scope="col">Contrato</th>
							<th scope="col">Cargo</th>
							<th scope="col">Monto</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center" @if(!$fecha_pago)rowspan="9"@else rowspan="8"@endif style="vertical-align:middle;">
								<label for="recibo{{$contrato->id}}">
									@if(!$fecha_pago)
									<input type="checkbox" class="recibo" name="recibo[{{$contrato->id}}]" id="recibo{{$contrato->id}}" value="{{$plan->cuota_periodica_integrante($contrato->monto,$cotizacion->factor_actualizacion) + $recargo}}">
									@else
									<input type="checkbox" class="recibo" name="recibo[{{$contrato->id}}]" id="recibo{{$contrato->id}}" value="{{$plan->cuota_periodica_integrante($contrato->monto,$cotizacion->factor_actualizacion)}}">
									@endif
								</label>
							</td>
<<<<<<< HEAD
							<td class="text-center" @if(!$fecha_pago)rowspan="9"@else rowspan="8"@endif style="vertical-align:middle;">
								<label for="recibo{{$contrato->id}}">
=======
							<td class="text-center" rowspan="8" style="vertical-align:middle;">
								<label for="contrato{{$contrato->id}}">
>>>>>>> d0b00291dd7fba9f13f9b772a64b90ce1f55f69d
									@php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}
									<input type="hidden" name="contratos[{{$contrato->id}}]" value="@php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}">
								</label>
							</td>

							{{-- <td class="text-center">
								<label for="recibo{{$contrato->id}}">
									${{number_format($contrato->monto,2)}}
								</label>
							</td>
							<td class="text-center">
								<label for="recibo{{$contrato->id}}">
									${{number_format($plan->cuota_periodica_integrante($contrato->monto,$cotizacion->factor_actualizacion),2)}}
								</label>
							</td> --}}
						</tr>
						<tr>
							<td>Aportación</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['aportacion'],2)}}</td>
						</tr>
						<tr><td>Cuota de Administración</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['cuota_administracion'],2)}}</td>
						</tr>
						<tr>
							<td>IVA</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['iva'],2)}}</td>
						</tr>
						<tr>
							<td>Seguro de Vida</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['sv'],2)}}</td>
						</tr>
						<tr>
							<td>Seguro de Daños</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['sd'],2)}}</td>
						</tr>
						@if(!$fecha_pago)
						<tr>
							<td>Recargo</td>
							<td>${{number_format($recargo ,2)}}</td>
						</tr>
						<tr>
							<td>Total</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'] + $recargo,2)}}</td>
						</tr>
						@else
						<tr>
							<td>Total</td>
							<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}</td>
						</tr>
						@endif
						<tr>
							<td>Referencia</td>
							<td>
								@php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}
								<input type="hidden" name="referencia[{{$contrato->id}}]"required="" readonly="" value="@php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}">
							</td>
						</tr>
					</tbody>
				</table>
				@endif
			@endforeach
				<table class="table table-active">
					<tbody>
						<tr>
	    					<b><td class="text-center" colspan="3">Total</td></b>
	    					<b><td class="text-center col-5" >
	    						<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon1">$</span>
								  </div>
								  <input type="number" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" readonly="" name="total" min="0.0" step="0.01" id="total" value="0.00">
								</div>
	    					</td></b>
	    				</tr>
					</tbody>
				</table>
				<div class="d-flex justify-content-center">
					<button class="btn btn-success" type="submit"><i class="far fa-credit-card"> PAGAR</i></button>
				</div>
		</div>
			@else
    			<h3>Genial <br>Estas al corriente con los pagos del mes.</h3>

    			<div class="row">
	                <div class="col-12 text-center mt-3">
	                    <label>
	                        Próximo Pagos
	                    </label>
	                </div>
	                <div class="col-10 offset-1 text-center mt-3">
	                    <table class="table table-borderless">
	                        <thead class="thead-dark">
	                            <tr>
	                                <th style="border-top-left-radius: 10px;">Contratos</th>
	                                <th>A Pagar</th>
	                                <th>Recargo</th>
	                                <th style="border-top-right-radius: 10px;">Fecha Límite</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach ($cliente->contratos as $contrato)
	                            @if ($contrato->checklist && $contrato->checklist->status && $contrato->checklist->firmas == 1)
	                            <tr>
	                                <td>
	                                    Contrato de folio: @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}
	                                </td>
	                                <td>
	                                    ${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}
	                                </td>
	                                <td>${{ number_format($pagos[$contrato->id]->adeudo, 2) }}</td>
	                                <td>{{ date("7/m/Y", strtotime("+1 month", strtotime(date('d-m-Y'))))}}</td>
	                            </tr>
	                            @endif
	                        @endforeach
	                        </tbody>
	                    </table>
	                </div>
	            </div>
			@endif
	</form>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("input.recibo").click(function () {
			setTotal();
		});
		function setTotal() {
			var total = 0.00;
			$('input.referencia').each(function(index, el) {
				$(el).prop('required', false);
			});
			$("input.recibo:checked").each(
			    function() {
			    	total += parseFloat($(this).val());
			    	let referencia = $(this).parents('tbody').find('input.referencia');
			    	referencia.prop('required', true);
			        // alert("El checkbox con valor " + $(this).val() + " está seleccionado"+total);
			    }
			);
    		$("#total").val(total.toFixed(2));
		}
	</script>
@endpush
