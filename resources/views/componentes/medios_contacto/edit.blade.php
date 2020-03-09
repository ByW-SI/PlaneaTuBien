<!-- Modal -->
<div class="modal fade" id="medio-contacto-{{$medioDeContacto->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('medios_contacto.update',['id' => $medioDeContacto->id])}}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$medioDeContacto->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="" class="text-uppercase text-muted">NOMBRE</label>
                            <input type="text" name="nombre" value="{{$medioDeContacto->nombre}}" class="form-control" required>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="" class="text-uppercase text-muted">Descripción</label>
                            <textarea name="descripcion" id="" cols="30" rows="10" required class="form-control">{{$medioDeContacto->descripcion}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>