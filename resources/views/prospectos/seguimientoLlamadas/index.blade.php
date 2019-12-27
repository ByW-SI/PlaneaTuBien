@extends('principal')
@section('content')
    <div class="mx-3">
        <div class="card mb-5">
        	<div class="card-header">
            	<h3 class="text-center my-3">Seguimiento llamadas</h3>
        	</div>
            <div class="card-body">
        		<table class="table table-striped table-hover" id="seguimientotable"  style="width:100%">
        			<thead>
        				<tr class="text-center">
        					<th scope="col">Nombre</th>
        					<th scope="col">Celular</th>
        					<th scope="col">Telefono</th>
            				<th class="table-danger" style=" width: 150px;">Comentario</th>
            				<th class="table-primary">Fecha actual</th>
            				<th class="table-primary" style=" width: 150px;">Estatus</th>
            				<th class="table-primary">Fecha Seguimiento</th>
            				<th class="table-warning">Fecha actual</th>
            				<th class="table-warning">Estatus</th>
            				<th class="table-warning">Fecha Seguimiento</th>
            				<th class="table-secondary">Fecha actual</th>
            				<th class="table-secondary">Estatus</th>
            				<th class="table-secondary">Fecha Seguimiento</th>
            				<th class="table-dark">Fecha actual</th>
            				<th class="table-dark">Estatus</th>
            				<th class="table-dark">Fecha Seguimiento</th>
            				<th class="table-warning">Fecha actual</th>
            				<th class="table-warning">Estatus</th>
            				<th class="table-warning">Fecha Seguimiento</th>
        				</tr>
        			</thead>
        			<tbody>
        				@foreach($prospectos as $prospecto)
            				<tr>
            					<th scope="row">{{ $prospecto->fullName }}</th>
            					<th scope="row">{{ $prospecto->celular }}</th>
            					<th scope="row">{{ $prospecto->telefono }}</th>
            					<td>
            						<div class="form-group" style="display: block; width: 150px;">
									    <textarea class="form-control" name="comentario" rows="3" maxlength="500"></textarea>
									</div>
            					</td>
            					<td>
            						<input type="date" name="fecha_actual" class="form-control" value="{{  date("Y-m-d") }}" readonly="">
            					</td>
            					<td style="display: inline-block; width: 150px;">
            						<select name="estatus" class="form-control" required="">
            							<option value="">Seleccionar</option>
            							@foreach($estatusLlamada as $codigo)
	            							<option value="{{ $codigo->codigo }}">{{ $codigo->nombre.' ('.$codigo->codigo.')' }}</option>
            							@endforeach
            						</select>
            					</td>
            					<td>
            						<input type="date" name="fecha_seguimiento" class="form-control" min="{{  date("Y-m-d") }}">
            					</td>
            					<!-- FECHAS ANTERIORES -->
            					@for($i = 0; $i < 4; $i++)
	            					<td>{{ isset($prospecto->asesores->last()->pivot->seguimientoLlamadas[$i]) ? $prospecto->asesores->last()->pivot->seguimientoLlamadas[$i]->citas->last() : ''}}</td>
	            					<td></td>
	            					<td></td>
	            					<td></td>
	            					<td></td>
	            					<td></td>
            					@endfor
            				</tr>
        				@endforeach
        			</tbody>
        		</table>
            </div>
            <div class="card-footer">
            	<div class="text-center">
            		<button class="btn btn-success">Guardar</button>
            	</div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script> 
    <script>
    	$(document).ready(function() {
    		var table = $('#seguimientotable').DataTable({
    			"columnDefs": [{
		            "orderable": false,
		            "targets": [3,4,5,6]
		        }],
		        "scrollX": true,
	            "language": {
	                "sProcessing": "Procesando...",
	                "sLengthMenu": "Mostrar _MENU_ registros",
	                "sZeroRecords": "No se encontraron resultados",
	                "sEmptyTable": "Ningún dato disponible en esta tabla",
	                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
	                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
	                "sInfoPostFix": "",
	                "sSearch": "Buscar:",
	                "sUrl": "",
	                "sInfoThousands": ",",
	                "sLoadingRecords": "Cargando...",
	                "oPaginate": {
	                    "sFirst": "Primero",
	                    "sLast": "Último",
	                    "sNext": "Siguiente",
	                    "sPrevious": "Anterior"
	                },
	                "oAria": {
	                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
	                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	                }
	            }
	        });
    	});
    </script>
@endsection