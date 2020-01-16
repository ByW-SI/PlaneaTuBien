<!-- Modal -->
<div class="modal fade modalCitas-{{$cita->prospecto->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$cita->prospecto->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('citas.update', ['id'=>$cita])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 mt-2">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{$cita->prospecto->nombre}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Apellido paterno</label>
                            <input type="text" name="appaterno" class="form-control"
                                value="{{$cita->prospecto->appaterno}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Apellido materno</label>
                            <input type="text" name="apmaterno" class="form-control"
                                value="{{$cita->prospecto->apmanterno}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Correo electrónico</label>
                            <input type="text" name="email" class="form-control" value="{{$cita->prospecto->email}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                value="{{$cita->prospecto->telefono}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Celular</label>
                            <input type="text" name="celular" class="form-control"
                                value="{{$cita->prospecto->celular}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Asesor</label>
                            <input type="text" name="asesor_id" class="form-control"
                                value="{{$cita->prospecto->empleado->nombre}} {{$cita->prospecto->empleado->appaterno}} {{$cita->prospecto->empleado->apmaterno}}">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Acción</label>
                            <select class="form-control inputAccion" name="accion"
                                prospectoId="{{$cita->prospecto->id}}">
                                <option id="optionConfirmarCita" value="confirmar cita">CONFIRMAR CITA</option>
                                <option id="optionReagendarCita" value="reagendar cita">REAGENDAR CITA</option>
                                <option id="optionLlamarParaReagendar" value="llamar para reagendar">LLAMAR PARA
                                    REAGENDAR</option>
                                <option id="optionCancelarCita" value="cancelar cita">CANCELAR CITA</option>
                            </select>
                        </div>
                        {{-- INPUT NUEVA FECHA CITA --}}
                        <div class="col-12 mt-2">
                            <label for="">Nueva fecha de cita</label>
                            <input type="date" class="form-control" name="nuevaFechaCita">
                        </div>
                        {{-- INPUT NUEVA FECHA LLLAMADA --}}
                        <div class="col-12 mt-2">
                            <label for="">Nueva fecha de llamada</label>
                            <input type="date" class="form-control" name="nuevaFechaLlamada">
                        </div>
                        {{-- INPUT COMENTARIOS --}}
                        <div class="col-12 mt-2">
                            <label for="">Nueva fecha de llamada</label>
                            <textarea name="comentariosCancelacion" class="form-control"></textarea>
                        </div>
                        {{-- INPUT ASESOR QUE CONFIRMA --}}
                        <div class="col-12 mt-2">
                            <label for="">ASESOR QUE CONFIRMA</label>
                            <input type="text" class="form-control" name="idAsesorQueConfirma">
                        </div>
                        {{-- INPUT ASESOR DEL PROSPECTO --}}
                        <div class="col-12 mt-2">
                            <label for="">ASESOR DEL PROSPECTO</label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        {{-- INPUT OPCIONES CANCELACIÓN --}}
                        <div class="col-12 mt-2">
                            <label for="">OPCIONES DE CANCELACIÓN</label>
                            <select name="opcionCancelacion" class="form-control">
                                <option value="x1">x1</option>
                                <option value="x2">x2</option>
                                <option value="x3">x3</option>
                                <option value="x4">x4</option>
                            </select>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>