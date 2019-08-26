@extends('layouts.cliente')
@section('content')
<style>
	.btn-imprimir {
		background-color: #3369ff;
		border-radius:2em;
		margin: 30px;
		color: white;

	}
	.btn-imprimir:hover { 
		background-position: right center;
		margin: 30px 30px;
		color: white;
	}
	.btn-correo {
		background-color: #e20635;
		border-radius:2em;
		margin: 30px;
		color: white;
	}
	.btn-correo:hover { 
		background-position: right center;
		margin: 30px;
		color: white;
	}
	.btn-enviar {
		background-color: #28a745;
		border-radius:2em;
		margin: 30px;
		color: white;
	}
</style>
<div class="card">
	<div class="card-header">
		PAGA TU MENSUALIDAD
	</div>
	<form action="{{ route('cliente-pagos.store') }}" method="POST" class="form-inline">
		@csrf
		<div class="card-body col-6 offset-3">
			@if($cliente->contratos->count() > count($pagos))
			<div class="accordion" id="accordionContratos">
			@foreach ($contratos as $contrato)
				@if ($contrato->checklist && $contrato->checklist->status)
					<!-- Primer Accordion -->
				  	<div class="card">
				    	<div class="card-header" id="heading{{ $contrato->id }}">
					      	<h2 class="mb-0">
					        	<input type="checkbox" class="form-check-input recibo" name="{{$contrato->numero_contrato}}" id="{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}" checked="" value="{{ $contrato->mensualidades->last()->cantidad }}">
					        	<input type="hidden" name="monto_pagar[]" value="{{ $contrato->mensualidades->last()->cantidad }}">
					        	<input type="hidden" name="contratos[]" value="{{ $contrato->id }}">
					        	<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $contrato->id }}" aria-expanded="true" aria-controls="collapse{{ $contrato->id }}">
					          		Contrato: {{$contrato->numero_contrato}}  &nbsp;&nbsp;&nbsp;&nbsp; Monto a pagar: $@if(!$fecha_pago) {{number_format($contrato->mensualidades->last()->cantidad,2)}} @else {{number_format($contrato->mensualidades->last()->cantidad,2)}}@endif
					        	</button>
					      	</h2>
				    	</div>

				    	<div id="collapse{{ $contrato->id }}" class="collapse" aria-labelledby="heading{{ $contrato->id }}" data-parent="#accordionContratos">
					      	<div class="card-body">
					        	<table class="table table-bordered table-striped my-4 text-center">
					        		<thead>
					        			<tr>
					        				<th scope="col">Cargo</th>
					        				<th scope="col">Monto</th>
					        			</tr>
					        		</thead>
						        	<tbody>
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
											<td>${{number_format($contrato->mensualidades->last()->recargo ,2)}}</td>
										</tr>
										<tr>
											<td>Total</td>
											<td>${{number_format($contrato->mensualidades->last()->cantidad + $contrato->mensualidades->last()->recargo,2)}}</td>
										</tr>
										@else
										<tr>
											<td>Total</td>
											<td>${{number_format($contrato->mensualidades->last()->cantidad,2)}}</td>
										</tr>
										@endif
										<tr>
											<td>Referencia</td>
											<td>
												{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}
												<input type="hidden" name="referencia[]" required="" readonly="" value="{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}">
											</td>
										</tr>
						        	</tbody>
					        	</table>
					      	</div>
				    	</div>
				  	</div>
				  	<!-- FIN Primer Accordion -->
				@endif
			@endforeach
			</div>
			<table class="table table-active">
				<tbody>
					<tr>
    					<b><td class="text-right" colspan="3">Total</td></b>
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
				<button class="btn btn-success" style="margin: 30px 30px;" type="submit"><i class="far fa-credit-card"> Pagar con tarjeta</i></button>
				<button class="btn btn-primary" style="margin: 30px 30px;" id="pago-efectivo"><i class="fas fa-wallet"> Pagar con efectivo</i></button>
				<a class="btn btn-primary" style="margin: 30px 30px;" href="{{ route('confirmardeposito') }}"><i class="fas fa-upload"> Subir vaucher</i></a>
			</div>
		</div>
	</form>
	<form action="{{ route('pago-efectivo-control') }}" method="POST" id="form-efectivio">
		@csrf
		<div class="card-body col-6 offset-3">
			<div id="div-efectivo" style="display: none;">
				<input type="hidden" name="opcion" id="opcion">
				<table class="table table-striped text-center">
					<thead>
						<tr>
							<th>Referencia</th>
							<th>Monto</th>
							<th>Número de contrato</th>
						</tr>
					</thead>
					<tbody id="tbody-contratos">
					</tbody>
				</table>
				<div class="row">
					<div class="col-5 card-header" >
						<ul>
							<li><b>Banco:</b> BBVA</li>
							<li><b>Nombre del Titular:</b> PTB</li>
							<li><b>Convenio</b></li>
							<li><b>CLABE:</b></li>
						</ul>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<button type="submit" class="btn btn-imprimir" id="btn-imprimir"><i class="fas fa-print"> Imprimir</i></button>
					<button type="submit" class="btn btn-correo" id="btn-correo"><i class="fas fa-envelope"> Enviar por correo</i></button>
				</div>
				<div class="col-12" style="display: none;" id="div-correodestino">
					<div class="form-group text-center">
						<label class="form-control-label">Ingresa el correo al que quieres enviarlo</label>
						<input type="email" name="correodestino" id="correodestino" class="form-control" placeholder="email@example.com">
					</div>
					<div class="text-center">
						<button class="btn btn-enviar" id="btn-correo-enviar"><i class="fas fa-check"> Enviar</i></button>
					</div>
				</div>
			</div>
		</div>
	</form>
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
	                                    Contrato de folio: {{$contrato->numero_contrato}}
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
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		var contratos = [
			@foreach($contratos as $contrato)
			{
				"numContrato": {{$contrato->numero_contrato}},
				"contrato": @json($contrato)
			},
			@endforeach
		];
		console.log(contratos);
		$(document).ready(function() {
			setTotal();
		});
		$("input.recibo").click(function () {
			setTotal();
		});
		function setTotal() {
			var total = 0.00;
			$("input.recibo:checked").each(
			    function() {
			    	total += parseFloat($(this).val());
			        // alert("El checkbox con valor " + $(this).val() + " está seleccionado"+total);
			    }
			);
    		$("#total").val(total.toFixed(2));
    		pagoEfectivo();
		}
		$('#pago-efectivo').click(function(event) {
			event.preventDefault();
			pagoEfectivo();
			$('#div-efectivo').prop('style', '');
		});
		function pagoEfectivo() {
			let contenido ='';
			$("input.recibo:checked").each(function(index, el) {
				contenido += `<tr>
							<td>
								${$(el).prop('id')}
								<input type="hidden" name="ref[]" value="${$(el).prop('id')}">
							</td>
							<td>
								$${parseFloat($(el).prop('value')).toFixed(2)}
								<input type="hidden" name="monto[]" value="${$(el).prop('value')}">
							</td>
							<td>
								${$(el).prop('name')}
								<input type="hidden" name="num_contrato[]" value="${$(el).prop('name')}">
							</td>
							</tr>`;
			});
			$('#tbody-contratos').empty();
			$('#tbody-contratos').append(contenido);
		}
		$('#btn-imprimir').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('#opcion').val('imprimir');
			$('#form-efectivio').eq(0).submit();
		});
		$('#btn-correo').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('#div-correodestino').prop('style', '');
			$('#opcion').val('correo');
		});
		$('#btn-correo-enviar').click(function(event) {
			event.preventDefault();
			if ($('#correodestino').val() != '') {
				$('#form-efectivio').eq(0).submit();
			}
			else {
				alert('Ingresa un correo');
			}
		});
	</script>
@endpush
