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
    <div class="form-group col-sm-12">
        <h4 class="title form-group">
            Información de prestamo
        </h4>
    </div>
    <div class="form-group col-sm-4">
        <label for="monto">Monto solicitado:</label>
        <dd>{{$prospecto->monto}}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label for="plan">Plan:</label>
        <dd>{{$prospecto->plan}}</dd>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-sm-12">
        <h4 class="title form-group">
            Asesor a cargo
        </h4>
    </div>
    <div class="form-group col-sm-4">
        <label>Asesor:</label>
        <dd>{{ $prospecto->asesor ? $prospecto->asesor->nombre . ' ' . $prospecto->asesor->paterno : 'No hay asesor asignado' }}</dd>
        @if (!$prospecto->asesor)
            <a href="{{ route('prospectos.asesor.create',['prospecto'=>$prospecto]) }}" class="btn btn-success"><i class="fas fa-user-tie"></i> Asignar asesor</a>
        @endif
    </div>
</div>