@extends('layouts.cliente')
@section('content')
<?php
header('Location: https://www.google.com');
?>
<div class="card">
	<div class="card-header">
		PAGA TU MENSUALIDAD
	</div>
	<form action="#" class="form-inline">
		<div class="card-body col-6 offset-3">
					@foreach ($cliente->contratos as $contrato)
        				@if ($contrato->checklist && $contrato->checklist->status)
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
								<td class="text-center" rowspan="8" style="vertical-align:middle;">
									<label for="recibo{{$contrato->id}}"><input type="checkbox" name="recibo[]" id="recibo{{$contrato->id}}" value="{{$plan->cuota_periodica_integrante($contrato->monto,$cotizacion->factor_actualizacion)}}"></label>
								</td>
								<td class="text-center" rowspan="8" style="vertical-align:middle;">
									<label for="recibo{{$contrato->id}}">
										@php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}
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
							<tr>
								<td>Total</td>
								<td>${{number_format($plan->corrida_meses_fijos($contrato->monto,$cotizacion->factor_actualizacion)['integrante']['total'],2)}}</td>
							</tr>
							<tr>
								<td>Referencia</td>
								<td><input type="text" name="referencia[]" class="form-control"></td>
							</tr>
        				@endif
    				@endforeach
				</tbody>
			</table>
			<table class="table table-active">
				<tbody>
					<tr>
    					<b><td class="text-center" colspan="3">Total</td></b>
    					<b><td class="text-center" id="total">$0.00</td></b>
    				</tr>
				</tbody>
			</table>
			<div class="d-flex justify-content-center">
				<button class="btn btn-success" type="submit"><i class="far fa-credit-card"> PAGAR</i></button>
			</div>
		</div>
	</form>
</div>
@endsection
@push('scripts')
	<script type="text/javascript">
		$("input[name='recibo[]']").click(function () {
			setTotal();
		});
		function setTotal() {
			var total = 0.00;
			$("input[name='recibo[]']:checked").each(
			    function() {
			    	total += parseFloat($(this).val());
			        // alert("El checkbox con valor " + $(this).val() + " está seleccionado"+total);
			    }
			);
    		$("#total").text('$'+total.toFixed(2));
		}
	</script>
@endpush
