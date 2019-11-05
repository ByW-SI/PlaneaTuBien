<div class="row">
    <div class="form-group col-sm-4">
        <label>Nombre:</label>
        <dd class="form-control" readonly="">{{ $prospecto->nombre }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Apellido Paterno:</label>
        <dd class="form-control" readonly="">{{ $prospecto->appaterno }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Apellido Materno:</label>
        <dd class="form-control" readonly="">{{ $prospecto->apmaterno ? $prospecto->apmaterno : 'N/A' }}</dd>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-4">
        <label>Sexo:</label>
        <dd class="form-control" readonly="">{{ $prospecto->sexo ? $prospecto->sexo : 'N/A' }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Email:</label>
        <dd class="form-control" readonly="">{{ $prospecto->email }}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label>Teléfono Móvil:</label>
        <dd class="form-control" readonly="">{{ $prospecto->movil ? $prospecto->movil : 'N/A' }}</dd>
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
        <dd class="form-control" readonly="">{{number_format($prospecto->monto, 2)}}</dd>
    </div>
    <div class="form-group col-sm-4">
        <label for="plan">Plan:</label>
        <dd class="form-control" readonly="">{{$prospecto->plan}}</dd>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-sm-12">
        <h4 class="title form-group">
            Asesor a cargo
        </h4>
    </div>
    <div class="form-group offset-sm-3 col-sm-4">
        <label>Asesor:</label>
        <dd class="form-control" readonly="">{{ $prospecto->asesor ? $prospecto->asesor->nombre . ' ' . $prospecto->asesor->paterno : 'No hay asesor asignado' }}</dd>
        
    </div>
    <div class="form-group col-sm-4">
        <label>Fecha de asignación:</label>
        <dd class="form-control" readonly="">{{ $prospecto->fecha_asignado ? $prospecto->fecha_asignado : 'No hay fecha asignada' }}</dd>
    </div>
    <div class="form-group col-sm-12 d-flex justify-content-center">
        <a href="{{ route('prospectos.asesor.create',['prospecto'=>$prospecto]) }}" class="btn m-3 btn-success"><i class="fas fa-user-tie"></i> Asignar asesor</a>
    </div>
</div>