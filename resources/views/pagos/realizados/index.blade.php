@extends('principal')
@section('content')

<div class="container">
    @if (session('status'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            </div>
        </div>
    @endif
    <div class="card mb-5">
        {{-- Titulo de la seccion --}}
        <div class="card-header"><h3><strong>Pagos realizados</strong></h3></div>
        <div class="card-body">
            {{-- Buscador de pagos --}}
            <form action="{{route('pagos.realizados')}}" method="POST">
                @csrf
                <div class="row">
                    {{-- Fecha de inicio --}}
                <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fechaInicio">De:</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fechaInicio" required>
                        </div>
                    </div>
                    {{-- Fecha final --}}
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fechaInicio">A:</label>
                            <input type="date" class="form-control" name="fecha_final" id="fechaFinal" required>
                        </div>
                    </div>
                    {{-- Botón para buscar --}}
                    <div class="col-12 col-md-4 mt-4">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
            <hr>
            {{-- Tabla de pagos --}}
            @if ($pagos)
                <table class="table table-bordered table-striped" id="corrida">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Referencia</th>
                            <th class="text-center" scope="col">Fecha</th>
                            <th class="text-center" scope="col">Cliente</th>
                            <th class="text-center" scope="col">Pago</th>
                            <th class="text-center" scope="col">Debio pagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr class="text-center">
                            <td>{{$pago->referencia}}</td>
                            <td>{{$pago->fecha_pago}}</td>
                            <td></td>
                            <td>{{$pago->monto}}</td>
                            <td>{{$pago->mensualidad()->first()->cantidad}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-3 text-center">
                        <strong>Total pagos</strong><br>
                        {{count($pagos)}}
                    </div>
                    <div class="col-12 col-md-3 text-center">
                        <strong>Total monto pagado</strong><br>
                        {{$total_monto_pagado}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection