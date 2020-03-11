<div class="col-12">
        <h4 class="text-uppercase text-muted">Datos generales del prospecto</h4>
    </div>
    <div class="col-12">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    {{-- CONTENEDOR NOMBRE --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Nombre:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->nombre }}" readonly="">
                    </div>
                    {{-- CONTENEDOR APELLIDO PATERNO --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Apellido Paterno:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->appaterno }}" readonly="">
                    </div>
                    {{-- CONTENEDOR APELLIDO PATERNO --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Apellido Materno:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->apmaterno }}" readonly="">
                    </div>
                    {{-- CONTENEDOR SEXO --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Sexo:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->sexo }}" readonly="">
                    </div>
                    {{-- CONTENEDOR CORREO --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Correo electrónico:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->email }}" readonly="">
                    </div>
                    {{-- CONTENEDOR TELEFONO --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Teléfono:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->tel }}" readonly="">
                    </div>
                    {{-- CONTENEDOR TELEFONO MOVIL --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Teléfono móvil:</label>
                        <input type="text" class="form-control" value="{{ $prospecto->movil }}" readonly="">
                    </div>
                    {{-- CONTENEDOR ASESOR --}}
                    <div class="col-12 col-md-3 mt-2">
                        <label class="text-uppercase text-muted">Asesor:</label>
                        <input type="text" class="form-control"
                            value="{{ $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno }}"
                            readonly="">
                    </div>
                </div>
            </div>
        </div>
    </div>