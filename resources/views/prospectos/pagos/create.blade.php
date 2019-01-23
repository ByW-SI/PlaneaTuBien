@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Cliente:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('clientes.show', ['cliente' => $cliente]) }}" class="btn btn-primary">
                    <i class="fa fa-undo"></i><strong> Volver</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-3">
                <label>Nombre:</label>
                <dd>{{ $cliente->nombre }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Paterno:</label>
                <dd>{{ $cliente->appaterno }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Apellido Materno:</label>
                <dd>{{ $cliente->apmaterno ? $cliente->apmaterno : 'N/A' }}</dd>
            </div>
            <div class="form-group col-sm-3">
                <label>Asesor:</label>
                <dd>{{ $cliente->asesor ? $cliente->asesor->nombre . ' ' . $cliente->asesor->paterno : 'N/A'}}</dd>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('clientes.pagos.index', ['cliente' => $cliente]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM General</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h4>Pagos:</h4>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('clientes.pagos.index', ['cliente' => $cliente]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Pagos</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                	<div class="form-group col-sm-3">
                		<label class="control-label">Préstamo:</label>
                		<input type="number" name="prestamo" id="prestamo" class="form-control">
                	</div>
                	<div class="form-group col-sm-3">
                		<label class="control-label">Meses:</label>
                		<select name="meses" id="meses" class="form-control">
                			<option value="">Seleccionar</option>
							<option value="12">12 Meses</option>
							<option value="24">24 Meses</option>
							<option value="36">36 Meses</option>
							<option value="48">48 Meses</option>
							<option value="60">60 Meses</option>
                		</select>
                	</div>
                </div>
                <div id="seleccion" style="display: none;">
                	<hr>
					<div class="row">
						<div class="col-sm-3 form-group">
							<label class="control-label">Identificación:</label>
							<select class="form-control" name="identificacion" id="identificacion" required>
								<option value="">Seleccionar</option>
								<option value="INE">INE</option>
								<option value="IFE">IFE</option>
								<option value="Pasaporte">Pasaporte</option>
								<option value="Cédula Profesional">Cédula Profesional</option>
								<option value="Cartilla">Cartilla</option>
							</select>
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Comprobante de Domicilio:</label>
							<select class="form-control" name="comprobante" id="comprobante" required>
								<option value="">Seleccionar</option>
								<option value="Luz">Luz</option>
								<option value="Agua">Agua</option>
								<option value="Teléfono">Teléfono</option>
								<option value="Predial">Predial</option>
							</select>
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Forma de Pago:</label>
							<select class="form-control" name="forma" id="forma" required>
								<option value="">Seleccionar</option>
								<option value="Efectivo">Efectivo</option>
								<option value="Cheque">Cheque</option>
								<option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
								<option value="Tarjeta de Débito">Tarjeta de Débito</option>
								<option value="Depósito">Depósito</option>
							</select>
						</div>
						<div class="col-sm-3 form-group" id="bancos" style="display: none;">
							<label onclick="getBancos()" class="control-label">Banco:</label>
							<select type="select" name="banco" class="form-control" id="banco">
								<option value="">Seleccionar</option>
								@foreach($bancos as $banco)
									<option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-3 form-group" id="cheques" style="display: none;">
							<label class="control-label">Número de Cheque:</label>
							<input type="number" name="cheque" class="form-control" min="0" id="cheque">
						</div>
						<div class="col-sm-3 form-group" id="tarjetas" style="display: none;">
							<label class="control-label">Número de Tarjeta:</label>
							<input type="number" name="tarjeta" class="form-control" min="0" id="tarjeta">
						</div>
						<div class="col-sm-3 form-group" id="tarjetahs" style="display: none;">
							<label class="control-label">Nombre de Tarjetahabiente:</label>
							<input type="text" name="tarjetaHabiente" class="form-control" id="tarjetah">
						</div>
						<div class="col-sm-3 form-group" id="depositos" style="display: none;">
							<label class="control-label">Folio de Depósito:</label>
							<input type="number" name="deposito" class="form-control" min="0" id="deposito">
						</div>
						<div class="col-sm-3 form-group" id="montos" style="display: none;">
							<label class="control-label">Monto del Pago:</label>
							<input type="number" name="monto" id="monto" class="form-control" min="0" required id="monto" step="0.01">
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Número de Referencia:</label>
							<input type="text" name="referencia" id="referencia" class="form-control" required="">
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Número de Fólio:</label>
							<input type="text" name="folio" id="folio" class="form-control" required="">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 offset-sm-6 form-group">
							<label class="control-label">Total:</label>
							<input type="text" id="total" name="total" class="form-control" readonly="">
						</div>
						<div class="col-sm-3 form-group">
							<label class="control-label">Restante:</label>
							<input type="text" id="restante" name="restante" class="form-control" readonly="">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-center">
							<input type="submit" id="guardar" class="btn btn-warning" value="Guardar">
							<input type="hidden" name="status" id="status" value="No Aprobado">
							<input type="submit" id="aprobar" class="btn btn-success" value="Aprobar Pago" style="display: none;">
						</div>
					</div>
				</div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-4 offset-sm-4 text-center">
                        <button type="submit">
                            
                        </button>
                    </div>
                </div>
            </div>
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
			$("#montos").hide();
            monto = false;
    	}

    	if(banco) {
			$("#banco").prop('value', '');
			$("#banco").prop('required', false);
			$("#bancos").hide();
            banco = false;
    	}

		if(deposito) {
			$("#deposito").prop('value', '');
			$("#deposito").prop('required', false);
			$("#depositos").hide();
            deposito = false;
    	}

    	if(cheque) {
			$("#cheque").prop('value', '');
			$("#cheque").prop('required', false);
			$("#cheques").hide();
            cheque = false;
    	}

    	if(tarjeta) {
			$("#tarjeta").prop('value', '');
			$("#tarjetah").prop('value', '');
			$("#tarjeta").prop('required', false);
			$("#tarjetah").prop('required', false);
			$("#tarjetas").hide();
			$("#tarjetahs").hide();
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
					$("#cheques").show();
            		tarjeta = deposito = true;
            	} else if(forma == "Tarjeta de Crédito" || forma == "Tarjeta de Débito") {
					$("#tarjeta").prop('required', true);
					$("#tarjetah").prop('required', true);
					$("#tarjetas").show();
					$("#tarjetahs").show();
            		deposito = cheque = true;
            	} else if(forma == "Depósito") {
					$("#deposito").prop('required', true);
					$("#depositos").show();
            		tarjeta = cheque = true;
            	}
				$("#montos").show();
            } else {
            	monto = tarjeta = cheque = deposito = true;
            }
        });
	}

	$(document).ready(function() {

    	$('#prestamo').change(function() {
    		var a = $('#prestamo').val();
    		var b = $('#meses').val();
    		var c = a / b;
    		var d = $('#monto').val() > c ? c : $('#monto').val();
    		if(a && b) {
    			$('#seleccion').show();
    			$('#total').val(c);
    			$('#restante').val(c - d);
				change();
    		} else {
    			$('#seleccion').hide();
    			$('#total').val('');
    			$('#restante').val('');
				change();
    		}
    	});

    	$('#meses').change(function() {
    		var a = $('#prestamo').val();
    		var b = $('#meses').val();
    		var c = a / b;
    		var d = $('#monto').val() > c ? c : $('#monto').val();
    		if(a && b) {
    			$('#seleccion').show();
    			$('#total').val(c);
    			$('#restante').val(c - d);
				change();
    		} else {
    			$('#seleccion').hide();
    			$('#total').val('');
    			$('#restante').val('');
				change();
    		}
    	});

    	$('#monto').change(function() {
    		var a = $('#total').val();
    		var c = $('#monto').val() > a ? a : $('#monto').val();
    		$('#monto').val(c);
    		$('#restante').val(a - c);
    	});

		change();

		$(document).change(function() {
			change();
		});

	});

</script>

@endsection