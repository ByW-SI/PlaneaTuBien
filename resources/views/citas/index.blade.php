@extends('principal')

@section('content')

<div class="container">

    <h3 class="text-center text-uppercase text-muted mt-4"> SEGUIMIENTO DE CITAS/PENDIENTES</h3>

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
                                @include('citas.modals.edit', ['cita' => $cita])
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

    // $(document).on('change', '.inputAccion', function(){

    //     const accion = $(this).val();
    //     const prospectoId = $(this).attr('prospectoId');
    //     console.log(accion);

    //     if(accion == 'reagendar cita'){
    //         mostrarInputsReagendarCita(prospectoId);
    //     }

    //     if(accion == 'llamar para reagendar'){
    //         mostrarInputsLlamarParaReagendar(prospectoId);
    //     }

    //     if(accion == 'cancelar cita'){
    //         mostrarInputsCancelarCita(prospectoId);
    //     }

    // });

/**
* =========
* FUNCTIONS
* =========
*/

// function mostrarInputsReagendarCita(prospectoId){
//     $(`.inputsExtra[prospectoId=${prospectoId}]`).html(`
//         <label>Nueva fecha de cita</label>
//         <input name="nuevaFechaCita" class="form-control" type="date">
//     `);
// }

// function mostrarInputsLlamarParaReagendar(prospectoId){
//     $(`.inputsExtra[prospectoId=${prospectoId}]`).html(`
//         <label>Nueva fecha de llamada</label>
//         <input name="nuevaFechaLlamada" class="form-control" type="date">
//     `);
// }

// function mostrarInputsCancelarCita(prospectoId){
//     $(`.inputsExtra[prospectoId=${prospectoId}]`).html(`
//         <label>comentarios</label>
//         <textarea name="comentarios" class="form-control" type="date"></textarea>
//         <label>Asesor que confirma</label>
//         <select type="text" name="idAsesorQueConfirma" class="form-control">
//             <option value="1">Asesor</option>
//         </select>
//         <label>Asesor del prospecto</label>
//         <input type="text" name="asesorProspecto" class="form-control">
//         <label>Opción de cancelación</label>
//         <input type="text" name="opcionCancelacion" class="form-control">
//     `);
// }

</script>

@endsection