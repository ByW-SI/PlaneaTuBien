@extends('layouts.cliente')
@section('content')
<div class="card">
	<div class="card-header">
		Confirmar Pago
	</div>
	<div class="card-body col-6 offset-3">
		<div class="row">
			<div class="col-sm-12">
				<form action="{{ route('Cliente-pagos.store') }}" method="POST">
					@csrf()
					<div class="form-group">
					    <label>SPEI o número de movimiento</label>
					    <input type="text" class="form-control" name="spei" aria-describedby="SPEI" placeholder="# SPEI">
					</div>
					<div class="form-group">
					    <label>Número de Folio</label>
					    <input type="text" class="form-control" name="folio" placeholder="Numero de folio">
					</div>
					<div class="form-group">
					    <label>Fecha de Pago</label>
					    <input type="date" class="form-control" name="fecha_pago">
					</div>
					<div class="form-group">
					    <label>Monto Pagado</label>
					    <input type="text" class="form-control" name="monto">
					</div>
					<div class="d-flex justify-content-end">
						<label class="mr-2">Otra Referencia </label>
						<button class="btn btn-success rounded-circle" type="button" onclick="addElemento();"> <i class="fas fa-plus"></i></button>
					</div>
					<div id="div-pagos"></div>
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
		$(document).ready(function($) {
			let nodo = new pagoDeposito();
			nodo.id = 0;
			nodo.dom = `<div class="border rounded p-3 my-3" >
							<div class="row">
							<div class="col-6">
								<div class="form-group">
								    <label>Referencia</label>
								    <input type="text" name="referencia[]" class="form-control referencia" id="referencia0">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato0">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile0">
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
			this.file_comprobante = '';
			this.id = -1;
			this.dom = '';
		}

		function addElemento() {
			let nodo = crearNodo(pagos.length);
			pagos.push(nodo);
			$('#div-pagos').append(nodo.dom);
		}

		function remove(id) {
			if(id !== -1)
				pagos.splice(id, 1);
			console.log(pagos);
			$('#div-pagos').empty();
			let html = `<div class="border rounded p-3 my-3" >
							<div class="row">
							<div class="col-6">
								<div class="form-group">
								    <label>Referencia</label>
								    <input type="text" name="referencia[]" class="form-control referencia" id="referencia${pagos[0].id}" value="${pagos[0].referencia}">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato${pagos[0].id}" value="${pagos[0].contrato}">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile${pagos[0].id}" value="${pagos[0].file_comprobante}">
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
								    <label>Referencia</label>
								    <input type="text" name="referencia[]" class="form-control referencia" id="referencia${pagos[i].id}" value="${pagos[i].referencia}">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato${pagos[i].id}" value="${pagos[i].contrato}">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile${pagos[i].id}" value="${pagos[i].file_comprobante}">
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
								    <label>Referencia</label>
								    <input type="text" name="referencia[]" class="form-control referencia" id="referencia${i}">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
								    <label>Número de Contrato</label>
								    <input type="text" name="contrato[]" class="form-control contrato" id="num_contrato${i}">
								</div>
							</div>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input file" name="file_comprobante[]" id="customFile${i}">
							<label class="custom-file-label" for="customFile">Subir ficha del depósito o transferencia</label>
						</div>
					</div>`;
			let nodo = new pagoDeposito();
			nodo.id = i;
			nodo.dom = html;
			return nodo;
		}

		$(document).on('change', '.referencia', function() {
			let id = $(this).prop('id').replace(/[a-z]+/g, '');
			pagos[id].referencia = $(this).val();
			console.log(pagos);
		});
		$(document).on('change', '.contrato', function() {
			let id = $(this).prop('id').replace(/[a-z_]+/g, '');
			pagos[id].contrato = $(this).val();
			console.log(pagos);
		});
		$(document).on('change', '.file', function() {
			let id = $(this).prop('id').replace(/[a-zA-Z]+/g, '');
			var fileName = $(this).val().split("\\").pop();
		  	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			pagos[id].file_comprobante = $(this).val();
			console.log(pagos);
		});
	</script>
@endpush