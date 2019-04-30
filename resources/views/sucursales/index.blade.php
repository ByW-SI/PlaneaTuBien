@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
    	<div class="row">
    		<div class="col-sm-4">
    			<h4>Sucursales:</h4>
    		</div>
    		@php
			$ver = false;
			$editar = false;
			$eliminar = false;
			$crear = false;		
			foreach(Auth::user()->perfil->componentes as $c){
				if($c->nombre == "ver sucursal")
					$ver = true;
				
				if($c->nombre == "editar sucursal")
					$editar = true;
				
				if($c->nombre == "eliminar sucursal")
					$eliminar = true;
				if($c->nombre == "crear sucursal")
					$crear = true;
			}
			@endphp
			@if($crear)
	    		<div class="col-sm-4 text-center">
	    			<a href="{{ route('sucursals.create') }}" class="btn btn-success">
	    				<i class="fa fa-plus"></i><strong> Agregar Sucursal</strong>
	    			</a>
	    		</div>
    		@endif
    	</div>
    </div>
    <div class="card-body">
    	<div class="row">
    		<div class="col-sm-12">
    			@if(count($sucursales) > 0)
	    			<table class="table table-bordered table-stripped table-hover" style="margin-bottom: 0px;">
	    				<tr class="table-primary">
	    					<th>Nombre</th>
	    					<th>Responsable</th>
	    					<th>Estado</th>
	    					<th>Teléfono</th>
	    					@if($ver || $editar || $eliminar)
	    						<th>Acción</th>
	    					@endif
	    				</tr>
	    				@foreach($sucursales as $sucursal)
							<tr>
								<td>{{ $sucursal->nombre }}</td>
								<td>{{ $sucursal->responsable }}</td>
								<td>{{ $sucursal->estado }}</td>
								<td>{{ $sucursal->telefono ? $sucursal->telefono : 'N/A' }}</td>
								@if($ver || $editar || $eliminar)
								<td class="text-center">
	                            	@if($ver)
										<a href="{{ route('sucursals.show', ['sucursal' => $sucursal]) }}" class="btn btn-sm btn-primary">
											<i class="fa fa-eye"></i> Ver
										</a>
									@endif
									@if($editar)
										<a href="{{ route('sucursals.edit', ['sucursal' => $sucursal]) }}" class="btn btn-sm btn-warning">
											✎ Editar
										</a>
									@endif
									@if($eliminar)
										<form action="{{ route('sucursals.destroy', ['sucursal' => $sucursal]) }}" style="display: inline;" method="post">
											{{ csrf_field() }}
											@method('DELETE')
											<button type="submit" class="btn btn-sm btn-danger">
												<i class="fa fa-times"></i> Eliminar
											</button>
										</form>
									@endif
								</td>
								@endif
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