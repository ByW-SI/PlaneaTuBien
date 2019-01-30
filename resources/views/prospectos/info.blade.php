<div class="row">
    <div class="form-group col-sm-4">
        <label>Nombre:</label>
        <dd>{{ $prospecto->nombre }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Apellido Paterno:</label>
        <dd>{{ $prospecto->appaterno }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Apellido Materno:</label>
        <dd>{{ $prospecto->apmaterno ? $prospecto->apmaterno : 'N/A' }}</dd>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4">
        <label>Sexo:</label>
        <dd>{{ $prospecto->sexo ? $prospecto->sexo : 'N/A' }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Email:</label>
        <dd>{{ $prospecto->email }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Teléfono Móvil:</label>
        <dd>{{ $prospecto->movil ? $prospecto->movil : 'N/A' }}</dd>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-sm-4">
        <label>Asesor:</label>
        <dd>{{ $prospecto->asesor ? $prospecto->asesor->nombre . ' ' . $prospecto->asesor->paterno : 'No disponible' }}</dd>
    </div>
</div>