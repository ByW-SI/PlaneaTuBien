@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-4">
                <h4>Datos del Cliente:</h4>
            </div>
            <div class="col-sm-4 text-center">
                <a href="{{ route('prospectos.show', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                    <i class="fa fa-undo"></i><strong> Volver</strong>
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
                        <a class="nav-link" href="{{ route('prospectos.documentos.index', ['prospecto' => $prospecto]) }}">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.prestamos.index', ['prospecto' => $prospecto]) }}">Préstamos</a>
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
        <form action="{{ route('prospectos.pagos.store', ['prospecto' => $prospecto]) }}" method="post">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Pagos:</h4>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                                <i class="fa fa-bars"></i><strong> Lista de Pagos</strong>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    	<div class="form-group col-sm-12">
                            <table class="table table-sm table-bordered table-stripped table-hover" style="margin-bottom: 0px;">
                                <tr style="background: #f0f0f0;">
                                    <th style="width: 33%;">Préstamo</th>
                                    <th style="width: 33%;">Meses</th>
                                    <th style="width: 33%;">Seleccionar</th>
                                </tr>
                                @foreach($prospecto->prestamos as $prestamo)
                                    @if(count($prestamo->pagos) < 1)
                                        <tr>
                                            <td>${{ number_format($prestamo->prestamo, 2) }}</td>
                                            <td>{{ $prestamo->meses }} meses</td>
                                            <td class="text-center">
                                                <input type="radio" name="prestamo_id" value="{{ $prestamo->id }}" required="" onclick="iniciar({{ $prestamo }})">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
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
                    </div>
                </div>
                <div class="card-footer">
					<div class="row">
						<div class="col-sm-4 offset-sm-4 text-center">
							<input type="submit" id="guardar" class="btn btn-warning" value="Guardar">
							<input type="hidden" name="status" id="status" value="No aprobado">
							<input type="submit" id="aprobar" class="btn btn-success" value="Aprobar" style="display: none;">
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

    function iniciar(prestamo) {
        $('#seleccion').hide();
        var a = prestamo.prestamo;
        var b = prestamo.meses;
        var c = (a * 1.1).toFixed(2);
        var d = 0;
        var e = (c - d).toFixed(2);
        $('#total').val(c);
        $('#monto').val(d);
        $('#restante').val(e);
        $('#seleccion').show();
        change();
    }

	$(document).ready(function() {

    	$('#monto').change(function() {
    		var a = $('#total').val();
    		var b = a - $('#monto').val() < 0 ? a : $('#monto').val();
            var c = (a - b).toFixed(2);
    		$('#monto').val(parseFloat(b).toFixed(2));
    		$('#restante').val(c);
            if(c == 0) {
                $('#status').val('Aprobado');
                $('#guardar').hide();
                $('#aprobar').show();
            } else {
                $('#status').val('No aprobado');
                $('#guardar').show();
                $('#aprobar').hide();
            }
    	});

		change();

		$(document).change(function() {
			change();
		});

	});

</script>

@endsection