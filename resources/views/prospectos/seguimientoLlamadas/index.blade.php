@extends('principal')
@section('content')
    <div class="container">

        <div class="card mb-5">
        	<div class="card-header">
            	<h3 class="text-center my-3">Seguimiento llamadas</h3>
        	</div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-md-4 input-group mb-3">
						<input type="text" class="form-control" placeholder="Prospecto" aria-label="Prospecto" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
						</div>
					</div>
            	</div>
            	@foreach($prospectos as $prospecto)
            	<div class="table-responsive my-4">
            		<table class="tableb table-striped table-hover">
            			<thead>
            				<tr>
            					<th><b>PROSPECTO:</b></th>
            					<th colspan="12"> {{ $prospecto->fullName }}</th>
            				</tr>
            				<tr class="text-center">
	            				<th class="table-danger">Comentario</th>
	            				<th class="table-primary">Fecha actual</th>
	            				<th class="table-primary">Estatus</th>
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
            				</tr>
            			</thead>
            			<tbody>
            				<tr>
            					<td></td>
            					<td>26/12/2019</td>
            					<td></td>
            					<td></td>
            					{{-- @foreach($prospecto->asesores->last()->) --}}
            					<td>23/12/2019</td>
            					<td>NC</td>
            					<td>26/12/2019</td>
            					<td>20/12/2019</td>
            					<td>NC</td>
            					<td>23/12/2019</td>
            					<td>19/12/2019</td>
            					<td>NC</td>
            					<td>20/12/2019</td>
            					{{-- @endforeach --}}
            				</tr>
            			</tbody>
            		</table>
            	</div>
            	@endforeach
            </div>
        </div>
    </div>
@endsection