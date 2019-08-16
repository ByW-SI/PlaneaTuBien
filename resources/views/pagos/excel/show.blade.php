@extends('principal')
@section('content')
    <div class="container">
        <form role="form" method="POST" action="{{ route('excel.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="row">
                        {{-- Archivo de excel a subir --}}
                        <div class="form-group col-sm-12">
                            <label for="excel_file">Seleccionar archivo a importar:</label>
                            <input class="form-control" name="excel_file" type="file" id="excel_file" accept=".xls, .xlsx, .csv">
                        </div>
                        {{-- Boton para subir archivo excel --}}
                        <div class="form-group col-sm-12">
                            <input class="btn btn-success btn-block" type="submit" value="Importar">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>
        <form role="form" method="GET" action="{{ route('excel.find') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    {{-- caja de busqueda --}}
                    <div class="form-group col-sm-12">
                        <label for="query">Referencia a buscar:</label>
                        <input class="form-control" name="query" type="text" id="query" accept=".xls, .xlsx, .csv">
                    </div>
                    {{-- Boton para realizar busqueda --}}
                    <div class="form-group col-sm-12">
                        <input class="btn btn-success btn-block" type="submit" value="Buscar">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </form>
    </div>
    {{-- Tabla --}}
    <h3 class="text-center my-3">Estados de cuenta</h3>
		<div class="row">
			{{-- {{ dd($plan->cotizador($cotizacion->monto, $cotizacion->factor_actualizacion)['corrida']) }} --}}
			<div class="col-sm-8 offset-2">
				<table class="table table-bordered table-striped" id="corrida">
					<thead>
						<tr>
							<th class="text-center" scope="col">#</th>
							<th class="text-center" scope="col">Referencia</th>
							<th class="text-center" scope="col">Contrato</th>
							<th class="text-center" scope="col">Cliente</th>
							<th class="text-center" scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($depostios_efectivos as $deposito_efectivo)
						<tr>
							<td>{{$deposito_efectivo->id}}</td>
							<td>{{$deposito_efectivo->concepto}}</td>
							<td>3</td>
							<td>4</td>
							<td>
                                <a href="#" class="btn btn-warning">Detalles</a>
                            </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		console.log($('#corrdia'));
	    $('#corrida').DataTable();
	} );
</script>
@endsection