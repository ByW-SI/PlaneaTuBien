<form action="{{route('citas.store')}}" method="POST">
  <div class="modal fade" id="citaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
          <input type="text" name="prospecto_id" value="{{$prospecto->id}}">
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="recipient-name" class="col-form-label">Clave de Preautorizacion:</label>
              <input type="text" class="form-control" value="POLJH/LP/3/0300" name="clave_preautorizacion">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Fecha de cita:</label>
              <input type="date" name="fecha_cita" class="form-control">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Número de tarjetas:</label>
              <input type="text" name="numeroTarjeta" class="form-control">
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Cuánto gana al mes:</label>
              <input type="text" name="sueldo" class="form-control" maxlength="4" pattern="[0-9]{4}">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Estado civil:</label>
              <select name="estado_civil" class="form-control">
                <option value="">Seleccionar</option>
                @foreach(App\TipoEstadoCivil::get() as $estado_civil)
                <option value="{{ $estado_civil->codigo }}">
                  {{ $estado_civil->nombre . ' (' .$estado_civil->codigo. ')' }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Situación inmobiliaria:</label>
              <select name="estado_civil" class="form-control">
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
              <input type="text" class="form-control" name="nombreConyuge">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Edad del conyugue:</label>
              <input type="number" class="form-control" name="edadConyuge">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Edad del prospecto:</label>
              <input type="number" class="form-control" name="edad">
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Monto del proyecto:</label>
              <input type="number" class="form-control" name="montoProyecto">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono celular 2:</label>
              <input type="text" class="form-control" name="celular_2">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono oficina:</label>
              <input type="text" class="form-control" name="telefonoOficina">
            </div>
          </div>
          <!-- FILA-->
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono cónyuge:</label>
              <input type="text" class="form-control" name="telefonoConyugue">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Teléfono casa:</label>
              <input type="text" class="form-control" name="telefonoCasa">
            </div>
            <div class="form-group col-sm-4">
              <label for="message-text" class="col-form-label">Correo 1:</label>
              <input type="email" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Correo 2:</label>
            <input type="email" class="form-control" name="email_2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>