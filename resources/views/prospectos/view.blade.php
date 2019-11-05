@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            @foreach(Auth::user()->perfil->componentes as $componente)
            @if ($componente->nombre == "editar prospecto")
                <div class="col-sm-3 text-center">
                    <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                        <strong>✎ Editar Prospecto</strong>
                    </a>
                </div>
            @endif
            {{-- <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div> --}}
            @if ($componente->nombre == "indice prospectos")
                <div class="col-sm-3 text-center">
                    <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                        <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                    </a>
                </div>
            @endif
            @endforeach
            <div class="col-sm-3 text-center">
                <a href="{{ route('empleados.prospectos.cotizacions.create', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Cotización</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('prospectos.info')
    </div>
</div>

@endsection