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
                        <a class="nav-link" href="{{ route('prospectos.documentos.index', ['prospecto' => $prospecto]) }}">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('prospectos.prestamos.index', ['prospecto' => $prospecto]) }}">Préstamos</a>
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
                        <h5>Préstamos:</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.prestamos.create', ['prospecto' => $prospecto]) }}" class="btn btn-success">
                            <i class="fa fa-plus"></i><strong> Agregar Préstamo</strong>
                        </a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('prospectos.prestamos.index', ['prospecto' => $prospecto]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Préstamos</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="control-label">Préstamo:</label>
                        <input type="text" class="form-control" value="${{ number_format($prestamo->prestamo, 2) }}" readonly="">
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="control-label">Meses:</label>
                        <input type="text" class="form-control" value="{{ $prestamo->meses }} meses" readonly="">
                    </div>
                </div>
                <table class="table table-sm table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                    <tr class="info">
                        <th>Mes</th>
                        <th>Pago inicial</th>
                        <th>Mensualidad</th>
                    </tr>
                    @for($i = 1; $i <= $prestamo->meses; $i++)
                        <tr>
                            <td>Mes {{ $i }}</td>
                            <td>{{ $i > 1 ? '-' : '$' . number_format($prestamo->prestamo * 0.1, 2) }}</td>
                            <td>${{ number_format($prestamo->prestamo / $prestamo->meses, 2) }}</td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="2" class="text-right">Total:</td>
                        <td>${{ number_format($prestamo->prestamo * 1.1, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection