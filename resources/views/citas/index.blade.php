@extends('principal')

@section('content')

<div class="container">

    <h3 class="text-center text-uppercase text-muted mt-4">SEGUIMIENTO DE CITAS</h3>

    <div class="row">
        {{-- CONTENEDOR FILTRO DE FECHA --}}
        @csrf
        <div class="col-12 col-md-6">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="text-center text-uppercase text-muted m-0">FILTRO POR FECHA DE CITA</h5>
                </div>
                <form action="{{route('citas.index')}}" method="GET">
                    <div class="card-body">
                        <div class="row">
                            {{-- CONTENEDOR INPUT FECHA INICIO --}}
                            <div class="col-6 my-1">
                                <label for="" class="text-uppercase text-muted">FECHA INICIO</label>
                                <input type="date" class="form-control" name="fechaCitaInicio" value="{{request()->input('fechaCitaInicio')}}">
                            </div>
                            {{-- CONTENEDOR INPUT FECHA FIN --}}
                            <div class="col-6 my-1">
                                <label for="" class="text-uppercase text-muted">FECHA FIN</label>
                                <input type="date" class="form-control" name="fechaCitaFin" value="{{request()->input('fechaCitaFin')}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success btn-sm rounded-0">BUSCAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- CONTENEDOR TABLA DE CITAS --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="citas">
                            <thead>
                                <tr class="text-center">
                                    <th>Status</th>
                                    <th>Prospecto</th>
                                    <th>Clave de preautorizacion</th>
                                    <th>Asesor</th>
                                    <th>Fecha cita</th>
                                    <th>Hora</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                <tr>
                                    <td>{{$cita->prospecto->estatus()->first()->nombre}}</td>
                                    <td>{{$cita->prospecto->nombre}} {{$cita->prospecto->appaterno}}
                                        {{$cita->prospecto->apmaterno}}</td>
                                    <td>{{$cita->clave_preautorizacion}}</td>
                                    <td>{{$cita->prospecto->asesor()->first()->nombre}}
                                        {{$cita->prospecto->asesor()->first()->paterno}}
                                        {{$cita->prospecto->asesor->first()->materno}}</td>
                                    <td>{{$cita->fecha_cita}}</td>
                                    <td>{{$cita->hora}}</td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-primary">VER</a> --}}
                                        @include('citas.modals.edit', ['cita' => $cita, 'asesores'=>$asesores])
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target=".modalCitas-{{$cita->prospecto->id}}">
                                            Ver
                                        </button>
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


</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    /**
* ======
* EVENTS
* ======
*/

    $(document).ready( function(){
        var table = $('#citas').DataTable();
        } );

    $(document).on('change', '.inputAccion', function(){

        const accion = $(this).val();
        const prospectoId = $(this).attr('prospectoId');

        ocultarInputsExtra();

        if(accion == 'reagendar cita'){
            mostrarInputsReagendarCita(prospectoId);
        }

        if(accion == 'llamar para reagendar'){
            mostrarInputsLlamarParaReagendar(prospectoId);
        }

        if(accion == 'cancelar cita'){
            mostrarInputsCancelarCita(prospectoId);
        }

    });

/**
* =========
* FUNCTIONS
* =========
*/

function ocultarInputsExtra(){
    $(`.contenedorInputExtra`).each( function(){
        $(this).hide();
    } );
}

function mostrarInputsReagendarCita(prospectoId){
    $(`.contenedorInputNuevaFechaCita[prospectoId=${prospectoId}]`).show();
    $(`.contenedorInputNuevaHoraCita[prospectoId=${prospectoId}]`).show();
}

function mostrarInputsLlamarParaReagendar(prospectoId){
    $(`.contenedorInputNuevaFechaLlamada[prospectoId=${prospectoId}]`).show();
}

function mostrarInputsLlamarParaReagendar(prospectoId){
    $(`.contenedorInputNuevaFechaLlamada[prospectoId=${prospectoId}]`).show();
}

function mostrarInputsCancelarCita(prospectoId){
    $(`.contenedorInputComentario[prospectoId=${prospectoId}]`).show();
    $(`.contenedorInputAsesorQueConfirma[prospectoId=${prospectoId}]`).show();
    $(`.contenedorInputAsesorDelProspecto[prospectoId=${prospectoId}]`).show();
    $(`.contenedorInputOpcionesCancelacion[prospectoId=${prospectoId}]`).show();
}

</script>

@endsection