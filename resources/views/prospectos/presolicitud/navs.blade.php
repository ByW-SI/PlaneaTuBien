 <div class="card-header">
	<h5>
		Pre solicitud para {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
	</h5>
  @if ($prospecto->recibos)   
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$presolicitud->status}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$presolicitud->status}}%"></div>
    </div>
  @else
    <div class="d-flex justify-content-start">
      
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