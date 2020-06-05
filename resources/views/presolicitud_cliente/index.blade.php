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
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            Corte al:<span class="input-group-text" id="fecha_corte">$</span>

                        </div>
                        <div class="col-sm">

                        </div>
                        <div class="col-sm">

                        </div>
                    </div>
                </div>

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
                            Número de grupo:<span class="input-group-text" id="grupo_contrato">0</span><br>
                            Fecha de contrato:<span class="input-group-text" id="fecha_contrato">0</span><br>
                            Valor inicial:<span class="input-group-text" id="valorI_contrato">0</span><br>
                            Valor presente:<span class="input-group-text" id="valorP_contrato">0</span><br>
                            Valor a adjudicar:<span class="input-group-text" id="valorA_contrato">0</span><br>
                            Plazo contratado:<span class="input-group-text" id="plazo_contrato">0</span><br>
                            <br><br><br>
                            Cuotas pagadas:<span class="input-group-text" id="cuotasP_contrato">0</span><br><br>
                            Cuotas por pagar:<span class="input-group-text" id="cuotasPagar_contrato">0</span><br><br>
                            Puntos acumulados:<span class="input-group-text" id="puntos_contrato">0</span><br><br>
                            Participantes adjudicados:<span class="input-group-text" id="participantes_contrato">0</span><br><br>
                            
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


    });
    function Pestalla(id) {
        //document.getElementById('Contrato').style.display = 'block';
        $('#Contrato').show();
        $('.SelectNav').removeClass("active");
        $('#n'+id).addClass("active");
        $.ajax({
            url:"/get_contrato",
            type:'POST',
            data: {"_token": $("meta[name='csrf-token']").attr("content"),
                    "id" : id
                },
            dataType: "json",
            success: function(res){
                let date = new Date();
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();
                $('#fecha_corte').text(day+"/"+month+"/"+year);
                $('#fecha_contrato').text(res.Creacion);
                $('#grupo_contrato').text(res.Contrato.grupo_id);
                $('#valorI_contrato').text(res.Contrato.monto);
                $('#valorP_contrato').text(res.Contrato.monto);
                //$('#valorA_contrato').text(res.Contrato.monto);
                //$('#plazo_contrato').text(res.Contrato.monto);


                //document.getElementById('HistorialDePago').style.display = 'block';
            }
        });

        
        
        // body...
    }
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