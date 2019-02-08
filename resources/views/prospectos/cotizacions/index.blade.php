@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.edit', ['prospecto' => $prospecto]) }}" class="btn btn-warning">
                    <strong>✎ Editar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i><strong> Agregar Prospecto</strong>
                </a>
            </div>
            <div class="col-sm-3 text-center">
                <a href="{{ route('prospectos.index') }}" class="btn btn-primary">
                    <i class="fa fa-bars"></i><strong> Lista de Prospectos</strong>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('prospectos.info')
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.cotizacions.index', ['prospecto' => $prospecto]) }}">Cotización</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prospectos.pagos.index', ['prospecto' => $prospecto]) }}">Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CRM</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Cotizaciones:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.cotizacions.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Cotización</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($prospecto->cotizaciones) > 0)
                    <table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                        <tr class="info">
                            <th>Valor de la propiedad</th>
                            <th>Plan</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                        @foreach($prospecto->cotizaciones as $cotizacion)
                            <tr>
                                <td>${{ number_format($cotizacion->propiedad, 2) }}</td>
                                <td>{{ $cotizacion->plan }}</td>
                                <td>${{ $cotizacion->total }}</td>
                                <td class="text-center">
                                    <a href="{{ route('prospectos.cotizacions.show', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('prospectos.cotizacions.pdf', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-file"></i> PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4>No hay préstamos disponibles.</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection