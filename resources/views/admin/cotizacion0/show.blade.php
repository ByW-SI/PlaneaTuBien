@extends('principal')
@section('content')
	<div class="card card-default">
		<div class="card-header">
			<h5 class="title">
				Datos del prospecto {{$prospecto->full_name}}
			</h5>
		</div>
		<div class="card-body">
			<div class="row row-group mb-2">
				<div class="col-12 col-md-4">
					<label for="">
						Nombre:
					</label>
					<span class="form-control">
						{{$prospecto->nombre}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Apellido Paterno
					</label>
					<span class="form-control">
						{{$prospecto->appaterno}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Apellido Materno
					</label>
					<span class="form-control">
						{{$prospecto->apmaterno}}
					</span>
				</div>
			</div>
			<div class="row row-group mb-2">
				<div class="col-12 col-md-4">
					<label for="">
						Sexo
					</label>
					<span class="form-control">
						{{$prospecto->sexo}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Correo electrónico
					</label>
					<span class="form-control">
						{{$prospecto->email}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Teléfono
					</label>
					<span class="form-control">
						{{$prospecto->tel}}
					</span>
				</div>
			</div>
			<div class="row row-group mb-2">
				<div class="col-12 col-md-4">
					<label for="">
						Teléfono Movil/Celular
					</label>
					<span class="form-control">
						{{$prospecto->movil}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Monto que desea contratar
					</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<span class="form-control">
							{{number_format($prospecto->monto,2)}}
						</span>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Tiempo en que desea pagar
					</label>
					<span class="form-control">
						{{$prospecto->plan}}
					</span>
				</div>
			</div>
			<div class="row row-group mb-2">
				<div class="col-12 col-md-4">
					<label for="">
						Calificación que le dio el asesor:
					</label>
					<span class="form-control">
						{{$prospecto->calificacion}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Nombre del asesor:
					</label>
					<span class="form-control">
						{{$prospecto->asesor->full_name}}
					</span>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Fecha de asignación:
					</label>
					<span class="form-control">
						{{date('d-m-Y', strtotime($prospecto->fecha_asignado))}}
					</span>
				</div>
			</div>
			<div class="row row-group mb-2">
				<div class="col-12">
					<h5 class="title">
						Datos socioeconómicos:
					</h5>
				</div>
			</div>
			<div class="row row-group mb-2">
				<div class="col-12 col-md-4">
					<label for="">
						Sueldo:
					</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<span class="form-control">
							{{number_format($prospecto->sueldo,2)}}
						</span>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Gastos:
					</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<span class="form-control">
							{{number_format($prospecto->gastos,2)}}
						</span>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<label for="">
						Ahorro:
					</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">$</span>
						</div>
						<span class="form-control">
							{{number_format($prospecto->ahorro,2)}}
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<h5 class="title">
				Datos la cotizacion:
			</h5>
		</div>
		<div class="card-body">
			<div class="card-body">
	            <div class="row">
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Valor de la propiedad:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text">$</span>
	                        </div>
	                        <input type="text" readonly="" value="{{ number_format($cotizacion0->monto,2) }}" class="form-control">
	                    </div>
	                </div>
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Ahorro del cliente:</label>
	                    <div class="input-group">
	                        <input type="text" readonly="" value="{{ $cotizacion0->ahorro }}" class="form-control">
	                        <div class="input-group-append">
	                            <span class="input-group-text">%</span>
	                        </div>   
	                     </div>
	                </div>
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">      Plan:</label>
	                    <input type="text" readonly="" value="{{ $cotizacion0->plan->nombre }}" class="form-control">
	                </div>
	            </div>
	            <div class="row">
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Monto a adjudicar:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text">$</span>
	                        </div>
	                        <input type="text" readonly="" value="{{ number_format($cotizacion0->plan->monto_adjudicar($cotizacion0->monto,$cotizacion0->factor_actualizacion),2) }}" class="form-control">
	                    </div>
	                </div>
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Plazo:</label>
	                    <div class="input-group">
	                        <input type="text" readonly="" value="{{ $cotizacion0->plan->plazo }}" class="form-control">
	                        <div class="input-group-append">
	                            <span class="input-group-text">meses</span>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">{{ $cotizacion0->plan->mes_s_d-1 }} mensualidades de:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text">$</span>
	                        </div>
	                        <input type="text" readonly="" value="{{ number_format($cotizacion0->plan->cotizador($cotizacion0->monto,$cotizacion0->factor_actualizacion)['cuota_periodica_integrante'],2) }}" class="form-control">
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-12">
	                    <table class="table table-stripped table-hover table-bordered">
	                        <tr class="info">
	                            <th>Aportación extraordinaria</th>
	                            <th>%</th>
	                            <th>Monto</th>
	                            <th>Mes</th>
	                        </tr>
	                        <tr>
	                            <td>1</td>
	                            <td>{{ $cotizacion0->plan->aportacion_1 }}</td>
	                            <td>${{ number_format($cotizacion0->plan->monto_aportacion_1($cotizacion0->monto),2) }}</td>
	                            <td>{{ $cotizacion0->plan->mes_1 }}</td>
	                        </tr>
	                        <tr>
	                            <td>2</td>
	                            <td>{{ $cotizacion0->plan->aportacion_2 }}</td>
	                            <td>${{ number_format($cotizacion0->plan->monto_aportacion_2($cotizacion0->monto),2) }}</td>
	                            <td>{{ $cotizacion0->plan->mes_2 }}</td>
	                        </tr>
	                        <tr>
	                            <td>3</td>
	                            <td>{{ $cotizacion0->plan->aportacion_3 }}</td>
	                            <td>${{ number_format($cotizacion0->plan->monto_aportacion_3($cotizacion0->monto),2) }}</td>
	                            <td>{{ $cotizacion0->plan->mes_3 }}</td>
	                        </tr>
	                        <tr>
	                            <td>Liquidación</td>
	                            <td>{{ $cotizacion0->plan->aportacion_liquidacion }}</td>
	                            <td>${{ number_format($cotizacion0->plan->monto_aportacion_liquidacion($cotizacion0->monto),2) }}</td>
	                            <td>{{ $cotizacion0->plan->mes_liquidacion }}</td>
	                        </tr>
	                        <tr>
	                            <td>Anual</td>
	                            <td>{{ $cotizacion0->plan->anual }}</td>
	                            <td>${{ number_format($cotizacion0->plan->monto_aportacion_anual($cotizacion0->monto),2) }}</td>
	                            <td>Cada diciembre</td>
	                        </tr>
	                        @if ($cotizacion0->plan->semestral != 0.00)
	                            <tr>
	                                <td>Semestral</td>
	                                <td>{{ $cotizacion0->plan->semestral }}</td>
	                                <td>${{ number_format($cotizacion0->plan->monto_aportacion_semestral($cotizacion0->monto),2) }}</td>
	                                <td>Cada junio y diciembre</td>
	                            </tr>
	                        @endif
	                    </table>
	                </div>
	            </div>
	            <div class="row">
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Total de aportaciones:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text">$</span>
	                        </div>
	                        <input type="text" value="{{ number_format($cotizacion0->plan->cotizador($cotizacion0->monto,$cotizacion0->factor_actualizacion)['total_aportacion'],2) }}" class="form-control" readonly="">
	                    </div>
	                </div>
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Costo anual de:</label>
	                    <div class="input-group">
	                        <input type="text" value="{{ $cotizacion0->plan->sobrecosto_anual($cotizacion0->monto,$cotizacion0->factor_actualizacion) }}" class="form-control" readonly="">
	                        <div class="input-group-append">
	                            <span class="input-group-text">%</span>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group col-sm-4">
	                    <label class="col-form-label">Inscripción:</label>
	                    <div class="input-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text">$</span>
	                        </div>
	                        <input type="text" value="{{ number_format($cotizacion0->plan->monto_inscripcion_con_iva($cotizacion0->monto),2) }}" class="form-control" readonly="">
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-around">
				<form action="{{ route('cotizacion0.update',['cotizacion0'=>$cotizacion0]) }}" method="POST">
					@csrf
					@method('PUT')
					<button type="button" class="btn btn-sm btn-success mt-3 swa-confirm"><i class="fas fa-check"></i> Autorizar</button>
				</form>
				<form action="{{ route('cotizacion0.destroy',['cotizacion0'=>$cotizacion0]) }}" method="POST">
					@csrf
					@method('DELETE')
					<button type="button" class="btn btn-sm btn-danger mt-3 swa-delete"><i class="fas fa-times"></i> No Autorizar</button>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script>
		$(".swa-confirm").on("click", function(e) {
		    e.preventDefault();
		    swal({
			  title: "¿Desea autorizar esta cotización?",
			  text: "Una vez autorizado, esta no podrá ser cambiada.",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  confirmButtonText: 'Autorizar',
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$(this).closest('form').submit();
			    swal("Se autorizo esta cotizacion", {
			      icon: "success",
			    });
			  } else {
			    swal("No se autorizo esta cotización");
			  }
			});
		});
		$(".swa-delete").on("click", function(e) {
		    e.preventDefault();
		    swal({
			  title: "¿Desea no autorizar y eliminar esta cotización?",
			  text: "Una vez no autorizada, la cotización será eliminada del sistema.",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  confirmButtonText: 'No autorizar',
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$(this).closest('form').submit();
			    swal("Se autorizo esta cotizacion", {
			      icon: "success",
			    });
			  } else {
			    swal("No se autorizo esta cotización");
			  }
			});
		});
	</script>
@endpush