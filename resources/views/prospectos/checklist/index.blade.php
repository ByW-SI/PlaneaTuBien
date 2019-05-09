@extends('layouts.app')
@section('content')
	<div class="card">
		<div class="card-header">
			<h4><a class="btn btn-info btn-sm mr-3" href="{{ route('prospectos.presolicitud.recibos.index',['presolicitud'=>$presolicitud,'prospecto'=>$presolicitud->perfil->prospecto]) }}"><i class="fas fa-arrow-circle-left"></i>Regresar</a>CHECKLIST FOLDER DE {{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}} RECIBO {{$recibo->clave.$recibo->id}}
			</h4>
		</div>
		<div class="card-body">
			<div class="d-flex flex-column justify-content-center">
				<div class="mx-auto">
					<h4>
						Ficha de deposito <input type="checkbox" readonly disabled {{$recibo->checklist->ficha_deposito_path ? 'checked=""' : '' }}>
						@if ($recibo->checklist->ficha_deposito_path)
							<a href="{{ url('/storage/'.$recibo->checklist->ficha_deposito_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Perfil <input type="checkbox" readonly disabled {{$recibo->checklist->perfil_path ? 'checked=""' : '' }}>
					@if ($recibo->checklist->perfil_path)
					 	{{-- expr --}}
						<a href="{{ url('/storage/'.$recibo->checklist->perfil_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
					 @endif 
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Presolicitud firmada <input type="checkbox" readonly disabled {{$recibo->checklist->presolicitud_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->presolicitud_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->presolicitud_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Contrato firmado <input type="checkbox" readonly disabled {{$recibo->checklist->contrato_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->contrato_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->contrato_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Hoja de aceptación de seguro <input type="checkbox" readonly disabled {{$recibo->checklist->hoja_aceptacion_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->hoja_aceptacion_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->hoja_aceptacion_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Manual del consumidor firmado <input type="checkbox" readonly disabled {{$recibo->checklist->manual_consumidor_path ? 'checked=""' : '' }}>
					@if ($recibo->checklist->manual_consumidor_path)
					 	{{-- expr --}}
						<a href="{{ url('/storage/'.$recibo->checklist->manual_consumidor_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
					 @endif 
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Cuestionario de calidad <input type="checkbox" readonly disabled {{$recibo->checklist->calidad_path ? 'checked=""' : '' }}>
						@if ($recibo->checklist->calidad_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->calidad_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Aviso de privacidad <input type="checkbox" readonly disabled {{$recibo->checklist->privacidad_path ? 'checked=""' : '' }}> @if ($recibo->checklist->privacidad_path)
						{{-- expr --}}
						<a href="{{ url('/storage/'.$recibo->checklist->privacidad_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
					@endif
				</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Copia ficha de deposito <input type="checkbox" readonly disabled {{$recibo->checklist->copia_ficha_deposito_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->copia_ficha_deposito_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->copia_ficha_deposito_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Identificación Oficial <input type="checkbox" readonly disabled {{$recibo->checklist->identificacion_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->identificacion_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->identificacion_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Comprobante de Domicilio <input type="checkbox" readonly disabled {{$recibo->checklist->comprobante_domicilio_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->comprobante_domicilio_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->comprobante_domicilio_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Croquis de ubicación <input type="checkbox" readonly disabled {{$recibo->checklist->croquis_ubicacion_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->croquis_ubicacion_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->croquis_ubicacion_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Carta de Bienvenida <input type="checkbox" readonly disabled {{$recibo->checklist->carta_bienvenida_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->carta_bienvenida_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->carta_bienvenida_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Anexo <input type="checkbox" readonly disabled {{$recibo->checklist->anexos_path ? 'checked=""' : '' }}> 
						@if ($recibo->checklist->anexos_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$recibo->checklist->anexos_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
				<a class="btn btn-success mr-3" href="{{ route('recibos.checklist.create',['presolicitud'=>$presolicitud]) }}"><i class="fas fa-save"></i> Subir/Actualizar Checklist</a>
				@if ($recibo->checklist->status)
					<a class="btn btn-success mr-3" href="{{ route('recibos.checklist.show',['presolicitud'=>$presolicitud,'checklist'=>$recibo->checklist]) }}"><i class="fas fa-save"></i> Descargar Checklist</a>
				@endif

			</div>
		</div>
	</div>
@endsection