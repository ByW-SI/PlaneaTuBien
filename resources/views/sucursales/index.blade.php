@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
    	<div class="row">
    		<div class="col-sm-4">
    			<h4>Sucursales:</h4>
    		</div>
    		<div class="col-sm-4 text-center">
    			<a href="{{ route('sucursals.create') }}" class="btn btn-success">
    				<i class="fa fa-plus"></i><strong> Agregar Sucursal</strong>
    			</a>
    		</div>
    	</div>
    </div>
    <div class="card-body">
    	<div class="row">
    		<div class="col-sm-12">
    			@if(count($sucursales) > 0)
	    			<table class="table table-bordered table-stripped table-hover">
	    				<tr class="table-primary">
	    					<th>Nombre</th>
	    					<th>Responsable</th>
	    					<th>Estado</th>
	    					<th>Teléfono</th>
	    					<th>Acción</th>
	    				</tr>
	    				@foreach($sucursales as $sucursal)
							<tr>
								<td>{{ $sucursal->nombre }}</td>
								<td>{{ $sucursal->responsable }}</td>
								<td>{{ $sucursal->estado }}</td>
								<td>{{ $sucursal->telefono ? $sucursal->telefono : 'N/A' }}</td>
								<td class="text-center">
									<a href="{{ route('sucursals.show', ['sucursal' => $sucursal]) }}" class="btn btn-sm btn-primary">
										<i class="fa fa-eye"></i> Ver
									</a>
									<a href="{{ route('sucursals.edit', ['sucursal' => $sucursal]) }}" class="btn btn-sm btn-warning">
										✎ Editar
									</a>
									<form action="{{ route('sucursals.destroy', ['sucursal' => $sucursal]) }}" style="display: inline;" method="post">
										{{ csrf_field() }}
										@method('DELETE')
										<button type="submit" class="btn btn-sm btn-danger">
											<i class="fa fa-times"></i> Eliminar
										</button>
									</form>
								</td>
							</tr>
	    				@endforeach
	    			</table>
    			@else
    				<h4>No hay sucursales disponibles.</h4>
    			@endif
    		</div>
    	</div>
    </div>
</div>

@endsection