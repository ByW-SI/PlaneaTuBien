@extends('principal')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-3">
                <h4>Datos del Prospecto:</h4>
            </div>
        </div>
    </div>
    <div class="card-header">
        <h5>Datos generales del prospecto:</h5>
    </div>
    <div class="card-body">
        <div class="row row-group">
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Nombre:</label>
                <input type="text" class="form-control" value="{{ $prospecto->nombre }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Paterno:</label>
                <input type="text" class="form-control" value="{{ $prospecto->appaterno }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Apellido Materno:</label>
                <input type="text" class="form-control" value="{{ $prospecto->apmaterno }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Sexo:</label>
                <input type="text" class="form-control" value="{{ $prospecto->sexo }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Correo electronico:</label>
                <input type="text" class="form-control" value="{{ $prospecto->email }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono:</label>
                <input type="text" class="form-control" value="{{ $prospecto->tel }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Telefono movil:</label>
                <input type="text" class="form-control" value="{{ $prospecto->movil }}" readonly="">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-6 col-lg-4 col-xl-4">
                <label>Asesor:</label>
                <input type="text" class="form-control" value="{{ $prospecto->asesor->nombre.' '.$prospecto->asesor->paterno.' '.$prospecto->asesor->materno }}" readonly="">
            </div>
        </div>
    </div>
    
    <div class="card-header">
        <h4>
            Estudio socioeconómico
        </h4>
    </div>
    <div class="card-body">
        <div class="row row-group">
            <div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <label for="sueldo">Sueldo mensual del prospecto:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="text" value="{{number_format($prospecto->sueldo,2)}}">
                </div>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <label for="ahorro">Ahorro neto del prospecto:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control" readonly="" type="text" value="{{number_format($prospecto->ahorro,2)}}">
                </div>
            </div>
            <div class="form-group col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
                <label for="calificacion">Calificación del prospecto:</label>
                <input class="form-control" readonly="" type="text" value="{{$prospecto->calificacion}}">
            </div>
            <div class="form-group col-12 col-xs-12 col-md-12 offset-md-4 col-lg-4 offset-lg-4 col-xl-4 offset-xl-4">
                <label for="estado">Estado del prospecto:</label>
                <input class="form-control" readonly="" type="text" value="{{$prospecto->aprobado ? 'Aprobado' : 'No Aprobado'}}" >
            </div>
        </div>
    </div>
    <div class="card-header">
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
                <input class="form-control" readonly="" type="text" value="{{$prospecto->plan}}" >
            </div>
        </div>
    </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Datos de la Cotización</h5>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="{{ route('empleados.prospectos.cotizacions.index', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" class="btn btn-primary">
                            <i class="fa fa-bars"></i><strong> Lista de Cotizaciones</strong>
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{route('empleados.prospectos.cotizacions.store', ['empleado'=>$empleado,'prospecto' => $prospecto]) }}" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row my-3">
                        <div class="col-sm-3">
                            <input type="radio" name="plan-radio" id="plan-libre" value="libre">
                            <label class="form-check-label" for="plan-libre">
                                Plan libre
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="plan-radio" id="plan-clasica" value="clasica">
                            <label class="form-check-label" for="plan-clasica">
                                Tanda Clasica
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="plan-radio" id="plan-tradicional" value="tradicional">
                            <label class="form-check-label" for="plan-tradicional">
                                Tanda Tradicional
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="plan-radio" id="plan-normal" value="normal">
                            <label class="form-check-label" for="plan-normal">
                                Plan normal
                            </label>
                        </div>
                    </div>
                    <div class="row escondible">
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group">
                            <label for="monto">✱Valor de la propiedad</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <select name="monto" id="monto" class="form-control" required="">
                                    <option value="">Seleccione un monto</option>
                                    @for ($i = 300000; $i <= 20000000; $i+=50000)
                                        {{-- @if ($i%50000) --}}
                                            <option value="{{$i}}">{{number_format($i)}}</option>
                                        {{-- @endif --}}
                                    @endfor
                                </select>
                                {{-- <input class="form-control" type="number" name="monto" id="monto" min="300000" max="20000000" step="50000" required=""> --}}
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
                            <label for="ahorro">✱Ahorro del cliente</label>
                            <select name="ahorro" id="ahorro_cliente" class="form-control input-escondible" required="">
                                <option value="">Seleccionar</option>
                                <option value="0">0%</option>
                                <option value="5">5%</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="40">40%</option>
                            </select>
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
                            <label for="plan">✱Plan</label>
                            <select name="plan" id="plan_cliente" class="form-control input-escondible" required="">
                                <option value="">Seleccionar</option>
                                @foreach ($planes as $plan)
                                    <option value="{{$plan->id}}">{{$plan->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 form-group escondible">
                            <label for="monto">Porcentaje de descuento </label>
                            <div class="input-group mb-3">
                                <input class="form-control input-escondible" type="number" id="descuento_input" name="descuento" min="0" max="30" value="0.00">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
                            <label class="col-form-label">Promocion:</label>
                            <select name="promocion" class="form-control" id="promocion_select">
                                <option value="">Ninguna</option>
                                    @foreach ($promociones as $promocion)
                                        <option value="{{$promocion->id}}">{{$promocion->nombre}}</option>   
                                    @endforeach   
                            </select>
                        </div>
                        <div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-3 form-group escondible">
                            <label class="col-form-label">Pago de inscripción:</label>
                            <select name="tipo_inscripcion" class="form-control input-escondible" id="tipo_inscripcion_select" required="">
                                <option value="">Seleccione una opcion</option>
                                <option value="inscripcion_total">Inscripción Total</option>   
                                <option value="inscripcion_diferida">Inscripción Diferida</option>   
                                <option value="0_inscripcion_inicial">0% de inscripción</option>   
                            </select>
                        </div>
                    </div>
                    <div class="row escondible" id="promocion_div">
                    </div>
                    <div id="cotizador" class="escondible">    
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4 offset-4 text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Guardar
                            </button>
                        </div>
                        <div class="col-sm-4 text-right text-danger">
                            ✱Campos Requeridos.
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
</script>
@endpush