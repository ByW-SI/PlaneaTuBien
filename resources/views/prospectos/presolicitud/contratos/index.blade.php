@extends('principal')
@section('content')
<div class="card">
	@include('prospectos.presolicitud.navs',['prospectos'=>$prospecto,'presolicitud'=>$presolicitud,'active'=>'Contratos'])
	<div class="card-body">
		<div class="row">
		
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">Número de contrato</th>
					<th scope="col">Total</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($presolicitud->contratos as $contrato)
					<tr>
						<th scope="row">{{$contrato->numero_contrato}}</th>
						<td>${{number_format($contrato->monto,2)}}</td>
						<td>
							<div class="d-flex justify-content-center mb-3">
								{{-- <a href="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">
								Imprimir Presolicitud</a> --}}
						      	<a href="{{ route('contratos.checklist.index',['contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Checklist</a>
								
						      	<a href="{{ route('prospectos.presolicitud.contratos.contrato',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Contrato</a>
						      	
						      	{{-- <a href="{{ route('prospectos.presolicitud.recibos.declaracion_salud',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]) }}" class="btn btn-info btn-sm mr-3">Declaración de Salud</a> --}}
						      	<a href="{{ route('contratos.domiciliacion.index',['contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Formato de Domiciliación</a>
						      	<a href="{{ route('prospectos.presolicitud.contratos.ficha_deposito',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Ficha de Deposito</a>
					      		@if ($presolicitud->cotizacion())
								  @if ($presolicitud->cotizacion()->tipo_inscripcion == 'inscripcion_total')
								  {{-- expr --}}
								  <a href="{{ route('prospectos.presolicitud.contratos.anexo_tanda',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Anexo {{$presolicitud->perfil->cotizacion->plan->nombre}}</a>
							  @elseif($presolicitud->cotizacion()->plan->abreviatura == "TC")
								  <a href="{{ route('prospectos.presolicitud.contratos.anexo_tanda_clasica',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Anexo Tanda Clasica</a>
							  @else
								  <a href="{{ route('prospectos.presolicitud.contratos.anexo_inscripcion_diferida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato]) }}" class="btn btn-info btn-sm mr-3">Anexo Inscripcion Diferida</a>

							  @endif
								  @endif

							</div>
						</td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table>
		</div>
	</div>
	@include('prospectos.presolicitud.footer',['presolicitud'=>$presolicitud])
	

</div>
@endsection