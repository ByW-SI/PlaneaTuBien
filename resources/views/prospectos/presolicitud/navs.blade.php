 <div class="card-header">
	<h5>
		Pre solicitud para {{$prospecto->nombre." ".$prospecto->appaterno." ".$prospecto->apmaterno}}
	</h5>
  @if ($presolicitud->status < 100)   
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$presolicitud->status}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$presolicitud->status}}%"></div>
    </div>
  @else
    <div class="d-flex justify-content-center">
      <div class="input-group mb-3 w-25 mr-3">
        <form class="form-inline" action="{{ route('prospectos.presolicitud.recibos.pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$presolicitud->recibo]) }}" method="POST">
          @csrf
          <select name="contrato" id="contrato" class="form-control" required="">
            <option value="">Contrato</option>
            @forelse ($presolicitud->recibo->contratos as $contrato)
             
              <option value="{{$contrato->numero_contrato}}">#{{$contrato->numero_contrato}}</option>
            @empty
              
            @endforelse
          </select>
          <div class="input-group-append">
            <button class="btn btn-info" type="submit" id="button-addon2">Imprimir Presolicitud</button>
          </div>
        </form>
      </div>
      <div class="input-group mb-3 w-50 mr-3">
        <form class="form-inline" action="{{ route('prospectos.presolicitud.recibos.declaracion_salud',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$presolicitud->recibo]) }}" method="POST">
          @csrf
          <input type="text" name="folio" id="folio" placeholder="No. de Poliza" class="form-control" required="">
          <div class="input-group-append">
            <button class="btn btn-info" type="submit" id="button-addon2">Declaración de salud</button>
          </div>
        </form>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <div>
        <a href="{{ route('prospectos.presolicitud.manual',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info mr-3">Manual del consumidor</a>
      </div>
      <div>
        <a href="{{ route('prospectos.presolicitud.consentimiento_seguro',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info mr-3">Consentimiento de Seguro</a>
      </div>
      <div>
        <a href="{{ route('prospectos.presolicitud.aviso_privacidad',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info mr-3">Aviso de Privacidad</a>
      </div>
      <div>
        <a href="{{ route('prospectos.presolicitud.carta_bienvenida',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info mr-3">Carta de Bienvenida</a>
      </div>
      <div>
        <a href="{{ route('prospectos.presolicitud.cuestionario_calidad',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" class="btn btn-info mr-3">Cuestionario de Calidad</a>
      </div>
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
  @if (!$presolicitud->recibo->contratos->isEmpty())
    <li class="nav-item">
      <a class="nav-link {{$active == "Contratos" ? 'active' :''}}" href="{{ route('prospectos.presolicitud.contratos.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]) }}" tabindex="-1" aria-disabled="false">CONTRATOS</a>
    </li>
  @endif
</ul>