@extends('principal')
@section('content')

<div class="card">
    <div class="card-header">
        <h1>Historial de Pagos de inscripción</h1>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Inscripción:</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($pagos) > 0)
                    <table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                        <tr class="info">
                            <th>Fecha del pago</th>
                            <th>Folio de la cotización</th>
                            <th>Inscripción</th>
                            <th>Prospecto</th>
                            <th>Asesor</th>
                            <th>Cantidad pagada</th>
                            <th>Forma de pago</th>
                            <th>Restante</th>
                            <th>Acción</th>
                        </tr>
                        @foreach($pagos as $pago)
                            <tr>
                                <td>{{ date('d/m/Y H:m:s', strtotime($pago->created_at)) }}</td>
                                <td>
                                    {{$pago->referencia}}
                                </td>
                                <td>${{ number_format($pago->cotizacion->inscripcion_total, 2) }}</td>
                                <td>{{ $pago->prospecto->nombre." ".$pago->prospecto->appaterno." ".$pago->prospecto->apmaterno }}</td>
                                <td>{{ $pago->prospecto->asesor->nombre." ".$pago->prospecto->asesor->paterno." ".$pago->prospecto->asesor->materno }}</td>
                                <td>${{ number_format($pago->total, 2) }}</td>
                                <td>{{ $pago->forma }}</td>
                                <td>
                                    @if ($pago->cotizacion->inscripcionFaltante() >= 0)
                                        Falta ${{number_format($pago->cotizacion->inscripcionFaltante(),2)}}
                                    @else
                                        Saldo a favor ${{number_format($pago->cotizacion->inscripcionFaltante()*-1,2)}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    
                                        @if ($pago->status == "registrado" )

                                            <form method="POST" id="estatus{{$pago->id}}" class="{{$pago->status != 'registrado' ? 'd-none' : ''}}"  action="{{ route('prospectos.cotizacions.pagos.update_status',['prospecto'=>$pago->prospecto,'cotizacion'=>$pago->cotizacion,'pago'=>$pago]) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-control mt-2" id="selectStatus{{$pago->id}}" onchange="cambiarstatus({{$pago->id}})">
                                                    <option value="registrado" {{$pago->status == "registrado" ? 'selected=""' : ''}} >Registrado</option>
                                                    <option value="aprobado" {{$pago->status == "aprobado" ? 'selected=""' : ''}} >Aprobado</option>
                                                    <option value="rechazado" {{$pago->status == "rechazado" ? 'selected=""' : ''}} >Rechazado</option>
                                                </select>
                                            </form>
                                        @else
                                            <label for="">{{ strtoupper($pago->status) }}</label>
                                        @endif
                                        <a href="{{ route('pagos.show',['pago'=>$pago]) }}" class="btn btn-sm mt-2 btn-info">Ver pago</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4>No hay pagos disponibles.</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script type="text/javascript">
        function cambiarstatus(id) {
            swal({
              title: "¿Desea cambiar este status?",
              text: "Una vez cambiado, ya no podrás actualizarlo",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Eliminando", {
                  icon: "info",
                });
                $("#estatus"+id).submit();

              } else {
                swal("¡Cancelado!");
                $("#selectStatus"+id).val('registrado');
              }
            });
        }
    </script>
@endpush