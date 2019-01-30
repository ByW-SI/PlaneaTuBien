@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('prospectos.info')
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
		<div class="card">
		    <div class="card-header">
				<div class="row">
					<div class="col-sm-4">
						<h4>Datos del Pago:</h4>
					</div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.pagos.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Pago</strong>
                        </a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Pagos</strong>
                        </a>
                    </div>
				</div>
			</div>
			<form action="{{ route('prospectos.pagos.store', ['prospecto' => $prospecto]) }}" method="post" id="form">
				{{ csrf_field() }}
				<input type="hidden" name="cotizacion_id" value="{{ $pago->cotizacion->id }}">
				<input type="hidden" name="meses" value="{{ $pago->cotizacion->meses }}">
				<input type="hidden" name="total" value="{{ $pago->total }}">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-sm table-bordered table-stripped table-hover">
									<tr class="info">
										<th>Préstamo</th>
										<th>Fecha del Pago</th>
										<th>Meses</th>
										<th>Total a Pagar</th>
										<th>Restante a Pagar</th>
									</tr>
									<tr>
										<td>{{ $pago->cotizacion->prestamo }}</td>
										<td>{{ $pago->created_at }}</td>
										<td>{{ $pago->cotizacion->meses }}</td>
										<td>${{ number_format($pago->total, 2) }}</td>
										<td>${{ number_format($pago->restante, 2) }}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 form-group">
							<label class="control-label">✱Identificación:</label>
							<select class="form-control" name="identificacion" id="identificacion" required>
								<option value="">Sin definir</option>
								<option value="INE">INE</option>
								<option value="IFE">IFE</option>
								<option value="Pasaporte">Pasaporte</option>
								<option value="Cédula Profesional">Cédula Profesional</option>
								<option value="Cartilla">Cartilla</option>
							</select>
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">✱Comprobante de Domicilio:</label>
							<select class="form-control" name="comprobante" id="comprobante" required>
								<option value="">Sin definir</option>
								<option value="Luz">Luz</option>
								<option value="Agua">Agua</option>
								<option value="Teléfono">Teléfono</option>
								<option value="Predial">Predial</option>
							</select>
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">✱Forma de Pago:</label>
							<select class="form-control" name="forma" id="forma" required>
								<option value="">Sin definir</option>
								<option value="Efectivo">Efectivo</option>
								<option value="Cheque">Cheque</option>
								<option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
								<option value="Tarjeta de Débito">Tarjeta de Débito</option>
								<option value="Depósito">Depósito</option>
							</select>
						</div>
						<div class="col-sm-3 form-group" id="bancos" style="display: none;">
							<label onclick="getBancos()" class="control-label">✱Banco:</label>
							<select type="select" name="banco" class="form-control" id="banco">
								<option id="sin_definir" value="">Seleccione Uno</option>
								@foreach($bancos as $banco)
								<option id="{{ $banco->id }}" value="{{ $banco->nombre }}">{{ $banco->nombre }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-3 form-group" id="cheques" style="display: none;">
							<label class="control-label">✱Número de Cheque:</label>
							<input type="number" name="cheque" class="form-control" min="0" id="cheque">
						</div>
						<div id="tarjetas" style="display: none;">
							<div class="col-sm-3 form-group">
								<label class="control-label">✱Número de Tarjeta:</label>
								<input type="number" name="tarjeta" class="form-control" min="0" id="tarjeta">
							</div>
							<div class="col-sm-3 form-group">
								<label class="control-label">✱Nombre de Tarjetahabiente:</label>
								<input type="text" name="tarjetaHabiente" class="form-control" id="tarjetah">
							</div>
						</div>
						<div class="col-sm-3 form-group" id="depositos" style="display: none;">
							<label class="control-label">✱Folio de Depósito:</label>
							<input type="number" name="deposito" class="form-control" min="0" id="deposito">
						</div>
						<div class="col-sm-3 form-group" id="montos" style="display: none;">
							<label class="control-label">✱Monto del Pago:</label>
							<input type="number" name="monto" id="monto" class="form-control" min="0" required id="monto" step="0.01">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 form-group">
							<label class="control-label">✱Número de Referencia:</label>
							<input type="text" name="referencia" id="referencia" class="form-control" required="">
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">✱Número de Fólio:</label>
							<input type="text" name="folio" id="folio" class="form-control" required="">
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Cantidad a Pagar:</label>
							<input type="text" id="total" class="form-control" value="{{ $pago->restante }}" required readonly="">
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Restante:</label>
							<input type="text" id="restante" name="restante" class="form-control" readonly="">
						</div>
					</div>
				</div>
                <div class="card-footer">
					<div class="row">
						<div class="col-sm-4 offset-sm-4 text-center">
                            <button type="submit" id="guardar" class="btn btn-warning">
                                <i class="fa fa-check"></i> Guardar
                            </button>
							<input type="hidden" name="status" id="status" value="No aprobado">
                            <button type="submit" id="aprobar" class="btn btn-success" style="display: none;">
                                <i class="fa fa-check"></i> Aprobar
                            </button>
						</div>
                        <div class="col-sm-4 text-right text-danger">
                            ✱Campos Requeridos.
                        </div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	var tipo = monto = banco = tarjeta = cheque = deposito = false; 
	var forma;

	function change() {
    	if(tipo) {
    		tarjeta = cheque = deposito = true;
			$("#monto").prop('value', '');
			$("#banco").prop('value', '');
			tipo = false;
    	}

		if(monto) {
			$("#monto").prop('value', '');
            document.getElementById("montos").style.display = 'none';
            monto = false;
    	}

    	if(banco) {
			$("#banco").prop('value', '');
			$("#banco").prop('required', false);
            document.getElementById("bancos").style.display = 'none';
            banco = false;
    	}

		if(deposito) {
			$("#deposito").prop('value', '');
			$("#deposito").prop('required', false);
            document.getElementById("depositos").style.display = 'none';
            deposito = false;
    	}

    	if(cheque) {
			$("#cheque").prop('value', '');
			$("#cheque").prop('required', false);
            document.getElementById("cheques").style.display = 'none';
            cheque = false;
    	}

    	if(tarjeta) {
			$("#tarjeta").prop('value', '');
			$("#tarjetah").prop('value', '');
			$("#tarjeta").prop('required', false);
			$("#tarjetah").prop('required', false);
            document.getElementById("tarjetas").style.display = 'none';
            tarjeta = false;	
    	}

        $("#forma").change(function() {
            forma = $("#forma").val();
            if(forma != "") {
            	if(forma == "Efectivo") {
	        		banco = true;
	        		document.getElementById("montos").style.display = 'block';
	            } else {
	        		monto = true;
					$("#banco").prop('required', true);
	        		document.getElementById("bancos").style.display = 'block';
	            }
            } else
	        	banco = monto = true;
            tipo = true;
        });

        $("#banco").change(function() {
            var val = $("#banco").val();
            if(val != "") {
            	if(forma == "Cheque") {
					$("#cheque").prop('required', true);
            		document.getElementById("cheques").style.display = 'block';
            		tarjeta = deposito = true;
            	} else if(forma == "Tarjeta de Crédito" || forma == "Tarjeta de Débito") {
					$("#tarjeta").prop('required', true);
					$("#tarjetah").prop('required', true);
            		document.getElementById("tarjetas").style.display = 'block';
            		deposito = cheque = true;
            	} else if(forma == "Depósito") {
					$("#deposito").prop('required', true);
            		document.getElementById("depositos").style.display = 'block';
            		tarjeta = cheque = true;
            	}
	        	document.getElementById("montos").style.display = 'block';
            } else {
            	monto = tarjeta = cheque = deposito = true;
            }
        });
	}

	$(document).ready(function() {
		change();
		$(document).change(function() {
			change();
			var monto$ = document.getElementById('monto').value;
			var total$ = document.getElementById('total').value;
			if(total$ !== '') {
				document.getElementById('monto').max = total$;
				if(total$ != 0 && parseInt(monto$) > parseInt(total$)) {
					alert('El monto del pago no puede ser mayor al total a pagar.\nEl monto ha sido cambiado al total a pagar.')
					monto$ = total$;
					document.getElementById('monto').value = monto$;
				}
			}
			var restante$ = total$ !== '' && monto$ !== '' ? total$ - monto$ : '';
			document.getElementById('restante').value = total$ !== '' && monto$ !== '' && restante$ >= 0 ? restante$.toFixed(2) : '';
			document.getElementById('aprobar').style.display = restante$ === 0 ? 'inline-block' : 'none';
			document.getElementById('guardar').style.display = restante$ === 0 ? 'none' : 'inline-block';
			document.getElementById('status').value = restante$ === 0 ? 'Aprobado' : 'No Aprobado';
		});
	});

	function getBancos(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: "{{ url('/getbancos') }}",
			type: "GET",
			dataType: "html",
		}).done(function(resultado) {
			$("#banco").html(resultado);
		});
	}

</script>

@endsection