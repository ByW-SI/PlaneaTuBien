@extends('principal')
@section('content')
	<div class="card card-default">
		<div class="card-header">
			<h5 class="title">
				Polizas
			</h5>
		</div>
		<div class="card-body">
			<div class="d-flex justify-content-center mb-3">
				<a href="{{ route('polizas.create') }}" class="btn btn-primary">Agregar nueva poliza</a>
			</div>
			<div class="row row-group">
				<table class="table table-striped table-bordered">
					<thead>
						<tr class="table-primary">
							<th scope="col">Nombre</th>
							<th scope="col">Descripción</th>
							<th scope="col">Vigencia</th>
							<th scope="col">Folio</th>
							<th scope="col">Teléfono</th>
							<th scope="col">Asesor</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						@forelse ($polizas as $poliza)
							<tr>
								<td scope="row">
									{{$poliza->nombre}}
								</td>
								<td>
									{{$poliza->descripcion}}
								</td>
								<td>
									De {{date('d-m-Y', strtotime($poliza->fecha_inicio))}} a {{date('d-m-Y', strtotime($poliza->fecha_fin))}}
								</td>
								<td>
									{{$poliza->folio}}
								</td>
								<td>
									{{$poliza->tel_contacto}}
								</td>
								<td>
									{{$poliza->nombre_asesor}}
								</td>
								<td>
									<div class="d-flex justify-content-center">
										<div class="btn-group" role="group" aria-label="Basic button group">
											<button type="button" onclick="verPoliza('{{$poliza->id}}')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Ver</button>
											<a href="{{ route('polizas.edit',['poliza'=>$poliza]) }}" class="btn btn-success">Editar</a>
											<button type="button" 
											onclick="event.preventDefault(); eliminar('destroy{{$poliza->id}}');" class="btn btn-danger">Eliminar</button>
											<form id="destroy{{$poliza->id}}" action="{{ route('polizas.destroy',['poliza'=>$poliza]) }}" method="POST" style="display: none;">
												@method('DELETE')
					                        	{{ csrf_field() }}
					                    	</form>
										</div>
									</div>
								</td>
							</tr>
						@empty
							<div class="alert alert-danger" role="alert">
						  		No hay ninguna poliza registrada. <a href="{{ route('polizas.create') }}" class="alert-link">Haz click aquí para agregar uno</a>.
							</div>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- MODAL --}}
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" id="polizaModal">
	    
	  </div>
	</div>
@endsection
@push('scripts')
	<script>
		function verPoliza(poliza_id) {
			// alert("HOLA")
			$.ajax({
				url: "{{ url('polizas/') }}/"+poliza_id,
				type: "GET",
				dataType: "html",
				success: function(result,status,xhr){
					$("#polizaModal").empty();
					$("#polizaModal").append(result);
				},
				error:function(xhr,status,error){
					swal("Error!", error, "error");
				}
			})
		}
		function eliminar(tag) {
			swal({
			  title: "¿Desea eliminar esta poliza?",
			  text: "Una vez eliminado, esta poliza será eliminada de los registros",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  confirmButtonText: 'Confirmar',
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	document.getElementById(tag).submit();
			    swal("Se elimino este factor de actualización", {
			      icon: "success",
			    });
			  } else {
			    swal("Cancelado");
			  }
			});
			
		}
	</script>
@endpush