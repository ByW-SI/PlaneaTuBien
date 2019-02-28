@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.show',['prospecto'=>$prospecto]) }}" class="btn btn-primary">
                    <strong> Regresar</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
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
        <form action="{{ route('prospectos.update',['prospecto'=>$prospecto]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-sm-12">
                    <h4 class="title form-group">
                        Asesor a cargo
                    </h4>
                </div>
                <div class="form-group col-sm-4">
                    <label>Asesor:</label>
                    <select name="empleado_id" class="form-control" required>
                        <option value="">Seleccione un asesor</option>
                        @foreach ($asesores as $asesor)
                            <option value="{{$asesor->id}}">{{$asesor->nombre." ".$asesor->paterno." ".$asesor->materno}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label>Fecha de asignación:</label>
                    <input type="date" class="form-control" name="fecha_asignado" value="{{date('Y-m-d')}}"  readonly="">
                </div>
                <div class="form-group col-sm-4 d-flex justify-content-center ">
                    <input class="btn btn-primary mt-4" type="submit" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection