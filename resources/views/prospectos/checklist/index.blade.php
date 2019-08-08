@extends('principal')
@section('content')
	<div class="card">
		<div class="card-header">
			<h4><a class="btn btn-info btn-sm mr-3" href="{{ route('prospectos.presolicitud.contratos.index',['presolicitud'=>$presolicitud,'prospecto'=>$presolicitud->perfil->prospecto]) }}"><i class="fas fa-arrow-circle-left"></i>Regresar</a>CHECKLIST FOLDER DE {{$presolicitud->nombre." ".$presolicitud->paterno." ".$presolicitud->materno}} CONTRATO {{$contrato->numero_contrato}}
			</h4>
		</div>
		<div class="card-body">
			<div class="d-flex flex-column justify-content-center">
				<div class="mx-auto">
					<h4>
						Ficha de deposito <input type="checkbox" readonly disabled {{$contrato->checklist->ficha_deposito_path ? 'checked=""' : '' }}>
						@if ($contrato->checklist->ficha_deposito_path)
							<a href="{{ url('/storage/'.$contrato->checklist->ficha_deposito_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Perfil <input type="checkbox" readonly disabled {{$contrato->checklist->perfil_path ? 'checked=""' : '' }}>
					@if ($contrato->checklist->perfil_path)
					 	{{-- expr --}}
						<a href="{{ url('/storage/'.$contrato->checklist->perfil_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
					 @endif 
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Presolicitud firmada <input type="checkbox" readonly disabled {{$contrato->checklist->presolicitud_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->presolicitud_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->presolicitud_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Contrato firmado <input type="checkbox" readonly disabled {{$contrato->checklist->contrato_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->contrato_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->contrato_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Hoja de aceptación de seguro <input type="checkbox" readonly disabled {{$contrato->checklist->hoja_aceptacion_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->hoja_aceptacion_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->hoja_aceptacion_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Manual del consumidor firmado <input type="checkbox" readonly disabled {{$contrato->checklist->manual_consumidor_path ? 'checked=""' : '' }}>
					@if ($contrato->checklist->manual_consumidor_path)
					 	{{-- expr --}}
						<a href="{{ url('/storage/'.$contrato->checklist->manual_consumidor_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
					 @endif 
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Cuestionario de calidad <input type="checkbox" readonly disabled {{$contrato->checklist->calidad_path ? 'checked=""' : '' }}>
						@if ($contrato->checklist->calidad_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->calidad_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Aviso de privacidad <input type="checkbox" readonly disabled {{$contrato->checklist->privacidad_path ? 'checked=""' : '' }}> @if ($contrato->checklist->privacidad_path)
						{{-- expr --}}
						<a href="{{ url('/storage/'.$contrato->checklist->privacidad_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
					@endif
				</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Copia ficha de deposito <input type="checkbox" readonly disabled {{$contrato->checklist->copia_ficha_deposito_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->copia_ficha_deposito_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->copia_ficha_deposito_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Identificación Oficial <input type="checkbox" readonly disabled {{$contrato->checklist->identificacion_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->identificacion_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->identificacion_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Comprobante de Domicilio <input type="checkbox" readonly disabled {{$contrato->checklist->comprobante_domicilio_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->comprobante_domicilio_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->comprobante_domicilio_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Croquis de ubicación <input type="checkbox" readonly disabled {{$contrato->checklist->croquis_ubicacion_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->croquis_ubicacion_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->croquis_ubicacion_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Carta de Bienvenida <input type="checkbox" readonly disabled {{$contrato->checklist->carta_bienvenida_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->carta_bienvenida_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->carta_bienvenida_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4 for="">Anexo <input type="checkbox" readonly disabled {{$contrato->checklist->anexos_path ? 'checked=""' : '' }}> 
						@if ($contrato->checklist->anexos_path)
							{{-- expr --}}
							<a href="{{ url('/storage/'.$contrato->checklist->anexos_path) }}" class="btn btn-info"><i class="far fa-eye"></i> Ver</a>  
						@endif
					</h4>
				</div>
				<div class="mx-auto">
					<h4>Estado del CheckList: 
						@if($contrato->checklist->firmas == 0)
							<span class="alert-link">Sin revisar</span> 
						@elseif($contrato->checklist->firmas == 1)
							<span class="alert-success">Aprobado</span>
						@else
							<span class="alert-danger">Rechazado</span>
						@endif
					</h4>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="d-flex justify-content-center">
			@if(Auth::user()->empleado->tipo != "Gerente" && Auth::user()->empleado->tipo != "Admin")
				<a class="btn btn-success mr-3" href="{{ route('contratos.checklist.create',['contrato'=>$contrato]) }}"><i class="fas fa-save"></i> Subir/Actualizar Checklist</a>
				@if ($contrato->checklist->status)
					<a class="btn btn-success mr-3" href="{{ route('contratos.checklist.show',['contrato'=>$contrato,'checklist'=>$contrato->checklist]) }}"><i class="fas fa-save"></i> Descargar Checklist</a>
				@endif
			@else
				<a class="btn btn-success mr-3" href="{{ route('checklist.aprobar',['contrato'=>$contrato, 'checklist' => $contrato->checklist, 'aprobado'=>1]) }}"><i class="fas fa-check"></i> Aprobar CheckList</a>
				<a class="btn btn-danger mr-3" href="{{ route('checklist.aprobar',['contrato'=>$contrato, 'checklist' => $contrato->checklist, 'aprobado'=>2]) }}"><i class="fas fa-times"></i> Rechazar CheckList</a>
			@endif

			</div>
		</div>
	</div>
@endsection