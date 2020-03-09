<!-- Modal -->
<div class="modal fade" id="medioContactoCreateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('medios_contacto.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-uppercase text-muted" id="exampleModalLabel">Crear medio de comunicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="" class="text-uppercase text-muted">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="" class="text-uppercase text-muted">Descripción</label>
                            <textarea name="descripcion" id="" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success b-0">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>