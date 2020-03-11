<div class="col-12 mt-3">
    <h4 class="text-uppercase text-muted">Estudio socioeconómico</h4>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- CONTENEDOR SUELDO MENSUAL DEL PROSPECTO --}}
                <div class="col-12 col-md-3 mt-2">
                    <label class="text-uppercase text-muted" for="sueldo">Sueldo mensual del prospecto:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input class="form-control" readonly="" type="text"
                            value="{{number_format($prospecto->sueldo,2)}}">
                    </div>
                </div>
                {{-- CONTENEDOR AHORRO NETO DEL PROSPECTO --}}
                <div class="col-12 col-md-3 mt-2">
                    <label class="text-uppercase text-muted" for="ahorro">Ahorro neto del prospecto:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input class="form-control" readonly="" type="text"
                            value="{{number_format($prospecto->ahorro,2)}}">
                    </div>
                </div>
                {{-- CONTENEDOR CALIFICACIÓN DEL PROSPECTO --}}
                <div class="col-12 col-md-3 mt-2">
                    <label class="text-uppercase text-muted" for="calificacion">Calificación del prospecto:</label>
                    <input class="form-control" readonly="" type="text" value="{{$prospecto->calificacion}}">
                </div>
                {{-- CONTENEDOR ESTADO DEL PROSPECTO --}}
                <div class="col-12 col-md-3 mt-2">
                    <label class="text-uppercase text-muted" for="estado">Estado del prospecto:</label>
                    <input class="form-control" readonly="" type="text"
                        value="{{$prospecto->aprobado ? 'Aprobado' : 'No Aprobado'}}">
                </div>
            </div>
        </div>
    </div>
</div>