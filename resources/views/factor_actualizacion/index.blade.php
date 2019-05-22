@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			<h5>FACTOR DE ACTUALIZACIÓN</h5>
		</div>
		<div class="card-body">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="d-flex justify-content-center mb-3">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearFactorActualizacion"><i class="fas fa-percentage"></i> Nuevo Factor de actualización</button>
				@include('factor_actualizacion.create')
			</div>
			<div class="row">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center" scope="col">#</th>
							<th class="text-center" scope="col">Fecha</th>
							<th class="text-center" scope="col">Porcentaje de factor de actualización</th>
							<th class="text-center" scope="col">Estado</th>
							<th class="text-center" scope="col"></th>
						</tr>
					</thead>
					<tbody>
						@forelse ($factores as $factor)
							<tr>
								
								<td class="text-center" scope="row">
									{{$factor->id}}
								</td>
								<td class="text-center">
									{{$factor->created_at->format('Y-m-d')}}
								</td>
								<td class="text-center">
									{{$factor->porcentaje}}%
								</td>
								<td class="text-center">
									{{$factor->autorizar ? 'Autorizado' : 'No Autorizado'}}
								</td>
								<td class="text-center">
									<div class="d-flex justify-content-around">
										@if (!$factor->autorizar)
											{{-- expr --}}
											<form action="{{ route('factors.update',['factor'=>$factor]) }}" method="POST">
												@csrf
												@method('PUT')
												<button type="button" class="btn btn-sm btn-primary swa-confirm"><i class="fas fa-check"></i> Autorizar</button>
											</form>
											<form action="{{ route('factors.destroy',['factor'=>$factor]) }}" method="POST">
												@csrf
												@method('DELETE')
												<button type="button" class="btn btn-sm btn-danger swa-confirm-destroy"><i class="far fa-trash-alt"></i> Eliminar</button>
											</form>
										@endif
									</div>
								</td>
							</tr>
						@empty
							<div class="alert alert-info" role="alert">
							  	Todavía no hay ningún factor de actualización (actualmente se encuentra en el 3%), <a href="#" class="alert-link" data-toggle="modal" data-target="#crearFactorActualizacion">haz click aquí</a> para agregar uno.
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer"></div>
	</div>
@endsection
@push('scripts')
	<script>
		$(".swa-confirm").on("click", function(e) {
		    e.preventDefault();
		    swal({
			  title: "¿Desea autorizar este factor de actualización?",
			  text: "Una vez autorizado, este factor se aplicará en los proximos contratos y cotizaciones",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  confirmButtonText: 'Autorizar',
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$(this).closest('form').submit();
			    swal("Se autorizo este factor de actualización", {
			      icon: "success",
			    });
			  } else {
			    swal("No se autorizo este factor de actualización");
			  }
			});
		});
		$(".swa-confirm-destroy").on("click", function(e) {
		    e.preventDefault();
		    swal({
			  title: "¿Desea eliminar este factor de actualización?",
			  text: "Una vez eliminado, este factor no se vera en esta tabla",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  confirmButtonText: 'Autorizar',
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$(this).closest('form').submit();
			    swal("Se elimino este factor de actualización", {
			      icon: "success",
			    });
			  } else {
			    swal("Cancelado");
			  }
			});
		});
	</script>
@endpush