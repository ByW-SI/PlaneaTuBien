@extends('principal')

@section('content')

<div class="container">
    <h4 class="text-center text-uppercase text-muted">
        CLIENTES
    </h4>
    <div class="card">
        <div class="card-body">
            <div class="row-group">
                <div class="table-responsive">
                    <table class="table table-striped" id="crms">
                        <thead>
                            <tr class="thead-dark">
                                <th>Cliente</th>
                                <th>Plan</th>
                                <th>Contrato</th>
                                <th>Presolicitud</th>
                                <th>estatus de pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presolicitudes as $presolicitud)
                            <tr>
                                <td>{{$presolicitud->perfil->prospecto->nombre}}
                                    {{$presolicitud->perfil->prospecto->appaterno}}
                                    {{$presolicitud->perfil->prospecto->apmaterno}}</td>
                                <td>{{$presolicitud->perfil->cotizacion->plan->id}}</td>
                                <td>{{$presolicitud->contratos->first()->numero_contrato}}</td>
                                <td>{{$presolicitud->id}}</td>
                                <td>{{


                                    (is_null ($presolicitud->contratos->first()->mensualidades->last()->first()->pagos()->get()))
                                        ?"Sin pagos"
                                        :($presolicitud->precio_inicial/$presolicitud->cotizacion()->plan->plazo<=$presolicitud->contratos->first()->mensualidades->last()->first()->pagos()->aprobados()->whereMonth ('fecha_pago', '=', date ('m'))->sum('monto'))
                                            ?"Alcorriente con los pagos"
                                            :"Con Deuda de pagos"

                                    }}</td>
                                <td>
                                    {{-- BOTÓN MODIFICAR PLAN --}}
                                    <div class="d-flex justify-content-center">
                                        <a 
                                        onclick="document.getElementById('HistorialDePago').style.display = 'block';" 
                                        class="btn btn-primary">Historial de pago</a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container" id="HistorialDePago" style="display:none;">
    <h4 class="text-center text-uppercase text-muted">
        Historial de pago
    </h4>
    <div class="card">
        <div class="card-body">
            <div class="row-group">
                <div class="table-responsive">
                    <table class="table table-striped" >
                        <thead>
                            <tr class="thead-dark">
                                <th>Folio</th>
                                <th>Fecha de pago</th>
                                <th>Estatus de pago</th>
                                <th>Tipo de pago</th>
                                <th>Referencia</th>

                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection