@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Contratos'])
	<div class="card-body">
		<div class="row">

			<div class="col-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th scope="col">Número de contrato</th>
							<th scope="col">Grupo</th>
							<th scope="col">Total</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($presolicitud->contratos as $contrato)
						<tr>
							<th scope="row">{{$contrato->numero_contrato}}</th>
							<td>
								{{$contrato->grupo->id}}

								{{-- BOTON EDITAR GRUPO --}}
								<button type="button" class="btn btn-warning" data-toggle="modal"
									data-target="#modal-editar-grupo-{{$contrato->id}}">
									{{-- <i class="fa fa-pencil" aria-hidden="true"></i> --}}
									editar
								</button>

								{{-- MODAL EDITAR GRUPO --}}
								<div class="modal fade" id="modal-editar-grupo-{{$contrato->id}}" tabindex="-1"
									role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">{{$contrato->id}}</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form
												action="{{route('contratos.grupo.update',['contrato' => $contrato->id])}}"
												method="POST">
												@method('PUT')
												@csrf
												<div class="modal-body">
													<div class="row">
														<div class="col-12">
															<label for="" class="text-muted text-uppercase">Nuevo
																grupo</label>
															<select name="nuevoGrupo" id="" required
																class="form-control">
																@foreach ($grupos as $grupo)
																<option value="{{$grupo->id}}"
																	{{$contrato->grupo->id == $grupo->id ? 'selected' : ''}}>
																	{{$grupo->id}}</option>
																@endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-success">Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>


							</td>
							<td>${{number_format($contrato->monto,2)}}</td>
							<td>
								<div class="d-flex justify-content-center mb-3">
									{{-- <a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}"
									class="btn btn-info btn-sm mr-3">
									Imprimir Presolicitud</a> --}}
									<a href="{{ route('contratos.checklist.index',['contrato'=>$contrato]) }}"
										class="btn btn-info btn-sm mr-3">Checklist</a>

									<a href="{{ route('prospectos.presolicitud.contratos.contrato',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}"
										class="btn btn-info btn-sm mr-3">Contrato</a>

									{{-- <a href="{{ route('prospectos.presolicitud.recibos.declaracion_salud',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}"
									class="btn btn-info btn-sm mr-3">Declaración de Salud</a> --}}
									{{-- <a href="{{ route('contratos.domiciliacion.index',['contrato'=>$contrato]) }}"
									class="btn btn-info btn-sm mr-3">Formato de Domiciliación</a> --}}
									<a href="{{ route('prospectos.presolicitud.contratos.ficha_deposito',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}"
										class="btn btn-info btn-sm mr-3">Ficha de Deposito</a>
									@if ($presolicitud->cotizacion())
									@if ($presolicitud->cotizacion()->tipo_inscripcion == 'inscripcion_total')
									{{-- expr --}}
									<a href="{{ route('prospectos.presolicitud.contratos.anexo_tanda',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}"
										class="btn btn-info btn-sm mr-3">Anexo
										{{$presolicitud->perfil->cotizacion->plan->nombre}}</a>
									@elseif($presolicitud->cotizacion()->plan->abreviatura == "TC")
									<a href="{{ route('prospectos.presolicitud.contratos.anexo_tanda_clasica',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}"
										class="btn btn-info btn-sm mr-3">Anexo Tanda Clasica</a>
									@else
									<a href="{{ route('prospectos.presolicitud.contratos.anexo_inscripcion_diferida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">
										Anexo Inscripcion Diferida
									</a>

									@endif
									@endif

									<a class="btn btn-info btn-sm mr-3" href="{{ route('prospectos.presolicitud.contratos.anexo_plan_libre',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}">
										Anexo Plan libre
									</a>


								</div>
							</td>
						</tr>
						@empty
						@endforelse
					</tbody>
				</table>
			</div>

		</div>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])


</div>
@endsection