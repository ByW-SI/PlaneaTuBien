@extends('principal')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row mt-2">
            {{-- DATOS GENERALES DEL PROSPECTO --}}
            @include('componentes.prospectos.datos_generales.show')

            {{-- ESTUDIO SOCIOECONOMICO --}}
            @include('componentes.prospectos.estudios_socioeconomicos.show')

            {{-- DATOS DE LA COTIZACION --}}
            @include('componentes.cotizaciones.create')

        </div>
    </div>
</div>

{{-- <div class="card-header">
        <h4>
            Datos del prestamo
        </h4>
    </div>
    <div class="card-body">
        <div class="row row-group">
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <label for="monto">Monto que desea obtener/ monto que puede obtener:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="text" value="{{number_format($prospecto->monto,2)}}">
</div>
</div>
<div class="form-group col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6">
    <label for="plan">Plan que desea obtener/ plan que puede obtener:</label>
    <input class="form-control" readonly="" type="text" value="{{$prospecto->plan}}">
</div>
</div>
</div> --}}

@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('.escondible').hide();

        $('input[name=plan-radio]').change( function(){

            let tipo_plan = $(this).val();
            console.log(tipo_plan);

            // ESCONDEMOS ALGUNOS INPUTS
            if(tipo_plan == 'libre'){
                getPlanes('PL');
                $('.input-escondible').removeAttr('required');
                $('.escondible').hide('slow');
                $('#cotizador').empty();
            }

            // MOSTRAMOS ALGUNOS INPUTS
            if(tipo_plan == 'normal'){
                getPlanes('TN');
                $('.escondible').show('slow');
                $(".input-escondible").prop('required',true);
                $('#promocion_select').prop('required',false);
            }

             // MOSTRAMOS ALGUNOS INPUTS
            if(tipo_plan == 'clasica'){
                getPlanes('TC');
                
                $('.escondible').show('slow');
                $(".input-escondible").prop('required',true);
                $('#promocion_select').prop('required',false);
            }

             // MOSTRAMOS ALGUNOS INPUTS
            if(tipo_plan == 'tradicional'){
                getPlanes('TD');
                $('.escondible').show('slow');
                $(".input-escondible").prop('required',true);
                $('#promocion_select').prop('required',false);
            }
        });

        $('#plan_cliente').on('change', function() {
            getCotizacionLibre();
        });
        $('#monto').on('change', function() {
            getCotizacionLibre();
        });
    });

    $(document).on('change', '.inputTipoPlan', function(){
        $('#contenedorInputPlanCliente').show('slow');
    });

    function getPlanes(abreviaturaPlan) {
        let planes = [];
        $.ajax({
            url: '{{ url('/get-planes') }}',
            type: 'GET',
            dataType: 'json',
            data: {abreviatura: abreviaturaPlan},
        })
        .done(function(res) {
            console.log("success", res);
            addOptionsPlan(res.planes);
        })
        .fail(function(err) {
            console.log("error", err);
        });
        
    }

    function addOptionsPlan(planes) {
        $('#plan_cliente').children('option:not(:first)').remove();
        $.each(planes, function(key, value) {
             $('#plan_cliente')
                 .append($("<option></option>")
                 .attr("value",value.id)
                 .text(value.nombre));
        });
    }

    function getCotizacionLibre() {
        if($('input[name=plan-radio]:checked').val() == 'libre' && $('#monto').val() != ''){
            let monto = $('#monto').val();
            let plan = $('#plan_cliente').val();
            $.ajax({
                url: `/cotizacion/monto/${monto}/plan/${plan}`,
                type: 'GET',
                dataType: 'json',
            })
            .done(function(res) {
                console.log("success", res);
                $('#cotizador').empty();
                let html = `<div class="col-sm-6 offset-3"><table class="table table-striped">
                                <thead class="thead-dark ">
                                    <tr>
                                        <th>Mínimo</th>
                                        <th>Posible 1</th>
                                        <th>Posible 2</th>
                                        <th>Posible 3</th>
                                        <th>Máximo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$${new Intl.NumberFormat('es-MX').format(res.minimo)}</td>
                                        <td>$${new Intl.NumberFormat('es-MX').format(res.posible1)}</td>
                                        <td>$${new Intl.NumberFormat('es-MX').format(res.posible2)}</td>
                                        <td>$${new Intl.NumberFormat('es-MX').format(res.posible3)}</td>
                                        <td>$${new Intl.NumberFormat('es-MX').format(res.maximo)}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>`;
                $('#cotizador').html(html)
            })
            .fail(function(err) {
                console.log("error", err);
            });
            
        }
    }
</script>
@endpush