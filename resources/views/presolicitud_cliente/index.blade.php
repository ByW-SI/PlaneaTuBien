@extends('principal')

@section('content')


<!-- Modal -->
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
                        <label for="exampleFormControlSelect1">Example select</label>
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
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 form-group">
                        <label for="desde">Fecha siguiente:</label>
                        <input class="form-control" type="date" name="fecha_sig" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>

    </form>
</div>


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
                                        {{\Carbon\Carbon::parse($presolicitud->fecha_gestion)->format('d/m/Y')}}
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
                        </div>
                        <div class="col-sm">

                        </div>
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
                                    <th>Fecha siguiente</th>
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
                    }
                }
            });
        });
    });
    function Pestalla(id) {
        //document.getElementById('Contrato').style.display = 'block';
        $('#Contrato').show();
        $('#HistorialGestionTablevisible').hide();
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
                $('#plazo_contrato').text(res.Presolicitud.plazo_contratado);
                $('#cuotasPagar_contrato').text(res.Presolicitud.plazo_contratado);
                $('.HistorialGestion').val(res.Contrato.id);
                UsuarioBusqueda(res.Presolicitud.id,res.Contrato.id);

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


    </script>
@endpush