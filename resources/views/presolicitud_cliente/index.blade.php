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
                                <th>Contratos</th>
                                <th>Meses vencidos</th>
                                <th>Importe total</th>
                                <th>Tel casa</th>
                                <th>Tel oficina</th>
                                <th>Celular</th>
                                <th>Estatus del cliente</th>
                                <th>Ultima gestion</th>
                                <th>Fecha de la ultima gestion</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presolicitudes as $presolicitud)
                                
                                <tr>
                                    <td>{{$presolicitud->perfil->prospecto->nombre}}
                                        {{$presolicitud->perfil->prospecto->appaterno}}
                                        {{$presolicitud->perfil->prospecto->apmaterno}}
                                    </td>
                                    <td>
                                        @foreach ($presolicitud->contratos as $contrato)
                                            {{$contrato->numero_contrato.","}}
                                        @endforeach
                                    </td>
                                    <td>
                                        11
                                    </td>
                                    <td>
                                        $25,000
                                    </td>
                                    <td>
                                        {{$presolicitud->tel_casa}}
                                    </td>
                                    <td>
                                        {{$presolicitud->tel_oficina}}
                                    </td>
                                    <td>
                                        {{$presolicitud->tel_celular}}
                                    </td>
                                    <td>
                                        Integrante
                                    </td>

                                    <td>
                                        {{$presolicitud->gestion}}
                                    </td>
                                    <td>
                                        {{$presolicitud->fecha_gestion}}
                                    </td>

                                    <td>
                                        {{-- BOTÓN MODIFICAR PLAN --}}
                                        <div class="d-flex justify-content-center">
                                            <a 
                                            onclick="DetallesPresolicitud({{$presolicitud->id}})" 
                                            class="btn btn-primary">Detalles del cliente</a>
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
<div class="container" id="HistorialDePago" >
    <div id="navContrato">
        
    </div>
    

    
    <div id="Contrato" >
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
                                    <th>Monto</th>

                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                        <div class="col-sm">

                        </div>
                        <div class="col-sm">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">

    $(document).ready(function () {
        $('#Contrato').hide();
        $('#HistorialDePago').hide();
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
        

        $(".SelectContrato").click(function(){
            //$(".SelectContrato").addClass("active");
            $('#Contrato').show();
            $(this).addClass("active");
        });

    });
    function DetallesPresolicitud(id) {
        $.ajax({
            url:"/navegacion_contrato",
            type:'POST',
            data: {"_token": $("meta[name='csrf-token']").attr("content"),
                    "id" : id
                },
            success: function(res){
                $('#navContrato2').remove();
                $('#navContrato').append(res);
                $('#HistorialDePago').show();
                $('#Contrato').hide();
                //document.getElementById('HistorialDePago').style.display = 'block';
            }
        });
    }
    function AgregarHistorial(id) {
        
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