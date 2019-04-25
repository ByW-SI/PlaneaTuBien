 <div class="card-header">
	<h5>
		Pre solicitud para {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
	</h5>
  @if ($prospecto->status <100)   
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$presolicitud->status}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$presolicitud->status}}%"></div>
    </div>
  @else
    <div class="d-flex justify-content-start">
      <a href="{{ route('prospectos.presolicitud.manual',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Manual del consumidor</a>
      <a href="{{ route('prospectos.presolicitud.contrato',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Contrato</a>
      <a href="{{ route('prospectos.presolicitud.aviso_privacidad',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Aviso de Privacidad</a>
      <a href="{{ route('prospectos.presolicitud.carta_bienvenida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Carta de Bienvenida</a>
      <a href="{{ route('prospectos.presolicitud.consentimiento_seguro',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Consentimiento de Seguro</a>
      <a href="{{ route('prospectos.presolicitud.cuestionario_calidad',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Cuestionario de Calidad</a>
      <a href="{{ route('prospectos.presolicitud.declaracion_salud',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Declaración de Salud</a>
      <a href="{{ route('prospectos.presolicitud.domiciliacion',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Formato de Domiciliación</a>
      <a href="{{ route('prospectos.presolicitud.ficha_deposito',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Ficha de Deposito</a>
      {{-- <a href="{{ route('prospectos.presolicitud.anexo_tanda',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info btn-sm mr-3">Anexo {{$presolicitud->perfil->cotizacion->plan->nombre}}</a> --}}
    </div>
  @endif
</div>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{$active == "Solicitante" ? 'active' :''}}" href="{{ route('prospectos.presolicitud.index',['prospecto'=>$prospecto]) }}">SOLICITANTE</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{$active == "Conyuge" ? 'active' :''}}" href="{{ route('prospectos.presolicitud.conyuge.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" tabindex="-1" aria-disabled="false">CÓNYUGE, CONCUBINO U  OBLIGADO SOLIDARIO</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{$active == "Beneficiario" ? 'active' :''}}" href="{{ route('prospectos.presolicitud.beneficiarios.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" tabindex="-1" aria-disabled="false">BENEFICIARIO</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{$active == "Referencias" ? 'active' :''}}" href="{{ route('prospectos.presolicitud.referencias.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" tabindex="-1" aria-disabled="false">REFERENCIAS PERSONALES</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{$active == "Recibo" ? 'active' :''}}" href="{{ route('prospectos.presolicitud.recibos.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" tabindex="-1" aria-disabled="false">RECIBO PROVISIONAL</a>
  </li>
</ul>