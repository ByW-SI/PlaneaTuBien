<form action="{{route('citas.store')}}" method="POST">
  <div class="modal fade modalCrearCita" id="citaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" prospectoId={{$prospecto->id}}>
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Generar cita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-3">
              <input type="hidden" class="perteneceAUsuarioAutenticado"
                value="{{$prospecto->perteneceAUsuarioAutenticado()}}" readonly prospectoId={{$prospecto->id}}>
            </div>
            <div class="form-group col-sm-3">
              <input type="hidden" class="oficinaIniciales"
                value="{{$prospecto->asesor()->first()->sucursal->abreviatura}}" readonly
                prospectoId={{$prospecto->id}}>
            </div>
            <div class="form-group col-sm-3">
              <input type="hidden" class="inicialesJefe"
                value="{{$prospecto->asesor()->first()->jefe ? $prospecto->asesor()->first()->jefe->iniciales : ''}}"
                readonly prospectoId="{{$prospecto->id}}">
            </div>
            <div class="form-group col-sm-3">
              <input type="hidden" name="prospecto_id" value="{{$prospecto->id}}">
            </div>
            <div class="form-group col-sm-3">
              <input type="hidden" class="inicialesAsesor" value="{{$prospecto->asesor()->first()->iniciales}}"
                prospectoId="{{$prospecto->id}}">
            </div>
            <div class="form-group col-sm-3">
              <input type="hidden" class="inicialesUsuario" value="{{\Auth::user()->empleado->iniciales}}"
                prospectoId="{{$prospecto->id}}">
            </div>
          </div>
          {{-- FILA --}}
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="recipient-name" class="col-form-label">Clave de Preautorizacion:</label>
              <input type="text" class="form-control clavePreautorizacion" value="{{$prospecto->citas()->first() ? $prospecto->citas()->first()->clave_preautorizacion : ''}}" name="clave_preautorizacion" prospectoId="{{$prospecto->id}}" readonly>
            </div>
            <div class="form-group col-sm-4 contenedorInputFechaCita" prospectoId={{$prospecto->id}}>
              <label for="message-text" class="col-form-label">✱Fecha de cita:</label>
              <input type="date" name="fecha_cita" required class="form-control modalCrearCitaInput inputFechaCita"
                prospectoId={{$prospecto->id}} >
            </div>
            <div class="form-group col-sm-4 contenedorInputHoraCita" prospectoId={{$prospecto->id}}>
              <label for="message-text" class="col-form-label">Hora cita:</label>
              <input type="time" name="hora" class="form-control modalCrearCitaInput inputHoraCita" prospectoId={{$prospecto->id}}>
            </div>
            <div class="form-group col-sm-4 contenedorInputFechaLlamada" prospectoId={{$prospecto->id}}>
              <label for="message-text" class="col-form-label">Fecha llamada</label>
              <input type="date" name="fecha_llamada" class="form-control modalCrearCitaInput inputFechaLlamada" prospectoId={{$prospecto->id}}>
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Número de tarjetas:</label>
              <input type="text" name="numeroTarjeta" class="form-control numeroTarjetas modalCrearCitaInput"
                prospectoId={{$prospecto->id}} value="{{$prospecto->numeroTarjetas}}">
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Cuánto gana al mes:</label>
              <input type="text" name="sueldo" class="form-control sueldo modalCrearCitaInput inputSueldo"
                prospectoId={{$prospecto->id}} value="{{$prospecto->sueldo}}">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Estado civil:</label>
              <select name="estado_civil" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}>
                <option value="">Seleccionar</option>
                @foreach(App\TipoEstadoCivil::get() as $estado_civil)
                <option value="{{ $estado_civil->codigo }}">
                  {{ $estado_civil->nombre . ' (' .$estado_civil->codigo. ')' }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Situación inmobiliaria:</label>
              <select name="estado_civil" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}>
                <option value="">Seleccionar</option>
                @foreach(App\TipoSituacionInmobiliaria::get() as $situacion)
                <option value="{{ $situacion->id }}">{{ $situacion->nombre . ' (' .$situacion->codigo. ')' }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Nombre de cónyuge:</label>
              <input type="text" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="nombreConyuge">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Edad del conyugue:</label>
              <input type="number" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="edadConyuge">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Edad del prospecto:</label>
              <input type="number" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}} name="edad">
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Monto del proyecto:</label>
              <input type="number" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="montoProyecto">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono celular 2:</label>
              <input type="text" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="celular_2">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono oficina:</label>
              <input type="text" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="telefonoOficina">
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono cónyuge:</label>
              <input type="text" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="telefonoConyugue">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono casa:</label>
              <input type="text" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}
                name="telefonoCasa">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Correo 1:</label>
              <input type="email" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}}>
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Correo 2:</label>
            <input type="email" class="form-control modalCrearCitaInput" prospectoId={{$prospecto->id}} name="email_2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
    
    $(document).on('change','.inputFechaLlamada', function(){

      prospectoId = $(this).attr('prospectoId');

      contenedorInputFechaCita = $(`.contenedorInputFechaCita[prospectoId=${prospectoId}]`);
      contenedorInputHoraCita = $(`.contenedorInputHoraCita[prospectoId=${prospectoId}]`);
      inputFechaLlamadaTieneValor = $(this).val() != "";

      if(inputFechaLlamadaTieneValor){
        contenedorInputFechaCita.val("");
        contenedorInputFechaCita.hide();
        contenedorInputHoraCita.val("");
        contenedorInputHoraCita.hide();
      }else{
        contenedorInputFechaCita.show();
        contenedorInputHoraCita.show();
      }

      console.log({
        message: 'CAMBIO FECHA LLAMADA',
        prospectoId,
        inputFechaLlamadaTieneValor,
        contenedorInputFechaCita
      });

    });
    
    $(document).on('change', '.inputFechaCita', function(){

      prospectoId = $(this).attr('prospectoId');

      contenedorInputFechaLlamada = $(`.contenedorInputFechaLlamada[prospectoId=${prospectoId}]`);
      inputFechaCitaTieneValor = $(this).val() != "";

      if(inputFechaCitaTieneValor){
        contenedorInputFechaLlamada.val("");
        contenedorInputFechaLlamada.hide();
      }else{
        contenedorInputFechaLlamada.show();
      }

      console.log({
        message: 'CAMBIO FECHA CITA',
        prospectoId
      });

    });

    /**
    * =========
    * FUNCIONES
    * =========
    */
    
    
    
    async function actualizarDatosProspecto(prospectoId){
    
        console.log(window.location.origin);
        comentario = $(`.inputComentario[prospectoId=${prospectoId}]`).val();
        estatus = $(`.inputEstatus[prospectoId=${prospectoId}] option:selected`).val();
        fechaSeguimiento = $(`.fechaSeguimiento[prospectoId=${prospectoId}]`).val();
    
        console.log('COMENTARIO:',comentario);
        console.log('ESTATUS:',estatus);
        console.log('PROSPECTO ID:',prospectoId);
        console.log('FECHA SIGUIENTE CONTACTO:',prospectoId);
    
    
        response = await $.ajax({
        type:"POST",
        url: window.location.origin + "/api/seguimiento_llamadas/store",
        data:{
            comentario: comentario,
            estatus: estatus,
            prospectoId: prospectoId,
            fechaSeguimiento: fechaSeguimiento
            },
        success:function(response){
            console.log(response);
         },
    });
    
        return response;
    
    }
    
    function modificarInputClavePreautorizacion(prospectoId){
    
        perteneceAUsuarioAutenticado = $(`.perteneceAUsuarioAutenticado[prospectoId=${prospectoId}]`).val();
    
        if(perteneceAUsuarioAutenticado == 1){
            inicialesOficina = $(`.oficinaIniciales[prospectoId=${prospectoId}]`).val();
            inicialesGerente = $(`.inicialesJefe[prospectoId=${prospectoId}]`).val();
            numeroTarjetas = $(`.numeroTarjetas[prospectoId=${prospectoId}]`).val();
            inicialesAsesor = $(`.inicialesAsesor[prospectoId=${prospectoId}]`).val();
            $(`.clavePreautorizacion[prospectoId=${prospectoId}]`).val(
                inicialesOficina + inicialesGerente + "/" + 
                inicialesAsesor + "/" +
                numeroTarjetas + "/" + 
                getSueldoFormateado(prospectoId)
                );
        }else{
            inicialesOficina = $(`.oficinaIniciales[prospectoId=${prospectoId}]`).val();
            inicialesGerente = $(`.inicialesJefe[prospectoId=${prospectoId}]`).val();
            numeroTarjetas = $(`.numeroTarjetas[prospectoId=${prospectoId}]`).val();
            inicialesUsuario = $(`.inicialesUsuario[prospectoId=${prospectoId}]`).val();
            inicialesAsesor = $(`.inicialesAsesor[prospectoId=${prospectoId}]`).val();
            $(`.clavePreautorizacion[prospectoId=${prospectoId}]`).val(
                inicialesOficina + inicialesGerente + "/" + 
                inicialesUsuario + inicialesAsesor + "/" +
                numeroTarjetas + "/" + 
                getSueldoFormateado(prospectoId)
                );
        }
    
        // console.log('oficina',  $(`.inputOficinaAsesor[prospectoId=${prospectoId}]`).val() );
    
    }
    
    function getSueldoFormateado(prospectoId){
        const sueldo = $(`.inputSueldo[prospectoId=${prospectoId}]`).val();
        let formato = (parseInt(sueldo/100)).toString();
    
        while (formato.length < 4) {
            formato = '0' + formato;
        }
    
        console.log({
            mensaje: 'CAMBIARA PREAUTORIZACION',
            sueldo: sueldo,
            formato: formato
        });
    
        return formato;
    }
    
    function mostrarModalCrear(prospectoId){
            $(`.modalCrearCita[prospectoId=${prospectoId}]`).modal('show');
    }
    
    function requiereCita(prospectoId){
        const opcion = getEstatusSeleccionado();
    
        if(opcion.includes('Cita Calificada')){
            return true;
        }
    
        if(opcion.includes('Cita No Calificada')){
            return true;
        }
    
        return false;
    }
    
    function getEstatusSeleccionado(){
        return $(`.inputEstatus[prospectoId=${prospectoId}] option:selected`).text();
    }
    
</script>