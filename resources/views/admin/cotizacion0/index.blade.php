@extends('principal')
@section('content')
	<div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h5>Cotizaciones sin pago inicial de inscripción:</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(count($cotizaciones) > 0)
                <table class="table table-stripped table-bordered table-hover" style="margin-bottom: 0px;">
                    <tr class="info">
                    	<th>Prospecto</th>
                        <th>Plan</th>
                        <th>Valor de la propiedad</th>
                        <th>Monto total a pagar</th>
                        <th>Costo anual total</th>
                        <th>Mensualidades</th>
                        <th>Inscripción inicial</th>
                        <th>Acción</th>
                    </tr>
                    @foreach($cotizaciones as $cotizacion)
                        <tr>
                            <td>{{ $cotizacion->prospecto->full_name }}</td>
                            <td>{{ $cotizacion->plan->nombre }}</td>
                            <td>${{ number_format($cotizacion->monto, 2) }}</td>
                            <td>${{ number_format($cotizacion->plan->monto_total_pagar($cotizacion->monto,$cotizacion->factor_actualizacion),2) }}</td>
                            <td>{{$cotizacion->plan->sobrecosto_anual($cotizacion->monto,$cotizacion->factor_actualizacion)}}%</td>
                            <td>{{$cotizacion->plan->mes_aportacion_adjudicado." meses de $".number_format($cotizacion->plan->cotizador($cotizacion->monto,$cotizacion->factor_actualizacion)['cuota_periodica_integrante'],2)}}</td>
                            <td>${{number_format($cotizacion->inscripcion_total,2)}}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('cotizacion0.show', ['cotizacion0' => $cotizacion]) }}" class="btn btn-sm mt-2 btn-primary">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>

                                    @if ($cotizacion->liberar == 0)
                                        {{-- expr --}}
                                        <form action="{{ route('cotizacion0.update',['cotizacion0'=>$cotizacion]) }}" method="POST">
        									@csrf
        									@method('PUT')
        									<button type="button" class="btn btn-sm btn-primary mt-2 swa-confirm"><i class="fas fa-check"></i> Autorizar</button>
        								</form>
                                        <form action="{{ route('cotizacion0.destroy',['cotizacion0'=>$cotizacion]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger mt-2 swa-delete"><i class="fas fa-times"></i> No Autorizar</button>
                                        </form>
                                    @else
                                        {{-- <div class="mt-2"> --}}
                                        <button type="button" class="btn btn-sm btn-info mt-2" disabled="">Autorizado</button>
                                        {{-- </div> --}}
                                    @endif
                                    
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h4>No hay cotizaciones disponibles.</h4>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
	<script>
		$(".swa-confirm").on("click", function(e) {
            e.preventDefault();
            swal({
              title: "¿Desea autorizar esta cotización?",
              text: "Una vez autorizado, esta no podrá ser cambiada.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              confirmButtonText: 'Autorizar',
            })
            .then((willDelete) => {
              if (willDelete) {
                $(this).closest('form').submit();
                swal("Se autorizo esta cotizacion", {
                  icon: "success",
                });
              } else {
                swal("No se autorizo esta cotización");
              }
            });
        });
        $(".swa-delete").on("click", function(e) {
            e.preventDefault();
            swal({
              title: "¿Desea no autorizar y eliminar esta cotización?",
              text: "Una vez no autorizada, la cotización será eliminada del sistema.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              confirmButtonText: 'No autorizar',
            })
            .then((willDelete) => {
              if (willDelete) {
                $(this).closest('form').submit();
                swal("Se autorizo esta cotizacion", {
                  icon: "success",
                });
              } else {
                swal("No se autorizo esta cotización");
              }
            });
        });
	</script>
@endpush