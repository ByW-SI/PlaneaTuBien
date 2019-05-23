<div class="modal fade" id="crearFactorActualizacion" tabindex="-1" role="dialog" aria-labelledby="FactorActualizacionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="FactorActualizacionLabel">Nuevo Factor de actualización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('factors.store') }}" method="POST">
	      <div class="modal-body">
	        @csrf
	        <div class="row">
	        	<div class="col-6 offset-3">
	        		<label for="porcentaje">Porcentaje de actualización</label>
	        		<div class="input-group mb-3">
				  		<input type="number" name="porcentaje" id="porcentaje" class="form-control" min="1" max="100" placeholder="Porcentaje" aria-label="Porcentaje" aria-describedby="porcentaje-addon" required="">
				  		<div class="input-group-append">
					    	<span class="input-group-text" id="porcentaje-addon">%</span>
					  	</div>
					</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
	      </div>
      </form>
    </div>
  </div>
</div>