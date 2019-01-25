<div class="row">
    <div class="form-group col-sm-3">
        <label>Nombre:</label>
        <dd>{{ $prospecto->nombre }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Apellido Paterno:</label>
        <dd>{{ $prospecto->appaterno }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Apellido Materno:</label>
        <dd>{{ $prospecto->apmaterno ? $prospecto->apmaterno : 'N/A' }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Sexo:</label>
        <dd>{{ $prospecto->sexo }}</dd>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label>RFC:</label>
        <dd>{{ $prospecto->rfc }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Email:</label>
        <dd>{{ $prospecto->email }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Teléfono:</label>
        <dd>{{ $prospecto->telefono }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Teléfono Móvil:</label>
        <dd>{{ $prospecto->movil }}</dd>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-sm-3">
        <label>Asesor:</label>
        <dd>{{ $prospecto->asesor->nombre }} {{ $prospecto->asesor->paterno }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Ingreso Mensual:</label>
        <dd>${{ number_format($prospecto->ingreso, 2) }}</dd>
    </div>
    <div class="form-group col-sm-3">
        <label>Gasto Mensual:</label>
        <dd>${{ number_format($prospecto->gasto, 2) }}</dd>
    </div>
</div>