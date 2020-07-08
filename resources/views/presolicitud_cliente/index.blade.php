@extends('principal')

@section('content')

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<script src="{{ asset('js/plugins/piexif.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/sortable.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/fileinput.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/locales/fr.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/locales/es.js')}}" type="text/javascript"></script>

<!-- Modal Crear Gestion-->
<div class="modal fade" id="crearGestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="crear_Gestion_id"  action="{{url('gestion.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Gestion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input id="contrato_id" name="contrato_id" type="hidden" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Gestion</label>
                        <select class="form-control" id="gestion" name="gestion">
                            <option>NC</option>
                            <option>PP</option>
                            <option>PI</option>
                            <option>MJT</option>
                            <option>BZ</option>
                            <option>MR1</option>
                            <option>MR2</option>
                            <option>MR3</option>
                            <option>ACL</option>
                            <option>ACP</option>
                            <option>IL</option>
                            <option>CC</option>
                            <option>CIT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desde">Fecha siguiente:</label>
                        <input class="form-control" type="date" name="fecha_sig" value="">
                    </div>
                    <div class="form-group">
                        <label for="desde">Comentarios:</label>
                        <input class="form-control" type="text" name="comentario" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>

    </form>
</div>
<!--fin del modal-->
<!-- Modal ver Mas-->
<div class="modal fade" id="verVoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="ver_voucher_id"  action=" {{route('pagovoucher')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input id="pago_id" name="pago_id" type="hidden" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Cargar Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" text-center">
                        <label class="control-label" for="">Voucher</label>
                        <input id="input-id2" type="file" accept=".jpg, .jpeg, .png" class="file" name="voucher"  data-preview-file-type="text" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cargar</button>
                </div>
            </div>
        </div>

    </form>
</div>
<!--fin del modal-->


<!-- Modal Edicion de datos--> 
<div class="modal fade" id="edicionDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="edicion_datos_id"  action="{{url('edicionDatos.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edicion de datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input id="id_Pre" name="id_Pre" type="hidden" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="desde">Teléfono de casa:</label>
                        <input class="form-control" type="number" name="tel_casa" id="tel_casa" value="">
                    </div>
                    <div class="form-group">
                        <label for="desde">Teléfono de oficina:</label>
                        <input class="form-control" type="number" name="tel_oficina" id="tel_oficina" value="">
                    </div>
                    <div class="form-group">
                        <label for="desde">Teléfono de celular:</label>
                        <input class="form-control" type="number" name="tel_celular" id="tel_celular" value="">
                    </div>
                    <div class="form-group">
                        <label for="desde">Email:</label>
                        <input class="form-control" type="text" name="email" id="email" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>

    </form>
</div>
<!--fin del modal-->
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
                                <th>Identificador</th>
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
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($presolicitudes as $presolicitud)
                                
                                <tr>
                                    <td>{{$presolicitud->id}}</td>
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
                                        @if($presolicitud->fecha_gestion!=0)
                                            {{\Carbon\Carbon::parse($presolicitud->fecha_gestion)->format('d/m/Y')}}
                                        @endif
                                    </td>

                                    <td>
                                        {{-- BOTÓN MODIFICAR PLAN --}}
                                        <div class="d-flex justify-content-center">
                                            <a 
                                            onclick="DetallesPresolicitud({{$presolicitud->id}})" 
                                            class="btn btn-primary">Detalles</a>
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
                <br>
                <div class="row-group">
                    <div class="table-responsive">
                        <table class="table table-striped" id="UsuarioTable" >
                            <thead>
                                <tr class="thead-dark">
                                    <th>Cliente</th>
                                    <th>Meses vencidos</th>
                                    <th>Importe total</th>
                                    <th>Tel casa</th>
                                    <th>Oficina</th>
                                    <th>Celular</th>
                                    <th>Referencia 1</th>
                                    <th>Referencia 2</th>
                                    <th>Referencia 3</th>
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
                            <div class="row">
                                <div class="col-sm">
                                    Ultimagestion:
                                    <span class="input-group-text" id="Dia_ultima_gestion">_</span>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary HistorialGestion">Historial</a>
                                    </div>

                                </div>
                                <div class="col-sm">
                                    Dia sig gestion:<span class="input-group-text" id="Dia_sig_gestion">0</span><br>
                                    <button id="crearGestionBTN" type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearGestion">
                                      Crear Gestion
                                    </button>
                                </div>
                            </div>
                            <br><br><br><br><br>
                            <div class="row">
                                Terminos del plan
                                <table class="table table-striped" id="ApexTable" >
                                    <thead>
                                        <tr class="thead-dark">
                                            <th></th>
                                            <th>%</th>
                                            <th>Mes</th>
                                            <th>Pagado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm">
                            <br><br>
                            <div class="d-flex justify-content-center">
                                <button id="HistorialPagos" type="button" class="btn btn-primary">
                                    Historial de Pagos
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="BTNedicionDatos" type="button" class="btn btn-primary" data-toggle="modal" data-target="#edicionDatos">
                                    Edicion de datos
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="Corrida" type="button" class="btn btn-primary">
                                    Ver Corrida
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="" type="button" class="btn btn-primary">
                                    Estado de cuenta
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="" type="button" class="btn btn-primary">
                                    Link de pago
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="" type="button" class="btn btn-primary">
                                    Formato adjudicatario
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="" type="button" class="btn btn-primary">
                                    Reestructura
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="" type="button" class="btn btn-primary">
                                    Formato cancelacion
                                </button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button id="" type="button" class="btn btn-primary">
                                    Formato rescindido
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-group" id="HistorialPagosTablevisible">
                    <h5 class="text-center text-uppercase text-muted">
                        Historial de Pagos
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped" id="HistorialPagosTable" >
                            <thead>
                                <tr class="thead-dark">
                                    <th>Folio</th>
                                    <th>Fecha de pago</th>
                                    <th>Status</th>
                                    <th>Tipo de pago</th>
                                    <th>Referencia</th>
                                    <th>Monto</th>
                                    <th>Voucher Registrado</th>
                                    <th>Cargar Voucher</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row-group" id="HistorialGestionTablevisible">
                    <h5 class="text-center text-uppercase text-muted">
                        Historial de Gestiones
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped" id="HistorialGestionTable" >
                            <thead>
                                <tr class="thead-dark">
                                    <th>gestion</th>
                                    <th>Fecha de creación</th>
                                    <th>Comentario</th>
                                    <th>Fecha siguiente</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row-group" id="CorridaTablevisible">
                    <h5 class="text-center text-uppercase text-muted">
                        Corridas
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped" id="CorridaTable" >
                            <thead>
                                <tr class="thead-dark">
                                    <th>#mes</th>
                                    <th>N° mes</th>
                                    <th>Aportacion</th>
                                    <th>Cuota</th>
                                    <th>Seguro de vida</th>
                                    <th>Seguro de daños</th>
                                    <th>Total sin SD</th>

                                    <th>Total</th>
                                    <th>Pago acumulado</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                    <h5 class="text-center text-uppercase text-muted">
                        Mensualidad
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped" id="MensualidadTable" >
                            <thead>
                                <tr class="thead-dark">
                                    <th>#mes</th>
                                    <th>N° mes</th>
                                    <th>Pago</th>
                                    <th>Complemento</th>
                                    <th>Estatus</th>

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
</div>
@endsection
@push('scripts')
    <script type="text/javascript">

    $(document).ready(function () {
        $('#Contrato').hide();
        $('#HistorialDePago').hide();
        $('#HistorialGestionTablevisible').hide();
        $('#HistorialPagosTablevisible').hide();
        $('#CorridaTablevisible').hide();
        
        
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
    $(document).ready(function(){
        

        

        $("#crearGestionBTN").click(function(){
            $("#contrato_id").val($('.HistorialGestion').val());
            
        });

        $("#Corrida").click(function(){
            $('#CorridaTablevisible').show();
            $("#CorridaTable").dataTable().fnDestroy();
            //console.log($(this).val());
            $('#CorridaTable').DataTable({
                "ajax":{
                    type: "POST",
                    url:"/get_corrida",
                    data: {"_token": $("meta[name='csrf-token']").attr("content"),
                           "contrato" : $('.HistorialGestion').val()
                    }
                },
                "searching": false,
                pageLength : 25,
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
                    },
                    "autoWidth": true
                }
            });
            $("#MensualidadTable").dataTable().fnDestroy();
            //console.log($(this).val());
            $('#MensualidadTable').DataTable({
                "ajax":{
                    type: "POST",
                    url:"/get_mensualidad",
                    data: {"_token": $("meta[name='csrf-token']").attr("content"),
                           "contrato" : $('.HistorialGestion').val()
                    }
                },
                "searching": false,
                pageLength : 25,
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
                    },
                    "autoWidth": true
                }
            });


            //$("#HistorialGestionTable").dataTable().columns().adjust().draw();
        });


        $(".HistorialGestion").click(function(){
            $('#HistorialGestionTablevisible').show();
            $("#HistorialGestionTable").dataTable().fnDestroy();
            //console.log($(this).val());
            $('#HistorialGestionTable').DataTable({
                "ajax":{
                    type: "POST",
                    url:"/get_gestion",
                    data: {"_token": $("meta[name='csrf-token']").attr("content"),
                           "id" : $(this).val()
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
                    },
                    "autoWidth": true
                }
            });
            //$("#HistorialGestionTable").dataTable().columns().adjust().draw();
        });
        $("#HistorialPagos").click(function(){
            $('#HistorialPagosTablevisible').show();
            $("#HistorialPagosTable").dataTable().fnDestroy();
            //console.log($(this).val());
            $('#HistorialPagosTable').DataTable({
                "ajax":{
                    type: "POST",
                    url:"/get_Historial",
                    data: {"_token": $("meta[name='csrf-token']").attr("content"),
                           "id" : $('.HistorialGestion').val()
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
        });
        
    });
    function Pestalla(id) {
        //document.getElementById('Contrato').style.display = 'block';
        $('#Contrato').show();
        $('#HistorialGestionTablevisible').hide();
        $('#HistorialPagosTablevisible').hide();
        $('#CorridaTablevisible').hide();
        $('.SelectNav').removeClass("active");
        $('#n'+id).addClass("active");
        $('#HistorialPagos').val(id);
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
                $('#plazo_contrato').text(res.Presolicitud.plazo_contratado);
                $('#cuotasPagar_contrato').text(res.Presolicitud.plazo_contratado);
                $('.HistorialGestion').val(res.Contrato.id);
                $('#Dia_ultima_gestion').text(res.UltimaGfecha);
                $('#Dia_sig_gestion').text(res.UltimaGSig);

                $('#tel_casa').val(res.Presolicitud.tel_casa);
                $('#tel_oficina').val(res.Presolicitud.tel_oficina);
                $('#tel_celular').val(res.Presolicitud.tel_celular);
                $('#email').val(res.Presolicitud.email);
                $("#id_Pre").val(res.Presolicitud.id);
                UsuarioBusqueda(res.Presolicitud.id,res.Contrato.id);
                $("#ApexTable").dataTable().fnDestroy();
            //console.log($(this).val());
                $('#ApexTable').DataTable({
                    "ajax":{
                        type: "POST",
                        url:"/get_apex",
                        data: {"_token": $("meta[name='csrf-token']").attr("content"),
                               "id" : res.Contrato.id
                        }
                    },
                    "searching": false,
                    pageLength : 4,
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
                $('#HistorialGestionTablevisible').hide();
                $('#HistorialPagosTablevisible').hide();
                $('#CorridaTablevisible').hide();
                //document.getElementById('HistorialDePago').style.display = 'block';

            }
        });

    }
    function UsuarioBusqueda(idP,idD) {        
        $("#UsuarioTable").dataTable().fnDestroy();
        //console.log($(this).val());
        $('#UsuarioTable').DataTable({
            "ajax":{
                type: "POST",
                url:"/get_prepagos",
                data: {"_token": $("meta[name='csrf-token']").attr("content"),
                       "idP" : idP,
                       "idD" : idD
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
    function Accion_verVoucherBTN(id) {
        // body...
        $("#pago_id").val(id);
        console.log("Entra");
        console.log(id);
        $('#verVoucher').modal('show');
    }

    $("#input-id2").fileinput({
            theme: 'fas',
            showUpload: true,
            showCaption: true,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: true,
            initialPreviewAsData: true
        });
    </script>
@endpush