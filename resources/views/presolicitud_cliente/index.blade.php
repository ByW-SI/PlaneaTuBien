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
                    <table class="table table-striped" id="clientes">
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
                                @foreach ($presolicitud->contratos as $contrato)
                                <tr>
                                    <td>{{$presolicitud->perfil->prospecto->nombre}}
                                        {{$presolicitud->perfil->prospecto->appaterno}}
                                        {{$presolicitud->perfil->prospecto->apmaterno}}</td>
                                    <td>{{$presolicitud->perfil->cotizacion->plan->id}}</td>
                                    <td>{{$contrato->numero_contrato}}</td>
                                    <td>{{$presolicitud->id}}</td>
                                    <td>{{


                                        (is_null ($contrato->mensualidades->last()->first()->pagos()->get()))
                                            ?"Sin pagos"
                                            :($contrato->monto/$presolicitud->cotizacion()->plan->plazo<=$contrato->mensualidades->last()->first()->pagos()->aprobados()->whereMonth ('fecha_pago', '=', date ('m'))->sum('monto'))
                                                ?"Alcorriente con los pagos"
                                                :"Con Deuda de pagos"

                                        }}</td>
                                    <td>
                                        {{-- BOTÓN MODIFICAR PLAN --}}
                                        <div class="d-flex justify-content-center">
                                            <a 
                                            onclick="AgregarHistorial({{$contrato->id}})" 
                                            class="btn btn-primary">Historial de pago</a>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
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
                    <table class="table table-striped" id="HistorialDePagoTable" >
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
@push('scripts')
    <script type="text/javascript">

    $(document).ready(function () {
        $('#clientes').DataTable({
            pageLength : 5,
            'language':{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Productos _START_ al _END_ de un total de _TOTAL_ ",
                "sInfoEmpty":      "Productos 0 de un total de 0 ",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
    function AgregarHistorial(id) {
        document.getElementById('HistorialDePago').style.display = 'block';
        $("#HistorialDePagoTable").dataTable().fnDestroy();
                //console.log($(this).val());
                $('#HistorialDePagoTable').DataTable({
                    "ajax":{
                        type: "POST",
                        url:"/getHistorial",
                        data: {"_token": $("meta[name='csrf-token']").attr("content"),
                               "id" : id
                        }
                    },
                    "searching": false,
                    pageLength : 3,
                    'language':{
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Productos _START_ al _END_ de un total de _TOTAL_ ",
                        "sInfoEmpty":      "Productos 0 de un total de 0 ",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",

                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
            });
    }

    </script>
@endpush