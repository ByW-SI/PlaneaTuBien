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
                                <th>Prospecto</th>
                                <th>Plan</th>
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
                                <td>{{$presolicitud->id}}</td>
                                <td></td>
                                <td>
                                    {{-- BOTÓN MODIFICAR PLAN --}}
                                    <div class="d-flex justify-content-center">
                                        <a 
                                        href="" 
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

@endsection