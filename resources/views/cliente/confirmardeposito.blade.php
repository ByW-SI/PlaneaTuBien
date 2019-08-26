@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		Confirmar Pago
	</div>
	<div class="card-body col-6 offset-3">
		<div class="row">
			<div class="col-sm-12">
				<form action="{{ route('store_pago_efectivo') }}" enctype="multipart/form-data" method="POST">
					@csrf()
					{{-- <div class="form-group">
					    <label>Monto Pagado</label>
					    <input type="text" class="form-control" name="monto">
					</div> --}}
					<div id="div-pagos"></div>
					<div class="d-flex justify-content-end">
						<label class="mr-2">Otra Referencia </label>
						<button class="btn btn-success rounded-circle" type="button" onclick="addElemento();"> <i class="fas fa-plus"></i></button>
					</div>
					<div class="d-flex justify-content-center">
						<button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection 
@push('scripts')
	<script type="text/javascript">
		var pagos = new Array();
		var cantidad_contratos = {{ $contratos->count() }} ;
		$(document).ready(function($) {
			let nodo = new pagoDeposito();
			nodo.id = 0;
			nodo.dom = `<div class="border rounded p-3 my-3" >
							<div class="row">
							<div class="col-6">
								<div class="form-group">
								    <label>SPEI o número de movimiento</label>
								    <input type="text" class="form-control campo" name="spei[]" id="spei0" placeholder="# SPEI" required onchange="updateValues(0);">
								</div>
								<div class="form-group">
								    <label>Número de Folio</label>
								    <input type="text" class="form-control campo" name="folio[]" id="folio0" placeholder="Numero de folio" required onchange="updateValues(0);">
								</div>
								<div class="form-group">
								    <label>Fecha de Pago</label>
								    <input type="date" class="form-control campo" name="fecha_pago[]" id="fecha_pago0" required onchange="updateValues(0);">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Referencia</label>
								    <select class="form-control referencia" name="referencia[]" id="referencia0" required>
								    	<option value="">Seleccionar</option>
								    	@foreach($contratos as $contrato)
								    		<option id="{{ $contrato->numero_contrato }}" value="{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}">
								    			{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}
								    		</option>
								    	@endforeach
								    </select>
								</div>
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato0" required readonly>
								</div>
								<div class="form-group">
								    <label>Monto</label>
								    <input type="text" name="monto[]" class="form-control monto campo" id="monto0" required onchange="updateValues(0);">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile0" required>
							<label class="custom-file-label" for="customFile">Subir ficha del depósito o transferencia</label>
						</div>
					</div>`
			pagos.push(nodo);
			$('#div-pagos').append(nodo.dom);
		});
		/*
		* Objeto para el manejo de los depositos con comprobante
		*/
		function pagoDeposito() {
			this.referencia = '';
			this.contrato = '';
			this.spei = '';
			this.folio = '';
			this.fecha_pago = '';
			this.file_comprobante = '';
			this.monto = '';
			this.id = -1;
			this.dom = '';
		}

		function addElemento() {
			if (pagos.length < cantidad_contratos) {
				let nodo = crearNodo(pagos.length);
				pagos.push(nodo);
				$('#div-pagos').append(nodo.dom);
			}
			else
				alert('Ya no puedes agregar máa');
		}

		function remove(id) {
			if(id !== -1)
				pagos.splice(id, 1);
			$('#div-pagos').empty();
			let html = `<div class="border rounded p-3 my-3" >
							<div class="row">
							<div class="col-6">
								<div class="form-group">
								    <label>SPEI o número de movimiento</label>
								    <input type="text" class="form-control campo" id="spei${pagos[0].id}" name="spei[]" value="${pagos[0].spei}" placeholder="# SPEI" required onchange="updateValues(${pagos[0].id});">
								</div>
								<div class="form-group">
								    <label>Número de Folio</label>
								    <input type="text" class="form-control campo" id="folio${pagos[0].id}" name="folio[]" value="${pagos[0].folio}" placeholder="Numero de folio" required onchange="updateValues(${pagos[0].id});">
								</div>
								<div class="form-group">
								    <label>Fecha de Pago</label>
								    <input type="date" class="form-control campo" id="fecha_pago${pagos[0].id}" name="fecha_pago[]" value="${pagos[0].fecha_pago}" required onchange="updateValues(${pagos[0].id});">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Referencia</label>
								    <select class="form-control referencia" name="referencia[]" id="referencia${pagos[0].id}" required>
								    	<option value="">Seleccionar</option>
								    	@foreach($contratos as $contrato)
								    		<option id="{{ $contrato->numero_contrato }}" value="{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}">
								    			{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}
								    		</option>
								    	@endforeach
								    </select>
								</div>
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato${pagos[0].id}" value="${pagos[0].contrato}" required readonly>
								</div>
								<div class="form-group">
								    <label>Monto</label>
								    <input type="text" name="monto[]" class="form-control monto campo" id="monto${pagos[0].id}" value="${pagos[0].monto}" required onchange="updateValues(${pagos[0].id});">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile${pagos[0].id}" value="${pagos[0].file_comprobante}" required>
							<label class="custom-file-label" for="customFile">${pagos[0].file_comprobante ? pagos[0].file_comprobante.split("\\").pop() : 'Subir ficha del depósito o transferencia'}</label>
						</div>
					</div>`;
			$('#div-pagos').append(html);
			for (let i = 1; i < pagos.length; i++) {
				pagos[i].id = i;
				pagos[i].dom = `<div class="border rounded p-3 my-3" >
							<div class="d-flex justify-content-end">
								<button class="btn btn-danger rounded-circle" type="button" onclick="remove(${pagos[i].id});"><i class="fas fa-minus"></i></button>
							</div>
							<div class="row">
							<div class="col-6">
								<div class="form-group">
								    <label>SPEI o número de movimiento</label>
								    <input type="text" class="form-control campo" id="spei${pagos[i].id}" name="spei[]" value="${pagos[i].spei}" placeholder="# SPEI" required onchange="updateValues(${pagos[i].id});">
								</div>
								<div class="form-group">
								    <label>Número de Folio</label>
								    <input type="text" class="form-control campo" id="folio${pagos[i].id}" name="folio[]" value="${pagos[i].folio}" placeholder="Numero de folio" required onchange="updateValues(${pagos[i].id});">
								</div>
								<div class="form-group">
								    <label>Fecha de Pago</label>
								    <input type="date" class="form-control campo" id="fecha_pago${pagos[i].id}" name="fecha_pago[]" value="${pagos[i].fecha_pago}" required onchange="updateValues(${pagos[i].id});">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Referencia</label>
								    <select class="form-control referencia" name="referencia[]" id="referencia${pagos[i].id}" required >
								    	<option value="">Seleccionar</option>
								    	@foreach($contratos as $contrato)
								    		<option id="{{ $contrato->numero_contrato }}" value="${pagos[i].referencia}">
								    			{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}
								    		</option>
								    	@endforeach
								    </select>
								</div>
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato${pagos[i].id}" value="${pagos[i].contrato}" readonly required>
								</div>
								<div class="form-group">
								    <label>Monto</label>
								    <input type="text" name="monto[]" class="form-control monto campo" id="monto${pagos[i].id}" value="${pagos[i].monto}" required onchange="updateValues(${pagos[i].id});">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile${pagos[i].id}" value="${pagos[i].file_comprobante}" required>
							<label class="custom-file-label" for="customFile">${pagos[i].file_comprobante ? pagos[i].file_comprobante.split("\\").pop() : 'Subir ficha del depósito o transferencia'}</label>
						</div>
					</div>`;
				$('#div-pagos').append(pagos[i].dom);
			}
		}

		function crearNodo(i) {
			let html = `<div class="border rounded p-3 my-3" id="contenedor${i}">
							<div class="d-flex justify-content-end">
								<button class="btn btn-danger rounded-circle" type="button" onclick="remove(${i});"><i class="fas fa-minus"></i></button>
							</div>
							<div class="row">
							<div class="col-6">
								<div class="form-group">
								    <label>SPEI o número de movimiento</label>
								    <input type="text" class="form-control" id="spei${i}" name="spei[]" placeholder="# SPEI" required>
								</div>
								<div class="form-group">
								    <label>Número de Folio</label>
								    <input type="text" class="form-control" id="folio${i}" name="folio[]" placeholder="Numero de folio" required>
								</div>
								<div class="form-group">
								    <label>Fecha de Pago</label>
								    <input type="date" class="form-control" id="fecha_pago${i}" name="fecha_pago[]" required>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Referencia</label>
								    <select class="form-control referencia" name="referencia[]" id="referencia${i}" required >
								    	<option value="">Seleccionar</option>
								    	@foreach($contratos as $contrato)
								    		<option id="{{ $contrato->numero_contrato }}" value="{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}">
								    			{{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}
								    		</option>
								    	@endforeach
								    </select>
								</div>

								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato${i}" required readonly>
								</div>
								<div class="form-group">
								    <label>Monto</label>
								    <input type="text" name="monto[]" class="form-control monto" id="monto${i}" required>
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile${i}" required>
							<label class="custom-file-label" for="customFile">Subir ficha del depósito o transferencia</label>
						</div>
					</div>`;
			let nodo = new pagoDeposito();
			nodo.id = i;
			nodo.dom = html;
			return nodo;
		}

		$(document).on('change', '.referencia', function() {($(this));
			let id = $(this).prop('id').replace(/[a-z]+/g, '');
			console.log($(this).val());
			pagos[id].referencia = $(this).val();
			pagos[id].contrato = $(this).find('option:selected').prop('id');
			$('#num_contrato'+id).val(pagos[id].contrato);
		});
		$(document).on('change', '.file', function() {
			let id = $(this).prop('id').replace(/[a-zA-Z]+/g, '');
			var fileName = $(this).val().split("\\").pop();
		  	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			pagos[id].file_comprobante = $(this).val();
		});

		$(document).on('change', '.campo', function() {
			let indice = $(this).prop('id').replace(/[a-z]/g, '');
			console.log(indice);
			updateValues(indice);
			/* Act on the event */
		});

		function updateValues(indice) {
			pagos[indice].spei = $('#spei'+indice).val();
			pagos[indice].folio = $('#folio'+indice).val();
			pagos[indice].fecha_pago = $('#fecha_pago'+indice).val();
			pagos[indice].monto = $('#monto'+indice).val();
			console.log(pagos[indice]);
		}
	</script>
@endpush
